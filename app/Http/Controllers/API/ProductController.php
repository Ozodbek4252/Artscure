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
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    use UtilityTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::paginate($this->getLimit($request->limit));
        return ProductResource::collection($products);
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
            $imageName = Str::random(5).'-'.time().'.'.$photo->getClientOriginalExtension();
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
        try {
            $product = Product::where('slug', $slug)->first();
            $product->views = $product->views + 1;
            $product->save();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Not Found'
            ], 400);
        }

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $slug)
    {
        $new_slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

        $attributes = $request->except(['images', '_method']);
        $attributes['slug'] = $new_slug;

        $product = Product::where('slug', $slug)->first();
        $result = $product->update($attributes);

        if ($request->images) {
            $this->deleteImages($product->images);

            foreach ($request->images as $photo) {
                $imageName = Str::random(5).'_'.time().'.'.$photo->getClientOriginalExtension();
                $photo->move(public_path('images/products'), $imageName);

                $img = new Image();
                $img->image = 'images/products/'.$imageName;
                $img->imageable_id = $product->id;
                $img->imageable_type = 'App\Models\Product';
                $img->save();
            }
        }

        if ($request->tools) {
            foreach($product->tools as $tool){
                $toolable = Toolable::where('tool_id', $tool->id)
                ->where('toolable_type', 'App\Models\Product')->first();
                $toolable->delete();
            }
            foreach ($request->tools as $tool) {
                $toolable = new Toolable();
                $toolable->tool_id = (int)$tool;
                $toolable->toolable_id = $product->id;
                $toolable->toolable_type = 'App\Models\Product';
                $toolable->save();
            }
        }

        if ($result) {
            return response()->json(new ProductResource($product->refresh()), 200);
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
