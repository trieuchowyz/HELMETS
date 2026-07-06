<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Hiển thị trang quản lý tài khoản & lịch sử đơn hàng
    public function index()
    {
        // Lấy toàn bộ đơn hàng của user đang đăng nhập, kèm theo chi tiết sản phẩm bên trong
        $orders = Order::where('user_id', Auth::id())
                        ->with('details.product')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('home.account', compact('orders'));
    }
    public function cancelOrder($id)
    {
        // Phải check thêm user_id để đảm bảo khách không hủy trộm đơn của người khác
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        // Chỉ cho phép hủy khi đơn hàng đang ở trạng thái 'pending' (Chờ xử lý)
        if ($order->status == 'pending') {
            $order->status = 'cancelled';
            $order->save();
            return redirect()->back()->with('success', 'Đã hủy đơn hàng thành công!');
        }

        return redirect()->back()->with('error', 'Đơn hàng này không thể hủy vì đang được giao hoặc đã hoàn thành!');
    }
}