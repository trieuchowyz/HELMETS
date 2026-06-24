<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $menus = Menu::with('menuCon')
        ->where('parentid', null) // menu cấp 1
        ->where('display', 1)     //menu được phép hiển thị
        ->orderby('stt', 'desc')  //sắp xếp
        ->get(); // lấy dữ liệu
        View::share(compact('menus'));
    }
}
