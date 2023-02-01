<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

use App\Models\Image;
use App\Models\Tool;
use App\Models\Category;
use App\Models\Product;

class Artist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'first_name_uz' => 'string',
        'first_name_ru' => 'string',
        'first_name_en' => 'string',
        'last_name_uz' => 'string',
        'last_name_ru' => 'string',
        'last_name_en' => 'string',

        'speciality' => 'string',
        'rate' => 'integer',
        'category_id' => 'integer',
        'views' => 'integer',
        'label' => 'string',

        'description_uz' => 'string',
        'description_ru' => 'string',
        'description_en' => 'string',
        'muzey_uz' => 'string',
        'muzey_ru' => 'string',
        'muzey_en' => 'string',
        'medal_uz' => 'string',
        'medal_ru' => 'string',
        'medal_en' => 'string',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->slug = str_replace(' ', '_', strtolower($model->first_name_uz)) . '-' . Str::random(8);
        });

        self::updating(function ($model) {
            if ($model->isDirty('first_name_uz')) {
                $model->slug = str_replace(' ', '_', strtolower($model->first_name_uz)) . '-' . Str::random(8);
            }
        });
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tools()
    {
        return $this->morphToMany(Tool::class, 'toolable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
