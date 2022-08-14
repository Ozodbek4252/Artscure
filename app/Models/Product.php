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
        return $this->belongsTo(Type::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
