<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Artist;
use App\Models\Banner;
use App\Models\Product;
use App\Services\BannerService;
use App\Traits\UtilityTrait;

class BannerController extends Controller
{
    use UtilityTrait;
    public function index()
    {
        $banners = Banner::orderBy('updated_at', 'desc')->paginate(15);
        return view('dashboard.banner.index', ['banners'=>$banners]);
    }

    public function create()
    {
        $products = Product::all();
        $artists = Artist::all();
        return view('dashboard.banner.create', compact('artists', 'products'));
    }

    public function store(BannerRequest $request)
    {
        try {
            (new BannerService($request))->store();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('banners.index');
    }

    public function edit(Banner $banner)
    {
        $products = Product::all();
        $artists = Artist::all();
        return view('dashboard.banner.edit', compact('banner', 'artists', 'products'));
    }

    public function update(BannerRequest $request, Banner $banner)
    {
        try {
            (new BannerService($request, $banner))->update();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->route('banners.index');
    }

    public function destroy(Banner $banner)
    {
        try {
            // delete images using UtilityTrait
            $this->deleteImages($banner->images);

            $banner->delete();
        } catch (\Exception $exception) {

        }

        return redirect()->back();
    }
}
