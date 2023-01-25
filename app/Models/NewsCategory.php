<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\News;

class NewsCategory extends Model
{
    use HasFactory;

    protected $table = 'news_categories';

    protected $guraded = ['id'];

    protected $casts = [
        'id' => 'integer',
        'name_uz' => 'string',
        'name_ru' => 'string',
        'name_en' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
