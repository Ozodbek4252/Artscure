<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => 'string',
        'title_uz' => 'string',
        'title_ru' => 'string',
        'title_en' => 'string',
        'body_uz' => 'string',
        'body_ru' => 'string',
        'body_en' => 'string',
        'link' => 'string',
        'link_type' => 'string',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
