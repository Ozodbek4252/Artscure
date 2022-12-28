<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'toolable');
    }

    public function artists()
    {
        return $this->morphedByMany(Artist::class, 'toolable');
    }
}

