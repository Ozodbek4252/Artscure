<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\ArtistRequest;
use App\Http\Resources\ArtistResource;

use App\Models\Artist;
use App\Models\Image;
use App\Models\Toolable;

use App\Traits\UtilityTrait;

class ArtistController extends Controller
{
    use UtilityTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoris = Artist::paginate($this->getLimit($request->limit));
        return ArtistResource::collection($categoris);
    }

    public function paginate($num = null)
    {
        if ($num) {
            return Artist::paginate($num);
        } else {
            return Artist::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistRequest $request)
    {
        $slug = str_replace(' ', '_', strtolower($request->first_name_uz) . '-' . strtolower($request->last_name_uz)) . '-' . Str::random(5);

        $artist = $request->except(['image']);

        // add slug
        $artist['slug'] = $slug;

        $artist = Artist::create($artist);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/artists'), $imageName);

        $image = new Image();
        $image->image = 'images/artists/' . $imageName;
        $image->imageable_id = $artist->id;
        $image->imageable_type = 'App\Models\Artist';
        $image->save();

        if ($request->tools) {
            foreach ($request->tools as $tool) {
                $toolable = new Toolable();
                $toolable->tool_id = $tool;
                $toolable->toolable_id = $artist->id;
                $toolable->toolable_type = 'App\Models\Artist';
                $toolable->save();
            }
        }

        if ($artist) {
            return new ArtistResource($artist);
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
            $artist = Artist::where('slug', $slug)->first();
            $artist->views = $artist->views + 1;
            $artist->save();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Not Found'
            ], 400);
        }

        return new ArtistResource($artist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistRequest $request, $slug)
    {
        $new_slug = str_replace(' ', '_', strtolower($request->first_name_uz) . '-' . strtolower($request->last_name_uz)) . '-' . Str::random(5);

        $attributes = $request->except(['image', '_method', 'tools']);

        $attributes['slug'] = $new_slug;


        $artist = Artist::where('slug', $slug)->first();
        $result =  $artist->update($attributes);
        $artist->refresh();

        if ($request->image) {
            $this->deleteImages($artist->images);

            $imageName = Str::random(5).'_'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/artists'), $imageName);

            $image = new Image();
            $image->image = 'images/artists/' .$imageName;
            $image->imageable_id = $artist->id;
            $image->imageable_type = 'App\Models\Artist';
            $image->save();
        }

        if ($request->tools) {
            foreach($artist->tools as $tool){
                $toolable = Toolable::where('tool_id', $tool->id)
                        ->where('toolable_type', 'App\Models\Artist')->first();
                $toolable->delete();
            }
            foreach ($request->tools as $tool) {
                $toolable = new Toolable();
                $toolable->tool_id = (int)$tool;
                $toolable->toolable_id = $artist->id;
                $toolable->toolable_type = 'App\Models\Artist';
                $toolable->save();
            }
        }

        if ($result) {
            return response()->json(new ArtistResource($artist->refresh()), 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 400);
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
        $artist = Artist::where('slug', $slug)->first();

        // using Trait
        $this->deleteImages($artist->images);

        $this->deleteTools($artist->tools, 'App\Models\Artist');

        $this->setNullToArtistId($artist->products);

        $result = $artist->delete();

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
