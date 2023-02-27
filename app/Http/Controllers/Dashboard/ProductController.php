<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

use App\Services\ProductService;

use App\Models\Artist;
use App\Models\Product;
use App\Models\Tool;
use App\Models\Toolable;
use App\Models\Type;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('updated_at', 'desc')->paginate(20);
        return view('dashboard.product.index', [
            'products' => $products
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('dashboard.product.single', [
            'product'=>$product,
        ]);
    }

    public function create()
    {
        $artists = Artist::all();
        $types = Type::all();
        $tools = Tool::all();
        return view('dashboard.product.create', [
            'artists' => $artists,
            'types' => $types,
            'tools' => $tools,
        ]);
    }

    public function store(ProductRequest $request)
    {
        try {
            (new ProductService($request))->store();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('products.index');
    }

    public function edit($slug)
    {
        try {
            $artists = Artist::all();
            $types = Type::all();
            $tools = Tool::all();
            $product = Product::where('slug', $slug)->first();
            $toolables = Toolable::where('toolable_type', 'App\Models\Product')->where('toolable_id', $product->id)->get();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return view('dashboard.product.edit', [
            'product' => $product,
            'artists' => $artists,
            'types' => $types,
            'tools' => $tools,
            'toolables' => $toolables
        ]);
    }

    public function update(ProductRequest $request, $slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            $product = (new ProductService($request, $product))->update();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('products.index');
    }

    public function destroy($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            $product = (new ProductService())->delete($product);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('products.index');
    }
}
