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

    protected $guarded = ['id'];

    protected $casts = [
        'first_name_uz' => 'string',
        'first_name_ru' => 'string',
        'first_name_en' => 'string',
        'last_name_uz' => 'string',
        'last_name_ru' => 'string',
        'last_name_en' => 'string',
        'description_uz' => 'string',
        'description_ru' => 'string',
        'description_en' => 'string',

        'speciality' => 'string',
        'rate' => 'integer',
        'category_id' => 'integer',
        'views' => 'integer',
        'muzey_uz' => 'string',
        'muzey_ru' => 'string',
        'muzey_en' => 'string',
        'medal_uz' => 'string',
        'medal_ru' => 'string',
        'medal_en' => 'string',
        'label' => 'string',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tools()
    {
        return $this->morphToMany(Tool::class, 'toolable');
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
