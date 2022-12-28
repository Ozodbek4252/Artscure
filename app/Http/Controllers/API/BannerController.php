<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Traits\UtilityTrait;
use App\Http\Requests\BannerRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\BannerResource;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    use UtilityTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->get('type');
        if ($type == null) {
            $banners = Banner::all();
        } else {
            $banners = Banner::where('type', $type)->get();
        };
        return BannerResource::collection($banners)->all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        try {
            $banner = $request->except('image');
            $result = Banner::create($banner);

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/banners'), $imageName);

            $image = new Image();
            $image->image = 'images/banners/'.$imageName;
            $image->imageable_id = $result->id;
            $image->imageable_type = 'App\Models\Banner';
            $image->save();

        } catch (\Exception $exception) {
            return (new ErrorResource("Banner Store {$exception->getMessage()}", 'Try again later'))->response()->setStatusCode(403);
        }

        return New BannerResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::where('id', $id)->first();
        if ($banner) {
            return new BannerResource($banner);
        } else {
            return response()->json([
                'banner' => 'Error'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $banner = Banner::find($id);

            if ($request->image) {
                $this->deleteImages($banner->images);

                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/banners'), $imageName);
                $image = new Image();
                $image->image = 'images/banners/'.$imageName;
                $image->imageable_id = $id;
                $image->imageable_type = 'App\Models\Banner';
                $image->save();
            }

            $attributes = $request->except(['image', '_method']);
            $banner->update($attributes);

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->error("Banner failed to update {$exception->getMessage()}", 400);
        }

        DB::commit();

        return new BannerResource($banner);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);

        $this->deleteImages($banner->images);

        $result = $banner->delete();
        if ($result) {
            return response()->json([
                'banner' => 'Delete Successfully'
            ], 200);
        } else {
            return response()->json([
                'banner' => 'Error'
            ], 500);
        }
    }
}
