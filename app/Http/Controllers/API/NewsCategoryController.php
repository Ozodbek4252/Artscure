<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;


class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NewsCategory::all();
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
        ]);

        $categorynews = NewsCategory::create($request->all());

        if($categorynews){
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
    public function show($id)
    {
        $categorynews = NewsCategory::find($id);
        if($categorynews){
            return $categorynews;
        }else{
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
        ]);
        $result = NewsCategory::find($id)->update($request->all());
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = NewsCategory::find($id);
        if (count($result->news)>0){
            foreach($result->news as $news){
                return $news;
            }
        };

        return $result->news;
        if($result){
            return response()->json([
                'message' => 'Deleted Successfully'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

}

