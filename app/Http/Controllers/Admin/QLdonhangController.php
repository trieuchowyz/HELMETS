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
}