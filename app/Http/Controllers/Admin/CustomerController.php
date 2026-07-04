<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class CustomerController extends Controller
{
    // 1. Hiển thị danh sách khách hàng & Thống kê
    public function index() {
        $totalCustomers = User::where('role', 'customer')->count();
        $activeCustomers = User::where('role', 'customer')->where('status', 1)->count();
        $lockedCustomers = User::where('role', 'customer')->where('status', 0)->count();
        
        // Khách hàng mới trong tháng này
        $newThisMonth = User::where('role', 'customer')
                            ->whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();

        $customers = User::where('role', 'customer')->orderBy('id', 'desc')->paginate(10);

        return view('admin.customer', compact('totalCustomers', 'activeCustomers', 'lockedCustomers', 'newThisMonth', 'customers'));
    }

    // 2. Xem chi tiết thông tin và Lịch sử mua hàng
    public function show($id) {
        // Lấy khách hàng kèm theo lịch sử đơn hàng của họ
        $customer = User::where('role', 'customer')->findOrFail($id);
        
        $orders = Order::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        
        // Tính tổng tiền khách đã chi tiêu (Chỉ tính đơn đã hoàn thành)
        $totalSpent = Order::where('user_id', $id)->where('status', 'completed')->sum('total_amount');

        return view('admin.customer-details', compact('customer', 'orders', 'totalSpent'));
    }

    // 3. Khóa / Mở khóa tài khoản khách hàng
    public function toggleStatus($id) {
        $customer = User::findOrFail($id);
        $customer->status = $customer->status == 1 ? 0 : 1;
        $customer->save();

        $msg = $customer->status == 1 ? 'Đã mở khóa tài khoản khách hàng!' : 'Đã khóa tài khoản khách hàng!';
        return redirect()->back()->with('success', $msg);
    }
}