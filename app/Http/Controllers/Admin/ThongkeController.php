<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Services\BangThongKeService;

class ThongKeController extends Controller
{
    public function index() {
    $monthlyRevenue = BangThongKeService::getMonthlyRevenue();

    $totalOrders = Order::count();
        $orderStats = [
            'completed' => Order::where('status', 'completed')->count(),
            'shipped'   => Order::where('status', 'shipped')->count(),
            'pending'   => Order::where('status', 'pending')->count(),
            'canceled'  => Order::where('status', 'canceled')->count(),
        ];

        // 2. BỔ SUNG BIẾN VÀO COMPACT
        return view('admin.thong-ke', compact('monthlyRevenue', 'totalOrders', 'orderStats'));
    }

}