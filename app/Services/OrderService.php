<?php

namespace App\Services;

use App\Exceptions\Order\OrderNotFoundException;
use App\Exceptions\Order\OrderStoreException;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderService
{
    public $attributes;
    public $order;
    public $products;

    public function __construct($request = null)
    {
        if ($request != null) {
            $this->attributes = $request->only(['name', 'phone', 'payment_type', 'address', 'email']);
            $this->attributes['slug'] = uniqid();
            $this->products = $request->products;
            $this->attributes['total_price'] = 0;
            $this->attributes['status'] = 'pending';
            foreach ($this->products as $product_id) {
                $this->attributes['total_price'] += Product::find($product_id)['price'];
            }
        } else {
            $this->attributes = null;
        }
    }

    public function setOrderBySlug($slug)
    {
        $this->order = Order::where('slug', $slug)->first();
        return $this;
    }

    public function getOrder()
    {
        if ($this->order) {
            return $this->order;
        } else {
            throw new OrderNotFoundException('Order Not Found');
        }
    }

    /**
     * @throws OrderStoreException
     */
    public function store()
    {
        DB::beginTransaction();

        try {
            $this->order = Order::create($this->attributes);
            foreach ($this->products as $product) {
                $order_product = new OrderProduct();
                $order_product->order_id = $this->order->id;
                $order_product->product_id = Product::find($product)->id;
                $order_product->save();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new OrderStoreException("Cannot store. Error:{$exception->getMessage()}");
        }

        DB::commit();

        return $this;
    }
}
