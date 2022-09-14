<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contact::all();
    }

    public function paginate($num=null)
    {
        if($num){
            return Contact::paginate($num);
        }else{
            return Contact::all();
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
            'name' => 'required|min:3',
            'phone' => 'required',
        ]);
        
        $result = Contact::create($request->all());
        
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Contact::find($id)->delete();
        
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
