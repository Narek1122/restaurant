<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $table = 'menu';

    public $fillable = [
        'name',
        'restaurant_id',
        'category_id',
        'price',
        'img',
        'desc',
        'sale_price'

    ];

    public function rest()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id','id');
    }

    public function category()
    {
        return $this->hasOne(MenuCategory::class,'id','category_id');
    }
}
