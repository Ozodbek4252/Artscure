<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PopularArtistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (count($this->tools)>0) {
            $type = $this->tools[0];
        } else {
            $type = null;
        }

        if (count($this->products)>0 ) {
            $product_count = count($this->products);
            if(count($this->products[0]->images)>0) {
                $product_image = $this->products[0]->images[0]->image;
            } else {
                $product_image = null;
            }
        } else {
            $product_count = 0;
            $product_image = null;
        }


        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'first_name_uz' => $this->first_name_uz,
            'first_name_ru' => $this->first_name_ru,
            'first_name_en' => $this->first_name_en,

            'last_name_uz' => $this->last_name_uz,
            'last_name_ru' => $this->last_name_ru,
            'last_name_en' => $this->last_name_en,

            'description_uz' => $this->description_uz,
            'description_ru' => $this->description_ru,
            'description_en' => $this->description_en,

            'speciality' => $this->speciality,
            'rate' => $this->rate,
            'category' => [
                'name_uz' => $this->category->name_uz,
                'name_ru' => $this->category->name_ru,
                'name_en' => $this->category->name_en,
            ],
            'views' => $this->views,

            'muzey_uz' => $this->muzey_uz,
            'muzey_ru' => $this->rmey_ru,
            'muzey_en' => $this->enzey_en,

            'medal_uz' => $this->medal_uz,
            'medal_ru' => $this->medal_ru,
            'medal_en' => $this->medal_en,

            'label' => $this->label,

            'type' => $type,

            'image' => ImageResource::collection($this->images)->all(),
            'product_image' => $product_image,
            'product_count' => $product_count
        ];
    }
}
