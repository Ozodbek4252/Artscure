<?php

namespace App\Services;

use App\Exceptions\Banner\BannerStoreException;
use App\Exceptions\Banner\BannerUpdateException;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Traits\UtilityTrait;

use App\Models\Artist;
use App\Models\Product;

class BannerService
{
    use UtilityTrait;
    public $attributes;
    public $banner;
    public $image;

    public function __construct($request, $banner = null)
    {
        $this->attributes = $request->only(['title_uz', 'title_ru', 'title_en', 'type', 'body_uz', 'body_ru', 'body_en']);

        $link = explode('.', $request->link)[0];
        $link_type = explode('.', $request->link)[1];

        $model = ucfirst($link_type);
        $model = "App\\Models\\$model";
        $model = $model::find($link);

        $this->attributes['link'] = $model->slug;
        $this->attributes['link_type'] = ucfirst($link_type);

        $this->image = $request->image;
        $this->banner = $banner;
    }

    /**
     * @throws BannerStoreException
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $this->banner = Banner::create($this->attributes);

            // store image using UtilityTrait
            if ($this->image != null) {
                $this->storeImage($this->image, $this->banner, 'Banner', 'banners');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new BannerStoreException("Cannot store. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $this->banner->update($this->attributes);

            if($this->image != null) {
                // delete old image using UtilityTrait
                $this->deleteImages($this->banner->images);

                // store image using UtilityTrait
                $this->storeImage($this->image, $this->banner, 'Banner', 'banners');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new BannerUpdateException("Cannot update. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

}
