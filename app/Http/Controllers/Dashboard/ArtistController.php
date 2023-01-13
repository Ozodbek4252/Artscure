<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Tool;
use App\Models\Type;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::orderBy('updated_at', 'desc')->paginate(20);
        return view('dashboard.artist.index', ['artists'=>$artists]);
    }

    public function show($slug)
    {
        $artist = Artist::where('slug', $slug)->first();
        return view('dashboard.artist.single', [
            'artist'=>$artist,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $tools = Tool::all();
        $types = Type::all();
        return view('dashboard.artist.create', [
            'categories' => $categories,
            'tools' => $tools,
            'types' => $types
        ]);
    }

}
