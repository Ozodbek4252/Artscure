<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tool::all();
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
            'tool_uz' => 'required|string',
            'tool_ru' => 'required|string',
            'tool_en' => 'required|string',
        ]);
        $tool = new Tool();
        $tool->tool_uz = $request->tool_uz;
        $tool->tool_ru = $request->tool_ru;
        $tool->tool_en = $request->tool_en;
        $result = $tool->save();

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
    public function show($id)
    {
        $tool = Tool::where('id', $id)->first();
        if ($tool) {
            return $tool;
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
            'tool_uz' => 'required|string|max:30',
            'tool_ru' => 'required|string|max:30',
            'tool_en' => 'required|string|max:30',
        ]);

        $result = Tool::find($id)->update($request->all());

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
        $result = Tool::find($id)->delete();
        if ($result) {
            return response()->json([
                'message' => 'Delete Successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

}
