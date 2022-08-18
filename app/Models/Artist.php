<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;
use App\Models\Tool;
use App\Models\Category;
use App\Models\Product;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name_uz',
        'first_name_ru',
        'first_name_en',
        'last_name_uz',
        'last_name_ru',
        'last_name_en',
        'speciality',
        'rate',
        'category_id',
        'description_uz',
        'description_ru',
        'description_en',
        'muzey_uz',
        'muzey_ru',
        'muzey_en',
        'medal_ru',
        'medal_ru',
        'medal_en',
        'label',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tools()
    {
        return $this->morphMany(Tool::class, 'toolable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}