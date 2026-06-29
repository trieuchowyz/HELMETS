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

        // LẤY THÊM DỮ LIỆU MỚI CHO BẢNG BÊN DƯỚI
        // 5 đơn hàng mới nhất
        $recentOrders = Order::with('user')->orderBy('id', 'desc')->take(5)->get();
        // 5 sản phẩm mới thêm
        $recentProducts = Product::orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalCustomers', 'totalProducts', 'totalOrders', 'revenue', 'recentOrders', 'recentProducts'));
    }
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
        
        // 1. Lấy thông tin danh mục để làm tên thư mục chứa ảnh
        $category = Category::find($request->catid);
        // Dùng slug của danh mục làm tên folder (VD: mu-xe-dap), nếu không có thì cho vào thư mục 'khac'
        $folderName = $category ? $category->slug : 'khac'; 

        // 2. Xử lý upload file ảnh
        if ($request->hasFile('img_upload')) {
            $file = $request->file('img_upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/products/' . $folderName);
            $file->move($destinationPath, $filename);
            $imagePath = '/uploads/products/' . $folderName . '/' . $filename;
        } else {
            $imagePath = $request->img;
        }

        $specs = $request->filled('specs') ? $request->specs : null;

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
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
        $imagePath = $product->img; 

        // Lấy tên folder y như hàm thêm mới
        $category = Category::find($request->catid);
        $folderName = $category ? $category->slug : 'khac';

        if ($request->hasFile('img_upload')) {
            $file = $request->file('img_upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            $destinationPath = public_path('uploads/products/' . $folderName);
            $file->move($destinationPath, $filename);
            
            $imagePath = '/uploads/products/' . $folderName . '/' . $filename;
        } elseif ($request->filled('img')) {
            $imagePath = $request->img;
        }

        $specs = $request->filled('specs') ? $request->specs : $product->specs;

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
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
    // ==========================================
    // 3. QUẢN LÝ ĐƠN HÀNG
    // ==========================================
    
    // Hiển thị danh sách đơn hàng
    public function orders()
    {
        // Lấy danh sách đơn hàng, kèm thông tin user (khách hàng), sắp xếp mới nhất lên đầu
        $orders = Order::with('user')->orderBy('id', 'desc')->paginate(10);
        
        // Trả về view danh sách đơn hàng (giả sử bạn lưu file index.blade.php của đơn hàng trong thư mục admin/orders)
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị chi tiết một đơn hàng
    public function orderDetail($id)
    {
        // Lấy đơn hàng theo ID, kèm theo thông tin user và chi tiết các sản phẩm trong đơn
        $order = Order::with(['user', 'details.product'])->findOrFail($id);
        
        // Trả về view chi tiết đơn hàng
        return view('admin.orders.detail', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        // Cập nhật trạng thái mới lấy từ form select
        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}