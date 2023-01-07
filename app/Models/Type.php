<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tool;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'slug',
        'category_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'slug' => 'string',
        'name_uz' => 'string',
        'name_ru' => 'string',
        'name_en' => 'string',
        'category_id' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function tools()
    {
        return $this->hasMany(Tool::class);
    }

}
