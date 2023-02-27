<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Currency;

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
        $usd = Currency::where('name', 'USD')->first();
        $USD_price = $usd ? round(($this->price / $usd->value), 2) : 0;

        $resell = $this->resell ? $this->resell : null;

        if ($this->artist) {
            $author = [
                'slug' => $this->artist->slug,
                'uz' => $this->artist->first_name_uz .' '. $this->artist->last_name_uz,
                'ru' => $this->artist->first_name_ru .' '. $this->artist->last_name_ru,
                'en' => $this->artist->first_name_en .' '. $this->artist->last_name_en,
            ];
        } else {
            $author = null;
        }
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'sku' => $this->sku,
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
            'USD_price' => $USD_price,
            'status' => $this->status,
            'views' => $this->views,
            'type' => new TypeResource($this->type),
            'author' => $author,
            'is_sold' => $this->is_sold,
            'resell' => $resell,
            'category' => new CategoryResource($this->category),

            'image' => ImageResource::collection($this->images)->all(),
            'tools' => ToolResource::collection($this->tools)->all(),
        ];
    }
}
