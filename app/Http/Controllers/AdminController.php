<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // ==========================================
    // 1. TỔNG QUAN DASHBOARD
    // ==========================================
    public function index()
    {
        // Thống kê nhanh để show ra biểu đồ/thẻ
        $totalCustomers = User::where('role', 'customer')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $revenue = Order::where('status', 'completed')->sum('total_amount');

        return view('admin.dashboard', compact('totalCustomers', 'totalProducts', 'totalOrders', 'revenue'));
    }

    // ==========================================
    // 2. QUẢN LÝ SẢN PHẨM (MŨ BẢO HIỂM)
    // ==========================================
    // ==========================================
    // 2. QUẢN LÝ SẢN PHẨM (MŨ BẢO HIỂM)
    // ==========================================
    public function products()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $imagePath = null;
        // Xử lý upload file ảnh từ máy tính
        if ($request->hasFile('img_upload')) {
            $file = $request->file('img_upload');
            // Đổi tên file để không bị trùng (gắn thêm timestamp)
            $filename = time() . '_' . $file->getClientOriginalName();
            // Lưu vào thư mục public/uploads/products
            $file->move(public_path('uploads/products'), $filename);
            $imagePath = '/uploads/products/' . $filename;
        } else {
            // Nếu không up file thì lấy link mạng (nếu có nhập)
            $imagePath = $request->img;
        }

        $specs = $request->filled('specs') ? $request->specs : null;

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'detail' => $request->detail,
            'specs' => $specs,
            'catid' => $request->catid,
            'img' => $imagePath
        ]);

        return redirect()->route('admin.products')->with('success', 'Thêm mũ/nón thành công!');
    }

    // Giao diện Sửa sản phẩm
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Xử lý Cập nhật sản phẩm
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $imagePath = $product->img; // Mặc định giữ ảnh cũ

        // Nếu có up ảnh mới thì lưu ảnh mới
        if ($request->hasFile('img_upload')) {
            $file = $request->file('img_upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $imagePath = '/uploads/products/' . $filename;
        } elseif ($request->filled('img')) {
            $imagePath = $request->img;
        }

        $specs = $request->filled('specs') ? $request->specs : $product->specs;

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'detail' => $request->detail,
            'specs' => $specs,
            'catid' => $request->catid,
            'img' => $imagePath
        ]);

        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa sản phẩm!');
    }
    
}