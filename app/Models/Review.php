<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
        'user_id', 
        'product_id', 
        'rating', 
        'comment', 
        'status'
    ];

    // Đánh giá này của User nào
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Đánh giá này thuộc Sản phẩm nào
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}