<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $timestamps = false; // Bảng này không có created_at, updated_at
    protected $table = 'order_details';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Chi tiết này thuộc đơn hàng nào
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Chi tiết này là sản phẩm nào (để lấy tên, hình ảnh)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}