<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Request;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    // use File;

    public function index()
    {
        $requests = Request::orderBy('created_at', 'desc')->paginate(20);
        return view('dashboard.request.index', ['requests' => $requests]);
    }

    public function destroy($id)
    {
        try {
            $request = Request::findOrFail($id);
            if (file_exists($request->portfolio)) {
                unlink($request->portfolio);
            }
            $request->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('requests.index');
    }
}
