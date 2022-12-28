<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Artist;
use App\Models\Image;
use App\Models\Product;
use App\Models\Type;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'type_id'
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

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

}

