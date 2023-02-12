<?php

namespace App\Traits;

use Illuminate\Support\Str;

use App\Models\Artist;
use App\Models\Image as ImageModel;
use App\Models\Toolable;
use App\Models\Type;

use Image, File;

trait UtilityTrait
{

    public function deleteImages($images)
    {
        if (count($images) > 0) {
            foreach ($images as $image) {
                if (file_exists($image->image)) {
                    unlink($image->image);
                }
                ImageModel::find($image->id)->delete();
            }
        }
    }

    // Store Image
    public function storeImage($imageRequest, $model, $modelName, $modelPl, $type = null)
    {
        // ex: modelPl = types, products, ...
        // $path = 'images/' . $modelPl;
        $path = 'images/' . $modelPl;
        $photo_name = Str::random(20);

        if (!file_exists($path)) {
            mkdir($path, 0700, true);
        }
        $height = Image::make($imageRequest)->height();
        $width = Image::make($imageRequest)->width();
        $image = Image::make($imageRequest)->encode('jpg', 75)
            ->resize($width, $height)
            ->save(public_path($path . '/' . $photo_name . '.jpg'));

        $image = new ImageModel();
        $image->image = $path . '/' . $photo_name . '.jpg';
        $image->imageable_id = $model->id;
        $image->imageable_type = 'App\Models\\' . $modelName;
        if ($type) {
            $image->type = $type;
        }
        $image->save();
    }

    public function storeTools($tools, $model, $modelName)
    {
        if (count($tools) > 0) {
            foreach ($tools as $key => $tool) {
                $new_tool = new Toolable();
                $new_tool->tool_id = $tool;
                $new_tool->toolable_id = $model->id;
                $new_tool->toolable_type = $modelName;
                $new_tool->save();
            }
        }
    }

    public function deleteToolables($tools, $model)
    {

        if (count($tools) > 0) {
            foreach ($tools as $tool) {
                $this_tool = Toolable::where('toolable_id', $tool->pivot->toolable_id)->where('tool_id', $tool->pivot->tool_id)->where('toolable_type', $model)->first();
                $this_tool->delete();
            }
        }
    }
    public function setToolsAsNull($tool)
    {
        if ($tool != null) {
            $toolables = Toolable::where('tool_id', $tool->id)->get();
            foreach ($toolables as $toolable) {
                $toolable->tool_id = null;
                $toolable->save();
            }
        }
    }

    public function deleteTools($tools, $model)
    {
        if (count($tools) > 0) {
            foreach ($tools as $tool) {
                $this_tool = Toolable::where('toolable_id', $tool->pivot->toolable_id)->where('tool_id', $tool->pivot->tool_id)->where('toolable_type', $model)->first();
                $this_tool->delete();
            }
        }
    }

    public function setNullToArtistId($items)
    {
        if (count($items) > 0) {
            foreach ($items as $product) {
                $product->artist_id = null;
                $product->save();
            }
        }
    }

    public function setNullToTypeId($items)
    {
        if (count($items) > 0) {
            foreach ($items as $product) {
                $product->type_id = null;
                $product->save();
            }
        }
    }

    public function deleteTypes($types)
    {
        if (count($types) > 0) {
            foreach ($types as $type) {
                Type::find($type->id)->delete();
            }
        }
    }

    public function deleteArtists($artists)
    {
        if (count($artists) > 0) {
            foreach ($artists as $artist) {
                Artist::find($artist->id)->delete();
            }
        }
    }
}
