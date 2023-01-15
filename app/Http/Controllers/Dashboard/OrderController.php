<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(20);
        return view('dashboard.order.index', [
            'orders' => $orders
        ]);
    }

    // public function store(OrderRequest $request)
    // {
    //     try {

    //     } catch (\Exception $exception) {
    //         return redirect()->back()->withErrors($exception->getMessage());
    //     }

    //     return redirect()->route('artists.index');
    // }

    public function edit($slug)
    {
        try {
            $order = Order::where('slug', $slug)->first();
            $products = Product::all();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return view('dashboard.order.edit', [
            'order' => $order,
            'products'=>$products,
        ]);
    }


    public function update(OrderRequest $request, $slug)
    {
        try {
            $order = Order::where('slug', $slug)->first();
            $order->update($request->except('_token', '_method'));
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('orders.index');
    }

    public function destroy($slug)
    {
        try {
            $order = Order::where('slug', $slug)->first();
            $order->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('orders.index');
    }
}
