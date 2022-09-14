<?php
namespace App\Traits;

use App\Models\Artist;
use App\Models\Image;
use App\Models\Toolable;
use App\Models\Type;

trait UtilityTrait {

  public function deleteImages($images){
    if(count($images)>0){
      foreach($images as $image){
        if(file_exists($image->image)){
          unlink($image->image);
        }
        Image::find($image->id)->delete();
      }
    }
  }

  public function deleteTools($tools, $model){
    if(count($tools)>0){
      foreach($tools as $tool){
        $this_tool = Toolable::where('toolable_id', $tool->pivot->toolable_id)->where('tool_id', $tool->pivot->tool_id)->where('toolable_type', $model)->first();
        $this_tool->delete();
      }
    }
  }
  
  public function setNullToArtistId($items){
    if (count($items)>0){
      foreach($items as $product){
        $product->artist_id = null;
        $product->save();
      }
    }
  }
  
  public function setNullToTypeId($items){
    if (count($items)>0){
      foreach($items as $product){
          $product->type_id = null;
          $product->save();
      }
    }
  }
  
  public function deleteTypes($types){
    if (count($types)>0){
      foreach($types as $type){
        Type::find($type->id)->delete();
      }
    }
  }
  
  public function deleteArtists($artists){
    if (count($artists)>0){
      foreach($artists as $artist){
          Artist::find($artist->id)->delete();
      }
    }
  }

}