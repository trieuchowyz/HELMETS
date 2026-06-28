<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. ROUTE DÀNH CHO ADMIN
// ==========================================
// Bọc toàn bộ route admin lại (Sau này bạn thêm middleware kiểm tra quyền admin ở đây)
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Tổng quan
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Quản lý Sản phẩm (Gom ĐỦ 6 hành động vào đây)
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/edit/{id}', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::post('/products/update/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::get('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');

    // Quản lý Đơn hàng
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}', [AdminController::class, 'orderDetail'])->name('orders.detail');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
});

// ==========================================
// 2. CÁC TRANG TĨNH (Phải đặt trên các route động)
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

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