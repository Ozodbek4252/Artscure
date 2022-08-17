<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RequestModel::all();
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
            'full_name' => 'required',
            'phone' => 'required',
            'cover_letter_uz' => 'required|min:30',
            'cover_letter_ru' => 'required|min:30',
            'cover_letter_en' => 'required|min:30',
        ]);
        
        $result = RequestModel::create($request->all());

        if ($result) {
            return response()->json([
                'request' => 'Created Succesfully'
            ], 200);
        } else {
            return response()->json([
                'request' => 'Error'
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
        $result = RequestModel::find($id);
        if($result){
            return $result;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = RequestModel::find($id)->delete();
        if ($result) {
            return response()->json([
                'request' => 'Delete Succesfully'
            ], 200);
        } else {
            return response()->json([
                'request' => 'Error'
            ], 500);
        }
    }
}