<?php

namespace App\Services;

use App\Exceptions\Tool\ToolStoreException;
use App\Exceptions\Tool\ToolUpdateException;
use Illuminate\Support\Facades\DB;
use App\Models\Tool;
use App\Traits\UtilityTrait;

class ToolService
{
    use UtilityTrait;
    public $attributes;
    public $tool;
    public $image;

    public function __construct($request = null, $tool = null)
    {
        if ($request != null) {
            $this->attributes = $request->only(['name_uz', 'name_ru', 'name_en', 'type_id']);
            $this->image = $request->image;
        }
        $this->tool = $tool;
    }

    /**
     * @throws ToolStoreException
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $this->tool = Tool::create($this->attributes);

            // store image using UtilityTrait
            if ($this->image != null) {
                $this->storeImage($this->image, $this->tool, 'Tool', 'tools');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ToolStoreException("Cannot store. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $this->tool->update($this->attributes);

            if($this->image != null) {
                // delete old image using UtilityTrait
                $this->deleteImages($this->tool->images);

                // store image using UtilityTrait
                $this->storeImage($this->image, $this->tool, 'Tool', 'tools');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ToolUpdateException("Cannot update. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function delete($tool)
    {
        DB::beginTransaction();
        try {
            // delete image using UtilityTrait
            $this->deleteImages($tool->images);

            $this->setToolsAsNull($tool);

            $tool->delete();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ToolUpdateException("Cannot update. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

}
