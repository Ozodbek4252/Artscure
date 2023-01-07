<?php

namespace App\Services;

use App\Exceptions\Type\TypeStoreException;
use App\Exceptions\Type\TypeUpdateException;
use Illuminate\Support\Facades\DB;
use App\Models\Type;
use App\Traits\UtilityTrait;
use Illuminate\Support\Str;

class TypeService
{
    use UtilityTrait;
    public $attributes;
    public $type;
    public $image;

    public function __construct($request, $type = null)
    {
        $this->attributes = $request->only(['name_uz', 'name_ru', 'name_en', 'category_id']);
        $this->image = $request->image;
        $this->type = $type;
    }

    /**
     * @throws TypeStoreException
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $this->attributes['slug'] = str_replace(' ', '_', strtolower($this->attributes['name_uz'])).'-'.Str::random(5);

            $this->type = Type::create($this->attributes);

            // store image using UtilityTrait
            $this->storeImage($this->image, $this->type, 'Type', 'types');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new TypeStoreException("Cannot store. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $this->type->update($this->attributes);

            if($this->image != null) {
                // delete old image using UtilityTrait
                $this->deleteImages($this->type->images);

                // store image using UtilityTrait
                $this->storeImage($this->image, $this->type, 'Type', 'types');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new TypeUpdateException("Cannot update. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

}
