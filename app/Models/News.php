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

    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'integer',
        'slug' => 'string',
        'title_uz' => 'string',
        'title_ru' => 'string',
        'title_en' => 'string',
        'body_uz' => 'string',
        'body_ru' => 'string',
        'body_en' => 'string',
        'category_id' => 'integer',
        'video_link' => 'string',
        'views' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
