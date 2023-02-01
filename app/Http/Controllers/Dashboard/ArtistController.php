<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtistRequest;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Tool;
use App\Models\Toolable;
use App\Models\Type;
use App\Services\ArtistService;
use Illuminate\Http\Request;

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

    public function store(ArtistRequest $request)
    {
        try {
            $artist = (new ArtistService($request))->store();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('artists.index');
    }

    public function edit($slug)
    {
        try {
            $artist = Artist::where('slug', $slug)->first();
            $categories = Category::all();
            $tools = Tool::all();
            $types = Type::all();
            $toolables = Toolable::where('toolable_type', 'App\Models\Artist')->where('toolable_id', $artist->id)->get();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return view('dashboard.artist.edit', [
            'artist'=>$artist,
            'categories' => $categories,
            'tools' => $tools,
            'types' => $types,
            'toolables' => $toolables,
        ]);
    }

    public function update(ArtistRequest $request, $slug)
    {
        try {
            $artist = Artist::where('slug', $slug)->first();
            $artist = (new ArtistService($request, $artist))->update();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('artists.index');
    }

    public function destroy($slug)
    {
        try {
            $artist = Artist::where('slug', $slug)->first();
            $artist = (new ArtistService())->delete($artist);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('artists.index');
    }

}

