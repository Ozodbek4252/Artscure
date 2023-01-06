<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.category');
    }
}
