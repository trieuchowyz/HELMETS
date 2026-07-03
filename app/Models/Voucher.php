<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';
    protected $fillable = [
        'code', 
        'discount_amount', 
        'discount_type', 
        'max_discount_amount',
        'product_id',
        'min_order_amount', 
        'quantity', 
        'start_date', 
        'end_date', 
        'status'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}