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
}