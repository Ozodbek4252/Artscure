<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\Toolable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\UtilityTrait;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    use UtilityTrait;
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
    public function store(ProductRequest $request)
    {
        $slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

        $attributes = $request->except(['image', 'tools']);
        $attributes['slug'] = $slug;
        $product = Product::create($attributes);

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

        if ($product) {
            return new ProductResource($product);
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
            'artist_id' => 'required|integer',
            'type_id' => 'required|integer',
            'image' => 'nullable',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        $new_slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

        $product = $request->except(['image', '_method']);
        $product['slug'] = $new_slug;

        $product = Product::updateOrCreate(['slug'=>$slug], $product);

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

        if ($product) {
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
        $product = Product::where('slug', $slug)->first();

        $this->deleteImages($product->images);

        $this->deleteTools($product->tools, 'App\Models\Product');

        $result = $product->delete();

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
