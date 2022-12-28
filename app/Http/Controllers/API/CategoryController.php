<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryRequest;

use App\Http\Resources\CategoryResource;

use App\Models\Category;
use App\Models\Image;

use App\Traits\UtilityTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use UtilityTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoris = Category::paginate($this->getLimit($request->limit));
        return CategoryResource::collection($categoris);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->except('image');
        $result = Category::create($category);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/categories'), $imageName);

        $image = new Image();
        $image->image = 'images/categories/' . $imageName;
        $image->imageable_id = $result->id;
        $image->imageable_type = 'App\Models\Category';
        $image->save();

        if ($result) {
            return response()->json(new CategoryResource($result), 200);
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
    public function show($id)
    {
        try {
            $category = Category::query()->findOrFail($id);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Not Found'
            ], 400);
        }

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $request->except(['image', '_method']);
        $result = Category::find($id);

        if ($request->image) {
            $this->deleteImages($result->images);

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/categories'), $imageName);

            $image = new Image();
            $image->image = 'images/categories/'.$imageName;
            $image->imageable_id = $id;
            $image->imageable_type = 'App\Models\Category';
            $image->save();
        }

        $result->update($category);

        if ($result) {
            return response()->json(new CategoryResource($result), 200);
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
    public function destroy($id)
    {
        $category = Category::find($id);

        $this->deleteImages($category->images);

        $this->deleteTypes($category->types);

        $this->deleteArtists($category->artists);

        $result = $category->delete();
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
