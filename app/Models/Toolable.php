<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toolable extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_id',
        'toolable_id',
        'toolable_type',
    ];
}
