<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Traits\UtilityTrait;

class CategoryController extends Controller
{
    use UtilityTrait;

    public function index()
    {
        $categories = Category::orderBy('updated_at', 'desc')->paginate(20);
        return view('dashboard.category.index', ['categories'=>$categories]);
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = (new CategoryService($request))->store();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', ['category'=>$category]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category = (new CategoryService($request, $category))->update();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        try {
            // delete images using UtilityTrait
            $this->deleteImages($category->images);

            $category->delete();
        } catch (\Exception $exception) {

        }

        return redirect()->back();
    }
}
