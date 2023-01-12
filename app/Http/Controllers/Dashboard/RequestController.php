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
        return view('dashboard.request.index', ['requests'=>$requests]);
    }
}

