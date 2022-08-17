<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
            'full_name',
            'phone',
            'email',
            'portfolio',
            'cover_letter_uz',
            'cover_letter_ru',
            'cover_letter_en',
    ];
}
