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

    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'integer',
        'slug' => 'string',
        'sku' => 'string',
        'name_uz' => 'string',
        'name_ru' => 'string',
        'name_en' => 'string',
        'certificate'  => 'boolean',
        'frame' => 'boolean',
        'size' => 'string',
        'description_uz' => 'string',
        'description_ru' => 'string',
        'description_en' => 'string',
        'year' => 'integer',
        'city' => 'string',
        'unique' => 'boolean',
        'signiture' => 'boolean',
        'price' => 'integer',
        'type_id' => 'integer',
        'artist_id' => 'integer',
        'status' => 'string',
        'resell' => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            do {
                function random_str($num)
                {
                    $chars = 'abcdefghijklmnopqrstuvwxyz';
                    $size = strlen($chars);
                    $str = '';
                    for ($i = 0; $i < $num; $i++) {
                        $str = $str . '' . $chars[rand(0, $size - 1)];
                    }
                    return $str;
                }
                $str = random_str(5) . rand(10000, 99999);
            } while (self::where('sku', $str)->exists());

            $model->sku = $str;
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

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Orders::class, 'order_products', 'product_id', 'order_id');
    }
}
