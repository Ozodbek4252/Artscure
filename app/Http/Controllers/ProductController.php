<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Toolable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    public function paginate($num = null)
    {
        if ($num) {
            return Product::paginate($num);
        } else {
            return Product::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_uz' => 'required|string|max:30',
            'name_ru' => 'required|string|max:30',
            'name_en' => 'required|string|max:30',
            'description_uz' => 'required|string',
            'description_ru' => 'required|string',
            'description_en' => 'required|string',
            'artist_id' => 'required|integer',
            'type_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

        $product = new Product();
        $product->name_uz = $request->name_uz;
        $product->name_ru = $request->name_ru;
        $product->name_en = $request->name_en;
        $product->certificate = $request->certificate;
        $product->frame = $request->frame;
        $product->size = $request->size;
        $product->status = $request->status;
        $product->description_uz = $request->description_uz;
        $product->description_ru = $request->description_ru;
        $product->description_en = $request->description_en;
        $product->type_id = $request->type_id;
        $product->artist_id = $request->artist_id;
        $product->year = $request->year;
        $product->city = $request->city;
        $product->unique = $request->unique;
        $product->signiture = $request->signiture;
        $product->price = $request->price;
        $product->slug = $slug;
        $result = $product->save();
        
        foreach ($request->image as $photo) {
            $imageName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/products'), $imageName);
            $img = new Image();
            $img->image = 'images/products/'.$imageName;
            $img->imageable_id = $product->id;
            $img->imageable_type = 'App\Models\Product';
            $img->save();
        }

        if ($request->tools) {
            foreach ($request->tools as $tool) {
                $toolable = new Toolable();
                $toolable->tool_id = $tool;
                $toolable->toolable_id = $product->id;
                $toolable->toolable_type = 'App\Models\Product';
                $toolable->save();
            }
        }



        if ($result) {
            return response()->json([
                'message' => 'Created Successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            return $product;
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name_uz' => 'required|string|max:30',
            'name_ru' => 'required|string|max:30',
            'name_en' => 'required|string|max:30',
            'description_uz' => 'required|string',
            'description_ru' => 'required|string',
            'description_en' => 'required|string',
            'image[]' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
        ]);

        
        $new_slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);
        
        $product = Product::where('slug', $slug)->first();
        $product->name_uz = $request->name_uz;
        $product->name_ru = $request->name_ru;
        $product->name_en = $request->name_en;
        $product->certificate = $request->certificate;
        $product->frame = $request->frame;
        $product->size = $request->size;
        $product->status = $request->status;
        $product->description_uz = $request->description_uz;
        $product->description_ru = $request->description_ru;
        $product->description_en = $request->description_en;
        $product->type_id = $request->type_id;
        $product->artist_id = $request->artist_id;
        $product->year = $request->year;
        $product->city = $request->city;
        $product->unique = $request->unique;
        $product->signiture = $request->signiture;
        $product->price = $request->price;
        $product->slug = $new_slug;
        $result = $product->save();

        if ($request->image) {
            foreach ($request->image as $photo) {
                $imageName = Str::random(5) . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('images/products'), $imageName);

                $img = new Image();
                $img->image = 'images/products/'.$imageName;
                $img->imageable_id = $product->id;
                $img->imageable_type = 'App\Models\Product';
                $img->save();
            }
        }

        if ($result) {
            return response()->json([
                'message' => 'Update Successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $result = Product::where('slug', $slug)->delete();
        if ($result) {
            return response()->json([
                'message' => 'Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }
}
