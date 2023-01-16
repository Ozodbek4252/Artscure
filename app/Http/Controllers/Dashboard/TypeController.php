<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\Category;
use App\Models\Type;
use App\Services\TypeService;
use App\Traits\UtilityTrait;

class TypeController extends Controller
{
    use UtilityTrait;

    public function index()
    {
        $types = Type::orderBy('updated_at', 'desc')->paginate(20);
        return view('dashboard.type.index', ['types'=>$types]);
    }

    public function create()
    {
        $categories = Category::orderBy('updated_at', 'desc')->get();
        return view('dashboard.type.create', ['categories'=>$categories]);
    }

    public function store(TypeRequest $request)
    {
        try {
            $category = (new TypeService($request))->store();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('types.index');
    }

    public function edit($slug)
    {
        $type = Type::where('slug', $slug)->first();
        $categories = Category::orderBy('updated_at', 'desc')->get();
        return view('dashboard.type.edit', [
            'type'=>$type,
            'categories'=>$categories
        ]);
    }

    public function update(TypeRequest $request, $slug)
    {
        try {
            $type = Type::where('slug', $slug)->first();
            (new TypeService($request, $type))->update();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('types.index');
    }

    public function destroy($slug)
    {
        try {
            $type = Type::where('slug', $slug)->first();
            $this->deleteImages($type->images);
            $type->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('types.index');
    }
}
