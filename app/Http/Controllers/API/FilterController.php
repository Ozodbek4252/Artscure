<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filter(Request $request){
        $product_query = Product::with(['images', 'tools', 'type', 'artist']);

        // check price and get
        $product_query->when(isset($request->price), function ($query) use ($request) {
            return $query->where('price', '>=', $request->price);
        });

        // check type_id and get
        $product_query->when(isset($request->type_id), function ($query) use ($request){
            return $query->where('type_id', $request->type_id);
        });

        // check size and get
        $product_query->when(isset($request->size), function ($query) use ($request){
            return $query->where('size', 'LIKE', '%'.$request->size.'%');
        });


        // $product_query->when(isset($request->tools), function ($query) use ($request) {
        //     return $query->where();
        //     foreach($query as $quer){
        //         foreach($quer->tools as $tool){
        //             if($tool['id'] == $request->tools){
        //                 array_push($arr, $query->id);
        //             }
        //         }
        //     }
        // });


        $result = $product_query;

        return $result->get();
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
