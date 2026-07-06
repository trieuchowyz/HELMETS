<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Nhớ có dòng này ở trên cùng
use App\Models\Menu; // Nhớ có dòng này ở trên cùng

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
        // View Composer: Nhồi biến $menus vào mọi file Blade mỗi khi trang được load
        View::composer('*', function ($view) {
            // Lấy toàn bộ Menu đang được phép hiển thị (display = 1) và là menu gốc (parentid = null)
            // Kèm theo menuCon (các menu cấp 2 của nó)
            $menus = Menu::where('display', 1)
                         ->whereNull('parentid')
                         ->with(['menuCon' => function($query) {
                             $query->where('display', 1); // Menu con cũng phải đang hiển thị
                         }])
                         ->orderBy('stt', 'asc') // Sắp xếp theo số thứ tự nếu có
                         ->get();

            $view->with('menus', $menus);
        });
    }
}