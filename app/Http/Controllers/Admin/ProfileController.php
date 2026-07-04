<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // 1. Hiển thị trang Hồ sơ
    public function index() {
        // Lấy tài khoản admin (Nếu bạn đã cài Auth guard riêng thì dùng Auth::guard('staff')->user())
        // Ở đây tạm truy vấn thẳng tài khoản admin để không bị lỗi đăng nhập
        $admin = Staff::where('role', 'admin')->first();
        
        return view('admin.profile', compact('admin'));
    }

    // 2. Cập nhật Hồ sơ
    public function update(Request $request) {
        $admin = Staff::where('role', 'admin')->first();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:staffs,email,'.$admin->id,
            'avata' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        // Nếu có nhập mật khẩu mới thì mới cập nhật
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Xử lý upload ảnh đại diện
        if ($request->hasFile('avata')) {
            $image = $request->file('avata');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/avatar/'), $imageName);
            $admin->avata = '/uploads/avatar/' . $imageName;
        }

        $admin->save();

        return redirect()->back()->with('success', 'Cập nhật hồ sơ cá nhân thành công!');
    }
}