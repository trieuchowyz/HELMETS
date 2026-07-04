<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    // Trang chủ
    public function index()
    {
        $products = Product::with('menu')
            ->where('parent_id', null)
            ->where('quantity', '>', 0) // Ẩn sản phẩm hết hàng
            ->orderby('id', 'desc')
            ->get();
        return view('home.index', compact('products'));
    }

    public function contact()
    {
        return view('home.contact', ['title' => 'Contact']);
    }

    // Đăng ký
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric|unique:users,phone', // Bắt lỗi trùng số điện thoại
                'password' => 'required|min:6|confirmed' // Tự động đối chiếu với ô password_confirmation
            ], [
                'phone.unique' => 'Số điện thoại này đã được đăng ký.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.'
            ]);

            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'customer',
                'status' => 1 // Tài khoản mới tạo mặc định hoạt động
            ]);
            return redirect()->route('login')->with('success', 'Tạo tài khoản thành công! Vui lòng đăng nhập.');
        }

        return view('home.register');
    }
    
    // Đăng nhập
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('home.login');
        }

        $request->validate([
            'phone' => 'required|numeric',
            'password' => 'required'
        ]);

        // Kiểm tra SĐT, Mật khẩu và điều kiện TÀI KHOẢN CHƯA BỊ KHÓA (status = 1)
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password, 'status' => 1])) {
            $request->session()->regenerate();
            return redirect()->route('home.index')->with('success', 'Đăng nhập thành công!');
        }

        // Đăng nhập sai hoặc bị khóa thì đá về lại trang đăng nhập
        return back()->withErrors([
            'phone' => 'Số điện thoại, mật khẩu không chính xác hoặc tài khoản đã bị khóa.',
        ])->onlyInput('phone');
    }
 
    // Đăng xuất
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}