<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
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
            'category' => new CategoryResource($this->category),
            'views' => $this->views,

            'muzey_uz' => $this->muzey_uz,
            'muzey_ru' => $this->muzey_ru,
            'muzey_en' => $this->muzey_en,

            'medal_uz' => $this->medal_uz,
            'medal_ru' => $this->medal_ru,
            'medal_en' => $this->medal_en,

            'label' => $this->label,

            'type' => $type,
            'product' => ProductResource::collection($this->products)->all(),

            'image' => ImageResource::collection($this->images)->all(),
            'tools' => ToolResource::collection($this->tools)->all(),
        ];
    }
}
