<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentTypeRequest;
use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function index()
    {
        $payment_types = PaymentType::orderBy('updated_at', 'desc')->paginate(20);
        return view('dashboard.payment_type.index', compact('payment_types'));
    }

    public function create()
    {
        return view('dashboard.payment_type.create');
    }

    public function store(PaymentTypeRequest $request)
    {
        try {
            $payment_type = new PaymentType();
            $payment_type->name = $request->name;
            $payment_type->save();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('paymentTypes.index');
    }

    public function show($id)
    {
        $payment_type = PaymentType::find($id);
        return new PaymentTypeResource($payment_type);
    }

    public function edit($id)
    {
        try {
            $payment_type = PaymentType::find($id);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return view('dashboard.payment_type.edit', compact('payment_type'));
    }

    public function update(Request $request, $id)
    {
        try {
            $payment_type = PaymentType::find($id);
            $payment_type->name = $request->name;
            $payment_type->save();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('paymentTypes.index');
    }

    public function destroy($id)
    {
        try {
            $payment_type = PaymentType::find($id);
            $payment_type->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('paymentTypes.index');
    }
}
