<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Bổ sung thêm 'specs' vào mảng fillable
    protected $fillable = [
        "name",
        "slug",
        "parent_id",
        "price",
        "quantity",
        "detail",
        "color",
        "specs",
        "catid",
        "img",
        "sku",
        "sale_price",
        "views",
        "status"
    ];

    // Ép kiểu JSON trong DB thành mảng (array) để sau này lấy thông số PC ra Frontend cực dễ
    protected $casts = [
        'specs' => 'array',
    ];

    // ==== GIỮ NGUYÊN 100% ĐỂ KHÔNG SẬP FRONTEND ====
    public function menu()
    {
        return $this->hasOne(Menu::class, 'catid', 'catid');
    }

    // ==== CÁC HÀM THÊM MỚI PHỤC VỤ DASHBOARD ADMIN ====

    public function category()
    {
        return $this->belongsTo(Category::class, 'catid');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}
