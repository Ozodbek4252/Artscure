<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guraded = ['id'];

    protected $casts = [
        "id" => "integer",
        "name" => "string",
        "phone" => "string",
        "email" => "string"
    ];
}
