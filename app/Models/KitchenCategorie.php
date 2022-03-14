<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenCategorie extends Model
{
    use HasFactory;

    public $table = 'kitchen_categories';

    public $fillable = ['name'];

    public $timestamps = false;
}
