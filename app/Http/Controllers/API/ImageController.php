<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function destroy($id){
        $image = Image::find($id);
        if(file_exists($image->image)){
            unlink($image->image);
        }

        $result = $image->delete();

        if ($result) {
            return response()->json([
                'message' => 'Image deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }
}
