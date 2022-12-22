<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\HelpRequest;

use App\Http\Resources\ErrorResource;

use App\Models\Help;

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
            $helps = Help::paginate($request->get('num'));
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
            Help::create($request->all());
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json(['message' => 'Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        try {
            $help = Help::find($id);
            $help->delete();
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json(['message' => 'Deleted Successfully'], 200);
    }
}
