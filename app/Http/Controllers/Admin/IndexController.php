<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use App\Services\BangThongKeService;


class IndexController extends Controller
{
    public function index() 
    {
        // 1. Tính tổng doanh thu (Chỉ cộng những đơn hàng đã giao hoặc hoàn thành)

        $totalRevenue = Order::whereIn('status', ['shipped', 'completed'], 'and', false)->sum('total_amount');
        
        // 2. Tổng số đơn hàng
        $totalOrders = Order::all()->count();
        
        // 3. Tổng số khách hàng
        $totalCustomers = User::query()->where('role', 'customer')->count();
        
        // 4. Tổng số sản phẩm
        // Use all()->count() to avoid argument mismatch in certain environments
        $totalProducts = Product::all()->count();
        
        // 5. Danh sách 5 người dùng mới nhất
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        $monthlyRevenue = BangThongKeService::getMonthlyRevenue();

        // Trả data về View
        return view('admin.index', compact(
            'totalRevenue', 
            'totalOrders', 
            'totalCustomers', 
            'totalProducts', 
            'recentUsers',
            'monthlyRevenue'
        ));
    }
}