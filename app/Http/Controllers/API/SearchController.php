<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;


class SearchController extends Controller
{

    public function search(Request $request)
    {
        $result = [];
        $result['artists'] = Artist::where("first_name_uz", "Like", "%" . $request->search . "%")
            ->orWhere('first_name_ru', "Like", "%" . $request->search . "%")
            ->orWhere('first_name_en', "Like", "%" . $request->search . "%")
            ->orWhere('last_name_uz', "Like", "%" . $request->search . "%")
            ->orWhere('last_name_ru', "Like", "%" . $request->search . "%")
            ->orWhere('last_name_en', "Like", "%" . $request->search . "%")
            ->orWhere('speciality', "Like", "%" . $request->search . "%")
            ->orWhere('description_uz', "Like", "%" . $request->search . "%")
            ->orWhere('description_ru', "Like", "%" . $request->search . "%")
            ->orWhere('description_en', "Like", "%" . $request->search . "%")
            ->get();

        $result['products'] = Product::where('name_uz', "Like", "%" . $request->search . "%")
            ->orWhere('name_ru', "Like", "%" . $request->search . "%")
            ->orWhere('name_en', "Like", "%" . $request->search . "%")
            ->orWhere('description_uz', "Like", "%" . $request->search . "%")
            ->orWhere('description_ru', "Like", "%" . $request->search . "%")
            ->orWhere('description_en', "Like", "%" . $request->search . "%")
            ->get();

        return $result;
    }
}
