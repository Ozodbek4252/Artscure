<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title_uz',
        'title_ru',
        'title_en',
        'body_uz',
        'body_ru',
        'body_en',
    ]; 

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
