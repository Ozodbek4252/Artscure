<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;
use App\Models\Tool;
use App\Models\Artist;
use App\Models\Type;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_uz', 
        'name_ru', 
        'name_en', 
        'certificate', 
        'frame', 
        'size', 
        'description_uz', 
        'description_ru', 
        'description_en', 
        'year', 
        'city', 
        'unique', 
        'signiture', 
        'price',
        'type_id',
        'artist_id',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tools()
    {
        return $this->morphMany(Tool::class, 'toolable');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
