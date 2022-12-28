<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use App\Http\Requests\RequestRequest;
use App\Http\Resources\RequestResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->paginate($this->getLimit($request->limit));
    }

    public function paginate($num = null)
    {
        if ($num) {
            return RequestModel::paginate($num);
        } else {
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
        DB::beginTransaction();
        try {
            $requestModel = new RequestModel();
            $requestModel->full_name = $request->full_name;
            $requestModel->email = $request->email;
            $requestModel->phone = $request->phone;
            $requestModel->cover_letter = $request->cover_letter;

            if (!empty($request->portfolio)) {
                $fileName = time() . '_' . $request->portfolio->getClientOriginalName();
                $request->portfolio->move(public_path('files/requests'), $fileName);
                $request['portfolio'] = 'files/requests/' . $fileName;
                $requestModel->portfolio = 'files/requests/' . $fileName;
            } else {
                $requestModel->portfolio = null;
            }

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
