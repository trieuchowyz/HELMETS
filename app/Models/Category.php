<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'parentid'];

    // Lấy các danh mục con (ví dụ: Linh kiện PC -> CPU, VGA...)
    public function children()
    {
        return $this->hasMany(Category::class, 'parentid');
    }

    // Lấy danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parentid');
    }

    // Lấy tất cả sản phẩm thuộc danh mục này
    public function products()
    {
        return $this->hasMany(Product::class, 'catid');
    }
}