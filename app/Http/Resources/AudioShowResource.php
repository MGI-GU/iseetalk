<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AudioShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'visibility' => $this->visibility,
                'channel' => $this->channel_id ? $this->channel_id : '',
                'category' => $this->category_id ? get_category(NULL, $this->category_id) : get_category(NULL, 0, $this->id),
                'language' => $this->language,
                'allow_comment' => $this->allow_comment == 0 ? 'Not Allow Comment':'Allow Comment',
                'sort_comment' => $this->sort_comment == 0 ? 'sort by Popular':'sort by Newest',
                'allow_rating' => $this->allow_rating == 0 ? 'False':'True',
                'allow_notice' => $this->allow_notice == 0 ? 'False':'True',
                'allow_age' => $this->allow_age == 0 ? 'False':'True',
                'slug' => $this->slug,
                'src_cover' => $this->src_cover,
                'date_label' => $this->date_label,
            ],
            'current_page' => [
                'self' => 'link-value',
            ],
        ];
        // return parent::toArray($request);
    }
}
