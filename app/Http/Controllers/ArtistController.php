<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Artist::all();
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
            'first_name_uz' => 'required|string|max:30',
            'first_name_ru' => 'required|string|max:30',
            'first_name_en' => 'required|string|max:30',
            'last_name_uz' => 'required|string|max:30',
            'last_name_ru' => 'required|string|max:30',
            'last_name_en' => 'required|string|max:30',
            'description_uz' => 'required|string|max:30',
            'description_ru' => 'required|string|max:30',
            'description_en' => 'required|string|max:30',
            'category_id' => 'required|integer',
            'speciality' => 'required|string|max:30',
        ]);

        $slug = str_replace(' ', '_', strtolower($request->first_name_uz).'-'.strtolower($request->last_name_uz)).'-'.Str::random(5);
        $artist = new Artist();
        $artist->first_name_uz = $request->first_name_uz;
        $artist->first_name_ru = $request->first_name_ru;
        $artist->first_name_en = $request->first_name_en;
        $artist->last_name_uz = $request->last_name_uz;
        $artist->last_name_ru = $request->last_name_ru;
        $artist->last_name_en = $request->last_name_en;
        $artist->description_uz = $request->description_en;
        $artist->description_ru = $request->description_ru;
        $artist->description_en = $request->description_en;
        $artist->category_id = $request->category_id;
        $artist->speciality = $request->speciality;
        $artist->rate = $request->rate;
        $artist->muzey_uz = $request->muzey_uz;
        $artist->muzey_ru = $request->muzey_ru;
        $artist->muzey_en = $request->muzey_en;
        $artist->medal_uz = $request->medal_uz;
        $artist->medal_ru = $request->medal_ru;
        $artist->medal_en = $request->medal_en;
        $artist->label = $request->label;
        $artist->slug = $slug;
        $result = $artist->save();

        if($result){
            return response()->json([
                'message' => 'Created Successfully'
            ], 200);
        }else{
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
        $artist = Artist::where('slug', $slug)->first();
        $artist->views = $artist->views + 1;
        $artist->save();

        if($artist){
            return $artist;
        }else{
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
            'first_name_uz' => 'required|string|max:30',
            'first_name_ru' => 'required|string|max:30',
            'first_name_en' => 'required|string|max:30',
            'last_name_uz' => 'required|string|max:30',
            'last_name_ru' => 'required|string|max:30',
            'last_name_en' => 'required|string|max:30',
            'description_uz' => 'required|string|max:30',
            'description_ru' => 'required|string|max:30',
            'description_en' => 'required|string|max:30',
            'category_id' => 'required|integer',
            'speciality' => 'required|string|max:30',
        ]);

        $artist = Artist::where('slug', $slug)->first();
        $new_slug = str_replace(' ', '_', strtolower($request->first_name_uz).'-'.strtolower($request->last_name_uz)).'-'.Str::random(5);
        $artist->first_name_uz = $request->first_name_uz;
        $artist->first_name_ru = $request->first_name_ru;
        $artist->first_name_en = $request->first_name_en;
        $artist->last_name_uz = $request->last_name_uz;
        $artist->last_name_ru = $request->last_name_ru;
        $artist->last_name_en = $request->last_name_en;
        $artist->description_uz = $request->description_en;
        $artist->description_ru = $request->description_ru;
        $artist->description_en = $request->description_en;
        $artist->category_id = $request->category_id;
        $artist->speciality = $request->speciality;
        $artist->rate = $request->rate;
        $artist->muzey_uz = $request->muzey_uz;
        $artist->muzey_ru = $request->muzey_ru;
        $artist->muzey_en = $request->muzey_en;
        $artist->medal_uz = $request->medal_uz;
        $artist->medal_ru = $request->medal_ru;
        $artist->medal_en = $request->medal_en;
        $artist->label = $request->label;
        $artist->slug = $new_slug;
        $result = $artist->save();

        if($result){
            return response()->json([
                'message' => 'Updated Successfully'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    /**speciality
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $result = Artist::where('slug', $slug)->delete();
        if($result){
            return response()->json([
                'message' => 'Deleted Successfully'
            ], 200);
        }
    }
}
