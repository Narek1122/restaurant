<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorPlane extends Model
{
    use HasFactory;

    public $table = 'floor_planes';

    public $fillable = [
        'restaurant_id',
        'hall_name',
        'background_img',
        'table_x',
        'table_y',
        'data_json',
        'description'
        ];
}
