<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\ContactResource;

use App\Http\Requests\ContactRequest;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $contact = Contact::paginate($request->get('num'));
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return $contact;
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
    public function store(ContactRequest $request)
    {
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->phone = $request->phone;
            $contact->email = $request->email;
            $contact->save();
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return (new ContactResource($contact))->response()->setStatusCode(202);
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
            $result = Contact::find($id)->delete();
        } catch (\Exception $exception) {
            return (new ErrorResource("Client Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return response()->json(['message' => 'Deleted Successfully'], 200);
    }
}
