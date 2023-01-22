<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Artist;
use App\Models\Type;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name_uz',
        'name_ru',
        'name_en',
    ];

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Type::class);  
    }

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
