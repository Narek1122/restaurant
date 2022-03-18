<?php

namespace App\Models\Restaurant;

use App\Models\Day;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'desc',
        'address',
        'longit',
        'latit',
        'parent_id',
        'user_id'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function mainImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('main_img',1);
    }

    public function days()
    {
        return $this->belongsToMany(Day::class,'work_days','restaurant_id','day_id')->withPivot('start as start','end as end');
    }

    public function parent()
    {
        return $this->hasOne(self::class,'id','parent_id');
    }

}
