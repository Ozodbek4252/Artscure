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
        'name' => 'string',
        'phone' => 'string',
        'payment_type' => 'string',
        'address' => 'string',
        'status' => 'string',
        'total_price' => 'string',
        'email' => 'string',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }

}
