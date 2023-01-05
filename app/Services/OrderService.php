<?php

namespace App\Services;

use App\Exceptions\Order\OrderNotFoundException;
use App\Exceptions\Order\OrderStoreException;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderService
{
    public $request;
    public $order;
    // public $client;
    // public $order;

    public function __construct($request = null)
    {
        if ($request != null) {
            $this->request = $request->only(['name', 'phone']);
        } else {
            $this->request = null;
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
            $this->order = Order::create($this->request);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new OrderStoreException("Cannot store. Error:{$exception->getMessage()}");
        }
        DB::commit();
        return $this;
    }
}
