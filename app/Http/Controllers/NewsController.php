<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($count = null)
    {
        if ($count) {
            return News::orderBy('updated_at')->take($count)->get();
        } else {
            return News::all();
        }
    }

    public function paginate($num = null)
    {
        if ($num) {
            return News::paginate($num);
        } else {
            return News::all();
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
            'title_uz' => 'required|string|max:30',
            'title_ru' => 'required|string|max:30',
            'title_en' => 'required|string|max:30',
            'body_uz' => 'required|string',
            'body_ru' => 'required|string',
            'body_en' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $slug = str_replace(' ', '_', strtolower($request->title_uz)) . '-' . Str::random(5);


        $news = new News();
        $news->title_uz     = $request->title_uz;
        $news->title_ru = $request->title_ru;
        $news->title_en = $request->title_en;
        $news->body_uz = $request->body_uz;
        $news->body_ru = $request->body_ru;
        
        $news->body_en = $request->body_en;
        $news->category_id = $request->category_id;
        $news->slug = $slug;
        $result = $news->save();

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/news'), $imageName);

        $image = new Image();
        $image->image = 'images/news/'.$imageName;
        $image->imageable_id = $news->id;
        $image->imageable_type = 'App\Models\News';
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
        $news = News::where('slug', $slug)->first();
        if ($news) {
            return $news;
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
            'title_uz' => 'required|string|max:30',
            'title_ru' => 'required|string|max:30',
            'title_en' => 'required|string|max:30',
            'body_uz' => 'required|string',
            'body_ru' => 'required|string',
            'body_en' => 'required|string',
            'category_id' => 'required|integer',
        ]);

        $new_slug = str_replace(' ', '_', strtolower($request->title_uz)) . '-' . Str::random(5);

        $news = News::where('slug', $slug)->first();
        $news->title_uz     = $request->title_uz;
        $news->title_ru = $request->title_ru;
        $news->title_en = $request->title_en;
        $news->slug = $new_slug;
        $news->title_en = $request->title_en;
        $news->body_uz = $request->body_uz;
        $news->body_ru = $request->body_ru;
        $news->body_en = $request->body_en;
        $news->category_id = $request->category_id;
        $result = $news->save();

        if ($request->image) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/news'), $imageName);
            $image = Image::where('imageable_id', $slug)->where('imageable_type', 'App\Models\News')->first();
            $image->image = $imageName;
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
    public function destroy($slug)
    {
        $result = News::where('slug', $slug)->delete();
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
