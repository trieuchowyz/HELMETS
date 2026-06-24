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
        "detail",
        "color", // Vẫn giữ lại lỡ Frontend của bạn còn gọi tới
        "specs", // Thêm cột specs chứa thông số PC
        "catid",
        "img"
    ];

    // Ép kiểu JSON trong DB thành mảng (array) để sau này lấy thông số PC ra Frontend cực dễ
    protected $casts = [
        'specs' => 'array',
    ];

    // ==== GIỮ NGUYÊN 100% ĐỂ KHÔNG SẬP FRONTEND ====
    public function menu(){
        return $this->hasOne(Menu::class, 'catid', 'catid');
    }

    // ==== CÁC HÀM THÊM MỚI PHỤC VỤ DASHBOARD ADMIN ====
    
    // Sản phẩm thuộc Danh mục nào
    public function category()
    {
        return $this->belongsTo(Category::class, 'catid');
    }

    // Sản phẩm này nằm trong các chi tiết đơn hàng nào
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}