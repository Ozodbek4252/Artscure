<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
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
        return view('dashboard.banner.create');
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
        return view('dashboard.banner.edit', ['banner'=>$banner]);
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
