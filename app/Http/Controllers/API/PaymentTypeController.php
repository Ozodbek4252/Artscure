<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;

class PaymentTypeController extends Controller
{
    public function index()
    {
        $payment_types = PaymentType::orderBy('updated_at', 'desc')->paginate(20);
        return PaymentTypeResource::collection($payment_types);
    }

    public function create()
    {
        return view('dashboard.payment_type.create');
    }

    public function show($id)
    {
        $payment_type = PaymentType::find($id);
        return new PaymentTypeResource($payment_type);
    }
}
