<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email', // Vẫn giữ để nếu sau này khách muốn bổ sung email nhận hóa đơn
        'password',
        'avata',
        'role',
        'phone',
        'address',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }


    // ==== CÁC HÀM LIÊN KẾT PHỤC VỤ DASHBOARD VÀ THANH TOÁN ====

    // User này có những đơn hàng nào
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // User này đang có gì trong giỏ hàng
    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
    
    // User này đã đánh giá sản phẩm nào
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }
}