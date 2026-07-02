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

    return view('admin.thong-ke', compact('monthlyRevenue'));
    }

}