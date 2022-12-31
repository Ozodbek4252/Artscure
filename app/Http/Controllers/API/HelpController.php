<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\HelpRequest;

use App\Http\Resources\HelpResource;
use App\Http\Resources\ErrorResource;

use App\Models\Help;
use App\Services\HelpService;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $helps = Help::paginate($request->get('limit'));
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return $helps;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HelpRequest $request)
    {
        try {
            $help = (new HelpService($request))->store()->help;
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }


        return response()->json(new HelpResource($help), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $help = Help::find($id);
            $help->delete();
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json(['message' => 'Deleted Successfully'], 200);
    }
}
