<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $news_categories = NewsCategory::paginate(20);
        return view('dashboard.news.news-category.index', compact('news_categories'));
    }

    public function create()
    {
        return view('dashboard.news.news-category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_en' => 'required',
        ]);

        $news_category = new NewsCategory();
        $news_category->name_uz = $request->name_uz;
        $news_category->name_ru = $request->name_ru;
        $news_category->name_en = $request->name_en;
        $news_category->save();

        return redirect()->route('newsCategory.index');
    }

    public function edit($id)
    {
        $news_category = NewsCategory::find($id);
        return view('dashboard.news.news-category.edit', compact('news_category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_en' => 'required',
        ]);

        $news_category = NewsCategory::find($id);
        $news_category->name_uz = $request->name_uz;
        $news_category->name_ru = $request->name_ru;
        $news_category->name_en = $request->name_en;
        $news_category->save();

        return redirect()->route('newsCategory.index');
    }

    public function destroy($id)
    {
        $news_category = NewsCategory::find($id);
        $news_category->delete();
        return redirect()->route('newsCategory.index');
    }
}
