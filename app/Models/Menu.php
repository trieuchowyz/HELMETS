<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parentid',
        'catid',
        'display',
        'stt'
    ];

    public function menuCon(){
        return $this->hasMany(Menu::class, "parentid", "id");
    }
}
