<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id', 
        'total_amount', 
        'payment_method', 
        'status', 
        'shipping_address'
    ];

    // Đơn hàng thuộc về User nào
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Lấy chi tiết các linh kiện trong đơn hàng
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}