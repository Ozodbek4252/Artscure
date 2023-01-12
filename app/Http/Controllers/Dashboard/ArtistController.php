<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Artist;

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
        // $artist_products = $artist->products;
        return view('dashboard.artist.single', [
            'artist'=>$artist,
            // 'artist_products' => $artist_products
        ]);
    }

}
