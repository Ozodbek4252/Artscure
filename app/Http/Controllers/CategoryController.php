<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Artist;
use App\Models\Type;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($count = null)
    {
        if ($count) {
            return Category::orderBy('updated_at')->take($count)->get();
        } else {
            return Category::all();
        }
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
    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return $category;
        } else {
            return response()->json([
                'message' => 'Category Not Found With This Id'
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_uz' => 'required|string|max:30',
            'name_ru' => 'required|string|max:30',
            'name_en' => 'required|string|max:30',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $category = $request->except(['image', '_method']);
        $result = Category::find($id)->update($category);

        if ($request->image) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/categories'), $imageName);

            $image = new Image();
            $image->image = 'images/categories/'.$imageName;
            $image->imageable_id = $id;
            $image->imageable_type = 'App\Models\Category';
            $image->save();
        }

        if ($result) {
            return response()->json([
                'message' => 'Updated Successfully'
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
    public function destroy($id)
    {
        $category = Category::find($id);
        
        if(count($category->images)>0){
            foreach($category->images as $image){
                if(file_exists($image->image)){
                    unlink($image->image);
                }
                Image::find($image->id)->delete();
            }
        }
        
        if (count($category->types)>0){
            foreach($category->types as $type){
                Type::find($type->id)->delete();
            }
        }
        
        if (count($category->artists)>0){
            foreach($category->artists as $artist){
                Artist::find($artist->id)->delete();
            }
        }

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
