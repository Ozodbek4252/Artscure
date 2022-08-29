<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Image;
use App\Models\Toolable;
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

    public function paginate($num=null)
    {
        if($num){
            return Artist::paginate($num);
        }else{
            return Artist::all();
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
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $slug = str_replace(' ', '_', strtolower($request->first_name_uz).'-'.strtolower($request->last_name_uz)).'-'.Str::random(5);
        
        $artist = $request->except('image');
        $result = Artist::create($artist);
        
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/artists'), $imageName);

        $image = new Image();
        $image->image = 'images/artists/' . $imageName;
        $image->imageable_id = $request->id;
        $image->imageable_type = 'App\Models\Artist';
        $image->save();

        if($request->tools){
            foreach($request->tools as $tool){
                $toolable = new Toolable();
                $toolable->tool_id = $tool;
                $toolable->toolable_id = $result->id;
                $toolable->toolable_type = 'App\Models\Artist';
                $toolable->save();
            }
        }

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
        
        $artist = $request->except(['image', '_method']);
        $result = Artist::find($slug)->update($artist);

        if ($request->image) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/artists'), $imageName);

            $image = new Image();
            $image->image = 'images/artists/'.$imageName;
            $image->imageable_id = $slug;
            $image->imageable_type = 'App\Models\Artist';
            $image->save();
        }

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
