<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToolRequest;
use App\Http\Resources\ToolResource;
use App\Models\Image;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Traits\UtilityTrait;

class ToolController extends Controller
{
    use UtilityTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->limit) {
            return ToolResource::collection(Tool::paginate($this->getLimit($request->limit)));
        } else {
            return ToolResource::collection(Tool::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToolRequest $request)
    {
        $tool = new Tool();
        $tool->name_uz = $request->name_uz;
        $tool->name_ru = $request->name_ru;
        $tool->name_en = $request->name_en;
        $result = $tool->save();

        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/tools'), $imageName);

            $image = new Image();
            $image->image = 'images/tools/' . $imageName;
            $image->imageable_id = $tool->id;
            $image->imageable_type = 'App\Models\Tool';
            $image->save();
        }

        if($result){
            return response()->json(new ToolResource($tool), 201);
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
        $tool = Tool::find($id);

        if ($tool) {
            return new ToolResource($tool);
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ToolRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $tool = Tool::find($id);
            $attributes = $request->only('name_uz', 'name_ru', 'name_en');
            $tool->update($attributes);
            if (!empty($request->image)) {
                $this->deleteImages($tool->images);

                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/tools'), $imageName);

                $image = new Image();
                $image->image = 'images/tools/' . $imageName;
                $image->imageable_id = $tool->id;
                $image->imageable_type = 'App\Models\Tool';
                $image->save();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error occured'
            ], 400);
        }

        DB::commit();

        return new ToolResource($tool->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tool = Tool::find($id);
        $this->deleteImages($tool->images);
        $result = $tool->delete();
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
