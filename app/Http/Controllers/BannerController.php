<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
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
        $request->validate([
            'type' => 'required',
            'title_uz' => 'required|min:10|max:100',
            'title_ru' => 'required|min:10|max:100',
            'title_en' => 'required|min:10|max:100',
            'body_uz' => 'required',
            'body_ru' => 'required',
            'body_en' => 'required',
        ]);

        $result = Banner::create($request->all());

        if($result){
            return response()->json([
                'banner' => 'Created Successfully'
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

    public function main(){
        $banners = Banner::where('type', 0)->get();
        if($banners){
            return $banners;
        }else{
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    public function bottom(){
        $banners = Banner::where('type', 1)->get();
        if($banners){
            return $banners;
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'title_uz' => 'required|min:10|max:100',
            'title_ru' => 'required|min:10|max:100',
            'title_en' => 'required|min:10|max:100',
            'body_uz' => 'required',
            'body_ru' => 'required',
            'body_en' => 'required',
        ]);

        $result = Banner::find($id)->update($request->all());

        if($result){
            return response()->json([
                'banner' => 'Updated Successfully'
            ], 200);
        }else{
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
        $result = Banner::find($id)->delete();
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
