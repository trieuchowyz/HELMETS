<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // ==== CÁC HÀM THÊM MỚI PHỤC VỤ DASHBOARD VÀ THANH TOÁN ====

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
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }
}
