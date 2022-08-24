<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Type::all();
    }

    public function paginate($num = null)
    {
        if ($num) {
            return Type::paginate($num);
        } else {
            return Type::all();
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
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

        $result = Type::create($request->all());

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/types'), $imageName);

        $image = new Image();
        $image->image = $imageName;
        $image->imageable_id = $result->id;
        $image->imageable_type = 'App\Models\Type';
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
    public function show($slug)
    {
        $type = Type::where('slug', $slug)->first();
        $type->views = $type->views + 1;
        $type->save();
        if ($type) {
            return $type;
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
            'category_id' => 'required|integer',
        ]);
        $slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

        $type = Type::where('slug', $slug)->first();
        $type->name_uz = $request->name_uz;
        $type->name_ru = $request->name_ru;
        $type->name_en = $request->name_en;
        $type->slug = $slug;
        $type->category_id = $request->category_id;
        $type->save();

        if ($request->image) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/categories'), $imageName);
            $image = Image::where('imageable_id', $slug)->where('imageable_type', 'App\Models\Type')->first();
            $image->image = $imageName;
            $image->save();
        }

        if ($type) {
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
    public function destroy($slug)
    {
        $result = Type::where('slug', $slug)->delete();
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
