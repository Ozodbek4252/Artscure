<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\NewsRequest;

use App\Services\NewsService;

use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::all();
        $news = News::paginate(10);
        return view('dashboard.news.index', compact('categories', 'news'));
    }

    public function create()
    {
        $categories = NewsCategory::all();
        return view('dashboard.news.create', compact('categories'));
    }

    public function store(NewsRequest $request)
    {
        try {
            $news = (new NewsService($request))->store();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('news.index');
    }

    public function edit($slug)
    {
        try {
            $news = News::where('slug', $slug)->first();
            $categories = NewsCategory::all();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return view('dashboard.news.edit', compact('news', 'categories'));
    }

    public function update(NewsRequest $request, $slug)
    {
        try {
            $news = News::where('slug', $slug)->first();
            $news = (new NewsService($request, $news))->update();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('news.index');
    }

    public function destroy($slug)
    {
        try {
            $news = News::where('slug', $slug)->first();
            $news = (new NewsService())->delete($news);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('news.index');
    }
}
