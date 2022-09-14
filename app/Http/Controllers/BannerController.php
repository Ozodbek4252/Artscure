<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Traits\UtilityTrait;

class BannerController extends Controller
{
    use UtilityTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Banner::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // type: 0 - top, 1 - bottom
        $request->validate([
            'type' => 'required',
            'title_uz' => 'required|min:5|max:100',
            'title_ru' => 'required|min:5|max:100',
            'title_en' => 'required|min:5|max:100',
            'body_uz' => 'required',
            'body_ru' => 'required',
            'body_en' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $banner = $request->except('image');
        $result = Banner::create($banner);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/banners'), $imageName);

        $image = new Image();
        $image->image = 'images/banners/'.$imageName;
        $image->imageable_id = $result->id;
        $image->imageable_type = 'App\Models\Banner';
        $image->save();

        if ($result) {
            return response()->json([
                'banner' => 'Created Successfully'
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
        $banners = Banner::where('id', $id)->first();
        if ($banners) {
            return $banners;
        } else {
            return response()->json([
                'banner' => 'Error'
            ], 500);
        }
    }

    public function main()
    {
        $banners = Banner::where('type', 0)->get();
        if ($banners) {
            return $banners;
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    public function bottom()
    {
        $banners = Banner::where('type', 1)->get();
        if ($banners) {
            return $banners;
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'title_uz' => 'required|min:5|max:100',
            'title_ru' => 'required|min:5|max:100',
            'title_en' => 'required|min:5|max:100',
            'body_uz' => 'required',
            'body_ru' => 'required',
            'body_en' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $banner = $request->except(['image', '_method']);
        $result = Banner::find($id)->update($banner);

        if ($request->image) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/banners'), $imageName);
            $image = new Image();
            $image->image = 'images/banners/'.$imageName;
            $image->imageable_id = $id;
            $image->imageable_type = 'App\Models\Banner';
            $image->save();
        }

        
        if ($result) {
            return response()->json([
                'banner' => 'Updated Successfully'
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
        $banner = Banner::find($id);

        $this->deleteImages($banner->images);

        $result = $banner->delete();
        if ($result) {
            return response()->json([
                'banner' => 'Delete Successfully'
            ], 200);
        } else {
            return response()->json([
                'banner' => 'Error'
            ], 500);
        }
    }
}
