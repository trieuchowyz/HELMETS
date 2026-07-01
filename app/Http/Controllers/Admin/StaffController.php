<?php

namespace App\Http\Controllers\Admin; // Thêm chữ \Admin vào đây

use App\Http\Controllers\Controller; // Bắt buộc phải thêm dòng này để kế thừa
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // Trang Tổng quan (Dashboard)
    public function index() {
        return view('admin.staff');
    }
}