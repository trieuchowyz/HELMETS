<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('menu')
            ->where('parent_id', null)
            ->where('quantity', '>', 0) // <-- BỔ SUNG DÒNG NÀY ĐỂ ẨN SẢN PHẨM HẾT HÀNG
            ->orderby('id', 'desc')
            // ->limit(8)
            ->get();
        return view('home.index', compact('products'));
    }

    public function contact()
    {
        return view('home.contact', ['title' => 'Contact']);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]);

            User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('login')->with('success', 'Tạo tài khoản thành công');
        }

        return view('home.register');
    }
    
    public function login(Request $request)
    {
        // 1. Nếu là request GET thì hiển thị form giao diện đăng nhập
        if ($request->isMethod('get')) {
            return view('home.login');
        }

        // 2. Nếu là request POST thì bắt đầu xử lý đăng nhập
        $request->validate([
            'username' => 'required', // Form m đang dùng name="username" cho ô nhập email
            'password' => 'required'
        ]);

        // 3. Tiến hành kiểm tra tài khoản (so khớp email trong CSDL với ô username m nhập)
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            // ----------------------------------------------------
            // KHÚC QUAN TRỌNG: KIỂM TRA QUYỀN ĐỂ ĐIỀU HƯỚNG
            // ----------------------------------------------------
            if (Auth::user()->role === 'admin') {
                // Nếu là Admin -> Cho bay thẳng vào trang Quản trị
                return redirect()->route('admin.dashboard')->with('success', 'Chào mừng Admin quay trở lại!');
            }

            // Nếu chỉ là Customer bình thường -> Cho về trang chủ
            return redirect()->route('home.index')->with('success', 'Đăng nhập thành công!');
        }

        // Đăng nhập sai thì đá về lại trang đăng nhập kèm báo lỗi
        return back()->withErrors([
            'username' => 'Tài khoản hoặc mật khẩu không chính xác.',
        ]);
    }
 
    public function logout(Request $request){
        //đăng xuất tài khoản
        Auth::logout();
        //Xóa thông tin người dùng được lưu trong session
        $request->session()->invalidate();
        //Tạo token để bảo vệ người dùng
        $request->session()->regenerateToken();
        //Chuyển trang
        return redirect('/');
    }
}

