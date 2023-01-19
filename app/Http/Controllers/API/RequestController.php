<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use App\Http\Requests\RequestRequest;
use App\Http\Resources\RequestResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requests = RequestModel::paginate($this->getLimit($request->limit));
        return RequestResource::collection($requests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRequest $request)
    {
        DB::beginTransaction();
        try {
            $requestModel = new RequestModel();
            $requestModel->full_name = $request->full_name;
            $requestModel->email = $request->email;
            $requestModel->phone = $request->phone;
            $requestModel->cover_letter = $request->cover_letter;
            $requestModel->portfolio = $request->portfolio;
            $requestModel->save();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->error("Address failed to store {$exception->getMessage()}", 400);
        }

        DB::commit();

        return new RequestResource($requestModel);
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
        return new RequestResource($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = RequestModel::find($id);

        if ($result && file_exists($result->portfolio)) {
            unlink($result->portfolio);
        }

        $result->delete();

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
