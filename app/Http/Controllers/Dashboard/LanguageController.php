<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeToEn()
    {
        App::setLocale('en');
        session()->put('lang', 'en');

        // session()->forget('lang');

        return redirect()->back();
    }

    public function changeToUz()
    {
        App::setLocale('uz');
        session()->put('lang', 'uz');

        return redirect()->back();
    }

    public function changeToRu()
    {
        App::setLocale('ru');
        session()->put('lang', 'ru');

        return redirect()->back();
    }

}
