<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;

use App\Traits\UtilityTrait;

class ImageController extends Controller
{
    use UtilityTrait;

    public function destroy($id)
    {
        try {
            $image = Image::where('id', $id)->get();
            $this->deleteImages($image);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }

        return redirect()->back();
    }
}
