<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. ROUTE DÀNH CHO ADMIN (Trang mặc định khi run)
// ==========================================

Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
// ==========================================
// ROUTE DÀNH CHO ADMIN
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Trang Tổng quan (Vào bằng: 127.0.0.1:8000/admin)
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Các trang UI mới cắt (chưa có logic)
    Route::get('/thong-ke', [AdminController::class, 'thongKe'])->name('thong-ke');
    Route::get('/quanly-donhang', [AdminController::class, 'quanLyDonHang'])->name('quanly-donhang');
    Route::get('/khach-hang', [AdminController::class, 'users'])->name('users');
    Route::get('/ho-so', [AdminController::class, 'profile'])->name('profile');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

});


// ==========================================
// 2. CÁC TRANG TĨNH
// ==========================================
Route::get('/ve-chung-toi', function () {
    return view('home.ve-chung-toi');
})->name('ve-chung-toi');

Route::get('/lien-he', function () {
    return view('home.lien-he');
})->name('lien-he');

Route::get('/dieu-khoan', function () {
    return view('home.dieu-khoan');
})->name('dieu-khoan');

Route::get('/chinh-sach-bao-mat', function () {
    return view('home.chinh-sach-bao-mat');
})->name('chinh-sach-bao-mat');

Route::get('/bao-hanh', function () {
    return view('home.bao-hanh');
})->name('bao-hanh');

// ==========================================
// 3. ROUTE CHO KHÁCH HÀNG (Yêu cầu đăng nhập)
// ==========================================
Route::middleware('auth')->group(function() {
    // Giỏ hàng
    Route::get('/cart',[CartController::class, 'index'])->name('home.cart');
    Route::get('/addproduct/{pid}/{q?}', [CartController::class, 'addcart'])->name('cart.addcart');
    Route::post('/update-cart', [CartController::class, 'updatecart'])->name('cart.updatecart');
    Route::post('/update-cart-ajax', [CartController::class, 'updateCartAjax'])->name('cart.updateajax');
    Route::delete('/delete-cart/{id}',[CartController::class, 'detelecart'])->name('cart.detelecart');
    
    // Thanh toán đơn hàng
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
    
    // Trang tài khoản & Lịch sử mua hàng
    Route::get('/tai-khoan', [AccountController::class, 'index'])->name('account.index');
});

// ==========================================
// 4. ROUTE CÔNG KHAI (Auth, Home & Sản phẩm)
// ==========================================
Route::get('/logout',[HomeController::class, 'logout'])->name('logout');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'register']);

// Đã tạm dời trang chủ User cũ sang link /trang-chu để nhường đường dẫn gốc (/) cho Admin
Route::get('/trang-chu', [HomeController::class, 'index'])->name('home.index');

// Gợi ý tìm kiếm
Route::get('/search-suggestion', [ProductController::class, 'searchSuggestion'])->name('product.search.suggestion');

// ROUTE ĐỘNG BẮT BUỘC ĐỂ CUỐI CÙNG
Route::get('/{menu}', [ProductController::class, 'index'])->name('product.index');

// Cập nhật lại điều kiện where để cho phép dấu gạch ngang
Route::get('/{menu}/{slug}-{id}.html', [ProductController::class,'detail'])
    ->name('product.detail')
    ->where([
        'menu' => '[a-zA-Z0-9-]+',
        'slug' => '[a-zA-Z0-9-]+',
        'id' => '[0-9]+'
    ]);