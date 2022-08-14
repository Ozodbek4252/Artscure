<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NewsCategory;
use App\Models\Image;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    public function category()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
