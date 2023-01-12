<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Help;

class HelpController extends Controller
{
    public function index()
    {
        $helps = Help::orderBy('created_at', 'desc')->paginate(20);
        return view('dashboard.help.index', ['helps'=>$helps]);
    }

}

