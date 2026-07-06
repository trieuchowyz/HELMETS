<?php
namespace App\Http\Controllers\Admin; // Thêm chữ \Admin vào đây

use App\Http\Controllers\Controller; // Bắt buộc phải thêm dòng này để kế thừa
use Illuminate\Http\Request;
use App\Models\Order;

class QLdonhangController extends Controller
{
    // Trang Tổng quan (Dashboard)
    public function index() {
        // Lấy danh sách đơn hàng, sắp xếp mới nhất lên đầu, kèm thông tin User đặt hàng
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.QLdonhang', compact('orders'));
    }
    public function show($id) {
        // Lấy đơn hàng kèm theo chi tiết sản phẩm và thông tin người mua
        $order = Order::with(['user', 'details.product'])->findOrFail($id);
        return view('admin.QLdonhang_details', compact('order'));
    }

    // 3. Cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}