<?php

namespace App\Http\Controllers\API;

use App\Exceptions\Order\OrderNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::paginate($this->getLimit($request->limit));
        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request)
    {
        try {
            $order = (new OrderService($request))->store()->getOrder();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Not Found'
            ], 400);
        }

        return new OrderResource($order);
    }

    public function show($slug)
    {
        try {
            $order = (new OrderService())
            ->setOrderBySlug($slug)
            ->getOrder();
        } catch (OrderNotFoundException $th) {
            return $this->error($th->getMessage(), 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Not Found'
            ], 400);
        }

        return new OrderResource($order);
    }
}
