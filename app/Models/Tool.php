<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_uz', 
        'tool_ru', 
        'tool_en',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'toolable');
    }

    public function artists()
    {
        return $this->morphedByMany(Artist::class, 'toolable');
    }
}

