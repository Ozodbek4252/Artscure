<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request){
        $product_query = Product::with(['images', 'tools', 'type', 'artist'])->get();

        return $product_query;
        if ($product_query) {
            return response()->json([
                'results' => $product_query
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }
}
