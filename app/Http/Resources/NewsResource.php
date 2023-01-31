<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'title_uz' => $this->title_uz,
            'title_ru' => $this->title_ru,
            'title_en' => $this->title_en,
            'body_uz' => $this->body_uz,
            'body_ru' => $this->body_ru,
            'body_en' => $this->body_en,
            'category' => $this->category,
            'views' => $this->views,
            'video' => $this->video_link,
            'image' => $this->images[0]->image,
            'created_at' => $this->created_at,
        ];
    }
}
