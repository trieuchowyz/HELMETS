<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Kế thừa để dùng được Auth::login()
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'staffs';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'role',
        'salary',
        'hire_date',
        'status',
        'avata'
    ];

    // Ẩn mật khẩu và token khi truy vấn để bảo mật
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Ép kiểu dữ liệu tự động
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'hire_date' => 'date',
        ];
    }
}