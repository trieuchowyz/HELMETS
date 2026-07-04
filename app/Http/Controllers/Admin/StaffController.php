<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    // 1. Hiển thị danh sách và Thống kê
    public function index() {
        // Lấy dữ liệu cho 4 thẻ thống kê
        $totalStaff = Staff::count();
        $activeStaff = Staff::where('status', 1)->count();
        $lockedStaff = Staff::where('status', 0)->count();
        $adminCount = Staff::where('role', 'admin')->count();

        // Lấy danh sách nhân viên phân trang
        $staffs = Staff::orderBy('id', 'desc')->paginate(10);

        return view('admin.staff', compact('totalStaff', 'activeStaff', 'lockedStaff', 'adminCount', 'staffs'));
    }

    // 2. Thêm mới nhân viên
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staffs,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,manager,staff',
            'salary' => 'nullable|numeric|min:0'
        ]);

        $staff = new Staff();
        $staff->fill($request->except('password'));
        $staff->password = Hash::make($request->password); // Mã hóa mật khẩu
        $staff->status = 1;
        $staff->save();

        return redirect()->back()->with('success', 'Thêm nhân viên mới thành công!');
    }

    // 3. Hiển thị trang chi tiết/sửa
    public function show($id) {
        $staff = Staff::findOrFail($id);
        return view('admin.staff-details', compact('staff'));
    }

    // 4. Cập nhật thông tin nhân viên
    public function update(Request $request, $id) {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staffs,email,' . $id, // Bỏ qua email của chính nhân viên này
            'role' => 'required|in:admin,manager,staff',
            'salary' => 'nullable|numeric|min:0'
        ]);

        $staff->fill($request->except('password'));

        // Chỉ cập nhật mật khẩu nếu có nhập mật khẩu mới
        if ($request->filled('password')) {
            $staff->password = Hash::make($request->password);
        }

        $staff->save();

        return redirect()->back()->with('success', 'Cập nhật hồ sơ nhân viên thành công!');
    }

    // 5. Khóa / Mở khóa tài khoản
    public function toggleStatus($id) {
        $staff = Staff::findOrFail($id);
        $staff->status = $staff->status == 1 ? 0 : 1;
        $staff->save();

        $msg = $staff->status == 1 ? 'Đã mở khóa tài khoản!' : 'Đã khóa tài khoản nhân viên!';
        return redirect()->back()->with('success', $msg);
    }
}