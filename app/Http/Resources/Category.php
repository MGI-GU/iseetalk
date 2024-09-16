<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'id'                    => $this->id,
            'name'                  => $this->name,
            'status'                => $this->status,
            'updated_at'            => $this->updated_at,
            'status_label'          => $this->status_label,
            'date_label'            => $this->date_label,
            'slug'                  => $this->slug,
            'team_id'               => $this->teams->count() > 0 ? true : false,
            'team_name'             => $this->team ?$this->team->name: '-',
            'team_format_id'        => $this->team ?$this->team->format_id: '-',
        ];
        return parent::toArray($request);
    }
}
