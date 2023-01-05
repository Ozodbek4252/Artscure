<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'integer',
        'slug' => 'string',
        'product_id' => 'integer',
        'name' => 'string',
        'phone' => 'string',
        'payment_type' => 'string',
        'address' => 'string'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
