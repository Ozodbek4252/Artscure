<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyValue;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::paginate(20);
        return view('dashboard.currency.index', compact('currencies'));
    }

    public function create()
    {
        return view('dashboard.currency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        $currency = new Currency();
        $currency->name = $request->name;
        $currency->value = $request->value;
        $currency->save();

        return redirect()->route('currencies.index');
    }

    public function edit(Currency $currency)
    {
        return view('dashboard.currency.edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        $currency->name = $request->name;
        $currency->value = $request->value;
        $currency->save();

        return redirect()->route('currencies.index');
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->route('currencies.index');
    }
}
