<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use App\Http\Requests\RequestRequest;

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

    public function paginate($num=null)
    {
        if($num){
            return RequestModel::paginate($num);
        }else{
            return RequestModel::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRequest $request)
    {
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
