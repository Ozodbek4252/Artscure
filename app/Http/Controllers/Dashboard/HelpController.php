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

    public function destroy($id)
    {
        try {
            $help = Help::find($id);
            $help->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('helps.index');
    }

}

