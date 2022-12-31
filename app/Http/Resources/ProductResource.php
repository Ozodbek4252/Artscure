<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name_uz' => $this->name_uz,
            'name_ru' => $this->name_ru,
            'name_en' => $this->name_en,

            'description_uz' => $this->description_uz,
            'description_ru' => $this->description_ru,
            'description_en' => $this->description_en,

            'certificate' => $this->certificate,
            'frame' => $this->frame,
            'size' => $this->size,
            'year' => $this->year,
            'city' => $this->city,
            'unique' => $this->unique,
            'signiture' => $this->sig,
            'price' => $this->price,
            'status' => $this->status,
            'views' => $this->views,
            'type' => new TypeResource($this->type),

            'category' => new CategoryResource($this->category),

            'image' => ImageResource::collection($this->images)->all(),
            'tools' => ToolResource::collection($this->tools)->all(),
        ];
    }
}
