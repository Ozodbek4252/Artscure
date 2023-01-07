<?php

namespace App\Services;

use App\Exceptions\Category\CategoryStoreException;
use App\Exceptions\Category\CategoryUpdateException;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Traits\UtilityTrait;

class CategoryService
{
    use UtilityTrait;
    public $attributes;
    public $category;
    public $image;
    public $old_image;

    public function __construct($request, $category = null)
    {
        $this->attributes = $request->only(['name_uz', 'name_ru', 'name_en']);
        $this->image = $request->image;
        $this->category = $category;
    }

    /**
     * @throws CategoryStoreException
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $this->category = Category::create($this->attributes);

            // store image using UtilityTrait
            $this->storeImage($this->image, $this->category, 'Category', 'categories');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new CategoryStoreException("Cannot store. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $this->category->update($this->attributes);

            if($this->image != null) {
                // delete old image using UtilityTrait
                $this->deleteImages($this->category->images);

                // store image using UtilityTrait
                $this->storeImage($this->image, $this->category, 'Category', 'categories');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new CategoryUpdateException("Cannot update. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

}
