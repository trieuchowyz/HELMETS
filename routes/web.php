<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ThongkeController;
use App\Http\Controllers\Admin\QLdonhangController;
use App\Http\Controllers\Admin\QLdanhmucController;
use App\Http\Controllers\Admin\QLsanphamController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. TRANG CHỦ FRONTEND (Dành cho User - 127.0.0.1:8000)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// ==========================================
// 2. ROUTE DÀNH CHO ADMIN (Vào bằng 127.0.0.1:8000/admin)
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Trang Tổng quan 
    Route::get('/', [IndexController::class, 'index'])->name('dashboard');

    // Báo cáo & Thống kê
    Route::get('/thong-ke', [ThongkeController::class, 'index'])->name('thong-ke');

    // Kinh doanh
    Route::get('/quanly-donhang', [QLdonhangController::class, 'index'])->name('quanly-donhang');
    Route::get('/quanly-donhang/{id}', [QLdonhangController::class, 'show'])->name('orders.show'); // Route xem chi tiết
    Route::post('/quanly-donhang/cap-nhat/{id}', [QLdonhangController::class, 'updateStatus'])->name('orders.updateStatus'); // Route cập nhật trạng thái

    // Quản lý Voucher
    Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');
    Route::post('/voucher/store', [VoucherController::class, 'store'])->name('voucher.store');
    Route::post('/voucher/update/{id}', [VoucherController::class, 'update'])->name('voucher.update');
    Route::delete('/voucher/delete/{id}', [VoucherController::class, 'destroy'])->name('voucher.destroy');

    // Danh mục
    Route::get('/danh-muc', [QLdanhmucController::class, 'index'])->name('danhmuc');
    Route::post('/danh-muc/store', [QLdanhmucController::class, 'store'])->name('danhmuc.store');
    Route::post('/danh-muc/update/{id}', [QLdanhmucController::class, 'update'])->name('danhmuc.update');
    Route::post('/danh-muc/toggle/{id}', [QLdanhmucController::class, 'toggleStatus'])->name('danhmuc.toggle');
    
    // Sản phẩm
    Route::get('/san-pham', [QLsanphamController::class, 'index'])->name('sanpham');
    Route::get('/san-pham-an', [QLsanphamController::class, 'hidden'])->name('sanpham.hidden'); 
    Route::post('/san-pham/toggle/{id}', [QLsanphamController::class, 'toggleStatus'])->name('sanpham.toggle');
    Route::post('/san-pham/bulk-update', [QLsanphamController::class, 'bulkUpdate'])->name('sanpham.bulkUpdate'); 
    Route::get('/san-pham/them-hang-loat', [QLsanphamController::class, 'bulkCreate'])->name('sanpham.bulkCreate');
    Route::post('/san-pham/store-hang-loat', [QLsanphamController::class, 'storeBulk'])->name('sanpham.storeBulk');
    Route::post('/san-pham/sua-hang-loat', [QLsanphamController::class, 'bulkEdit'])->name('sanpham.bulkEdit');
    Route::post('/san-pham/update-hang-loat-nang-cao', [QLsanphamController::class, 'updateBulkAdvanced'])->name('sanpham.updateBulkAdvanced');

    // Quản lý Nhân viên
    Route::get('/nhan-vien', [StaffController::class, 'index'])->name('staffs');
    Route::post('/nhan-vien/store', [StaffController::class, 'store'])->name('staffs.store');
    Route::get('/nhan-vien/{id}', [StaffController::class, 'show'])->name('staffs.show');
    Route::post('/nhan-vien/update/{id}', [StaffController::class, 'update'])->name('staffs.update');
    Route::post('/nhan-vien/toggle/{id}', [StaffController::class, 'toggleStatus'])->name('staffs.toggle');
    
    // Tài khoản Khách hàng
    Route::get('/khach-hang', [CustomerController::class, 'index'])->name('customers');
    Route::get('/khach-hang/{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::post('/khach-hang/toggle/{id}', [CustomerController::class, 'toggleStatus'])->name('customers.toggle');

    // Hệ thống
    Route::get('/ho-so', [ProfileController::class, 'index'])->name('profile');
    Route::post('/ho-so/update', [ProfileController::class, 'update'])->name('profile.update'); 

    
});

// ==========================================
// 3. CÁC TRANG TĨNH FRONTEND
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
// 4. ROUTE CHO KHÁCH HÀNG (Yêu cầu đăng nhập)
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
    Route::post('/tai-khoan/huy-don/{id}', [AccountController::class, 'cancelOrder'])->name('account.cancelOrder');
});

// ==========================================
// 5. ROUTE CÔNG KHAI (Auth & Tìm kiếm)
// ==========================================
Route::get('/logout',[HomeController::class, 'logout'])->name('logout');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'register']);

// Gợi ý tìm kiếm
Route::get('/search-suggestion', [ProductController::class, 'searchSuggestion'])->name('product.search.suggestion');

// ==========================================
// 6. ROUTE ĐỘNG BẮT BUỘC ĐỂ CUỐI CÙNG
// ==========================================
Route::get('/{menu}', [ProductController::class, 'index'])->name('product.index');

// Cập nhật lại điều kiện where để cho phép dấu gạch ngang
Route::get('/{menu}/{slug}-{id}.html', [ProductController::class,'detail'])
    ->name('product.detail')
    ->where([
        'menu' => '[a-zA-Z0-9-]+',
        'slug' => '[a-zA-Z0-9-]+',
        'id' => '[0-9]+'
    ]);