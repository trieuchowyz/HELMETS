<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class QLsanphamController extends Controller
{
    // 1. Hiển thị danh sách SP đang hoạt động (Có lọc và Phân trang)
    public function index(Request $request) {
        $query = Product::with('category')->where('status', 1)->orderBy('id', 'desc');

        // Lọc theo danh mục nếu có chọn
        if ($request->has('catid') && $request->catid != '') {
            $query->where('catid', $request->catid);
        }

        // Phân trang tự động 12 SP/trang
        $products = $query->paginate(12);
        
        // Lấy danh sách danh mục (bỏ qua danh mục cha gốc nếu nó không chứa trực tiếp SP)
        $categories = Category::where('status', 1)->get();

        return view('admin.QLsanpham', compact('products', 'categories'));
    }

    // 2. Hiển thị trang SP đã ẩn
    public function hidden() {
        $products = Product::with('category')->where('status', 0)->orderBy('id', 'desc')->paginate(12);
        return view('admin.QLsanpham_hidden', compact('products'));
    }

    // 3. Ẩn / Hiện SP
    public function toggleStatus($id) {
        $product = Product::findOrFail($id);
        $product->status = $product->status == 1 ? 0 : 1;
        $product->save();

        $msg = $product->status == 1 ? 'Đã khôi phục sản phẩm!' : 'Đã ẩn sản phẩm vào kho!';
        return redirect()->back()->with('success', $msg);
    }

    // 4. Thêm sản phẩm mới (Có Upload Ảnh)
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'catid' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,webp|max:2048' // Tối đa 2MB
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->sale_price = $request->sale_price ?? 0;
        $product->quantity = $request->quantity;
        $product->catid = $request->catid;
        $product->status = 1;

        // Xử lý upload ảnh
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Lưu vào thư mục public/uploads/products/
            $image->move(public_path('uploads/products/'), $imageName);
            $product->img = '/uploads/products/' . $imageName;
        }

        $product->save();
        return redirect()->back()->with('success', 'Thêm sản phẩm thành công!');
    }

    // 5. Tính năng Shopee: Cập nhật giá, số lượng hàng loạt
    public function bulkUpdate(Request $request) {
        if (!$request->has('products')) {
            return redirect()->back()->with('error', 'Chưa có sản phẩm nào được chọn để cập nhật!');
        }

        // Lặp qua mảng SP gửi lên từ bảng (chỉ những ô checkbox được tick)
        foreach ($request->products as $id => $data) {
            if (isset($data['selected'])) {
                Product::where('id', $id)->update([
                    'price' => $data['price'],
                    'sale_price' => $data['sale_price'] ?? 0,
                    'quantity' => $data['quantity']
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cập nhật hàng loạt thành công!');
    }
    // 6. Giao diện Thêm hàng loạt (Shopee style)
    public function bulkCreate() {
        $categories = Category::where('status', 1)->get();
        return view('admin.QLsanpham_bulk_add', compact('categories'));
    }

    // 7. Xử lý lưu dữ liệu Thêm hàng loạt
    public function storeBulk(Request $request) {
        if (!$request->has('products')) {
            return redirect()->back()->with('error', 'Không có dữ liệu!');
        }

        $count = 0;
        foreach ($request->products as $index => $item) {
            // Chỉ lưu những dòng có nhập Tên sản phẩm
            if (!empty($item['name']) && !empty($item['price'])) {
                $product = new Product();
                $product->name = $item['name'];
                $product->slug = Str::slug($item['name'] . '-' . time()); // Tránh trùng slug
                $product->catid = $item['catid'] ?? 1;
                $product->price = $item['price'];
                $product->sale_price = $item['sale_price'] ?? 0;
                $product->quantity = $item['quantity'] ?? 1;
                $product->status = 1;

                // Xử lý upload ảnh cho từng dòng
                if ($request->hasFile("products.$index.img")) {
                    $image = $request->file("products.$index.img");
                    $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/products/'), $imageName);
                    $product->img = '/uploads/products/' . $imageName;
                }

                $product->save();
                $count++;
            }
        }

        return redirect()->route('admin.sanpham')->with('success', "Đã thêm thành công $count sản phẩm mới!");
    }
    // 8. Chuyển sang trang Sửa hàng loạt (Dựa trên các SP đã tick)
    public function bulkEdit(Request $request) {
        if (!$request->has('products')) {
            return redirect()->back()->with('error', 'Chưa chọn sản phẩm nào để sửa!');
        }

        // Lấy ra danh sách ID của các ô được tick
        $selectedIds = [];
        foreach ($request->products as $id => $data) {
            if (isset($data['selected'])) {
                $selectedIds[] = $id;
            }
        }

        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Bạn phải Tick chọn ít nhất 1 sản phẩm!');
        }

        // Lấy dữ liệu của các SP đó mang sang View
        $selectedProducts = Product::whereIn('id', $selectedIds)->get();
        $categories = Category::where('status', 1)->get();

        return view('admin.QLsanpham_bulk_edit', compact('selectedProducts', 'categories'));
    }

    // 9. Lưu dữ liệu Sửa hàng loạt nâng cao
    public function updateBulkAdvanced(Request $request) {
        if (!$request->has('products')) {
            return redirect()->route('admin.sanpham')->with('error', 'Không có dữ liệu!');
        }

        $count = 0;
        foreach ($request->products as $id => $item) {
            if (!empty($item['name']) && !empty($item['price'])) {
                $product = Product::findOrFail($id);
                $product->name = $item['name'];
                $product->catid = $item['catid'];
                $product->price = $item['price'];
                $product->sale_price = $item['sale_price'] ?? 0;
                $product->quantity = $item['quantity'] ?? 0;

                // Nếu có up ảnh mới thì thay ảnh cũ
                if ($request->hasFile("products.$id.img")) {
                    $image = $request->file("products.$id.img");
                    $imageName = time() . '_' . $id . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/products/'), $imageName);
                    $product->img = '/uploads/products/' . $imageName;
                }

                $product->save();
                $count++;
            }
        }

        return redirect()->route('admin.sanpham')->with('success', "Đã cập nhật thành công $count sản phẩm!");
    }
}