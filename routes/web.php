<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;


//ưu tiên đường link xác định nên đưa lên đầu
//hiển thị giao diện
//1. tạo router - link
//2. Tạo controller - funtion
//3. Tạo giao diện
//4. viết chức năng - controller

use App\Http\Controllers\AdminController;

// Bọc toàn bộ route admin lại (Sau này bạn thêm middleware kiểm tra quyền admin ở đây)
Route::prefix('admin')->name('admin.')->group(function () {
    
    // 1. Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // 2. Sản phẩm
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');

    // 3. Đơn hàng
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}', [AdminController::class, 'orderDetail'])->name('orders.detail');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
});

//Nhóm yêu cầu đăng nhập
Route::middleware('auth')->group(function() {
    // 2. Sản phẩm
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('products.store');
    
    // Thêm 2 dòng này:
    Route::get('/products/edit/{id}', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::post('/products/update/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    
    Route::get('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');
    //danh sách sp trong giỏ hàng
    Route::get('/cart',[CartController::class, 'index'])->name('home.cart');
    //thêm sp vào giỏ hang
    Route::get('/addproduct/{pid}/{q?}', [CartController::class, 'addcart'])->name('cart.addcart');
    //cập nhật giỏ hàng
    Route::post('/update-cart', [CartController::class, 'updatecart'])->name('cart.updatecart');
    Route::post('/update-cart-ajax', [CartController::class, 'updateCartAjax'])->name('cart.updateajax');

    //Route::put()
    //xóa sản phẩm trong giỏ hàng
    Route::delete('/delete-cart/{id}',[CartController::class, 'detelecart'])->name('cart.detelecart');
    // Thanh toán đơn hàng
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
    
    // Trang tài khoản & Lịch sử mua hàng
    Route::get('/tai-khoan', [AccountController::class, 'index'])->name('account.index');
});


Route::get('/logout',[HomeController::class, 'logout'])->name('logout');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'register']);
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/{menu}', [ProductController::class, 'index'])->name('product.index');


Route::get('/{menu}/{slug}-{id}.html', [ProductController::class,'detail'])
->name('product.detail')
->where([
    'menu' => '[a-z0-9]+',
    'slug' => '[a-z0-9-]+',
    'id' => '[0-9]+'
]);

