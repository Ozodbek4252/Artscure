<?php

namespace App\Services;

use App\Exceptions\Product\ProductDeleteException;
use App\Exceptions\Product\ProductStoreException;
use App\Exceptions\Product\ProductUpdateException;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Traits\UtilityTrait;

use App\Models\Product;

class ProductService
{
    use UtilityTrait;

    public $attributes;
    public $product;
    public $main_image;
    public $images;
    public $tools;

    public function __construct($request = null, $product = null)
    {
        if ($request != null) {
            $this->attributes = $request->except(['_token', '_method', 'main_image', 'images', 'tools']);
            $this->attributes['slug'] = str_replace(' ', '_', strtolower($this->attributes['name_uz'])) . '-' . Str::random(8);
            $this->main_image = $request->main_image;
            $this->images = $request->images;
            $this->tools = $request->tools;

            if ($request->frame) {
                $this->attributes['frame'] = 1;
            } else {
                $this->attributes['frame'] = 0;
            } ;

            if ($request->certificate) {
                $this->attributes['certificate'] = 1;
            } else {
                $this->attributes['certificate'] = 0;
            };

            if ($request->unique) {
                $this->attributes['unique'] = 1;
            } else {
                $this->attributes['unique'] = 0;
            };

            if ($request->signiture) {
                $this->attributes['signiture'] = 1;
            } else {
                $this->attributes['signiture'] = 0;
            };

            if ($request->status) {
                $this->attributes['status'] = $request->status;
            } else {
                $this->attributes['status'] = 0;
            };

            $resell = [
                'resell_name_uz' => $request->resell_name_uz,
                'resell_name_ru' => $request->resell_name_ru,
                'resell_name_en' => $request->resell_name_en,
                'resell_body_uz' => $request->resell_body_uz,
                'resell_body_ru' => $request->resell_body_ru,
                'resell_body_en' => $request->resell_body_en,
            ];
            $this->attributes['resell'] = json_encode($resell);
        }
        $this->product = $product;
    }

    /**
     * @throws ProductStoreException
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $this->product = Product::create($this->attributes);

            // store main_image using UtilityTrait
            $this->storeImage($this->main_image, $this->product, 'Product', 'products');

            if ($this->images) {
                foreach($this->images as $image) {
                    $this->storeImage($image, $this->product, 'Product', 'products', 'other');
                }
            }

            // store tools using UtilityTrait
            $this->storeTools($this->tools, $this->product, 'App\Models\Product');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ProductStoreException("Cannot store. Error: {$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }


    public function update()
    {
        DB::beginTransaction();
        try {
            $this->product->update($this->attributes);

            if ($this->main_image != null) {
                // delete old image using UtilityTrait
                $this->deleteImages($this->product->images->where('type', 'main'));

                // store image using UtilityTrait
                $this->storeImage($this->main_image, $this->product, 'Product', 'products');
            }

            if ($this->images) {
                foreach($this->images as $image) {
                    $this->storeImage($image, $this->product, 'Product', 'products', 'other');
                }
            }

            // delete product's tools using UtilityTrait
            $this->deleteToolables($this->product->tools, 'App\Models\Product');

            // store tools using UtilityTrait
            $this->storeTools($this->tools, $this->product, 'App\Models\Product');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ProductUpdateException("Cannot update. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function delete($product)
    {
        DB::beginTransaction();
        try {
            // delete images using UtilityTrait
            if (count($product->images)>0) {
                $this->deleteImages($product->images);
            }

            // delete product's tools using UtilityTrait
            if (count($product->tools)>0) {
                $this->deleteToolables($product->tools, 'App\Models\Product');
            }

            $product->delete();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ProductDeleteException("Cannot delete. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

}
