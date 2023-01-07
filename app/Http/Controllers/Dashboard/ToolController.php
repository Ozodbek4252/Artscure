<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tool;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::orderBy('updated_at', 'desc')->paginate(20);
        return view('dashboard.tool.index', ['tools'=>$tools]);
    }

    public function create()
    {
        $categories = Category::orderBy('updated_at', 'desc')->get();
        return view('dashboard.tool.create', ['categories'=>$categories]);
    }

    // public function store(TypeRequest $request)
    // {
    //     try {
    //         $category = (new TypeService($request))->store();
    //     } catch (\Exception $exception) {
    //         return redirect()->back()->withErrors($exception->getMessage());
    //     }

    //     return redirect()->route('types.index');
    // }

    // public function edit($slug)
    // {
    //     $type = Type::where('slug', $slug)->first();
    //     $categories = Category::orderBy('updated_at', 'desc')->get();
    //     return view('dashboard.type.edit', [
    //         'type'=>$type,
    //         'categories'=>$categories
    //     ]);
    // }

    // public function update(TypeRequest $request, $slug)
    // {
    //     try {
    //         $type = Type::where('slug', $slug)->first();
    //         (new TypeService($request, $type))->update();
    //     } catch (\Exception $exception) {
    //         return redirect()->back()->withErrors($exception->getMessage());
    //     }

    //     return redirect()->route('types.index');
    // }
}
