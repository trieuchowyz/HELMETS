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
        'min_order_amount', 
        'quantity', 
        'start_date', 
        'end_date', 
        'status'
    ];
}