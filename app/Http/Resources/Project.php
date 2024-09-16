<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
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
            'format_id'             => $this->format_id,
            'name'                  => $this->name,
            'status'                => $this->status,
            'status_label'          => $this->status_label,
            'date_label'            => $this->date_label,
            'team_name'             => $this->team ? $this->team->name: '-',
            'team_leader'           => $this->team ?$this->team->leader_name: '-',
        ];
        return parent::toArray($request);
    }
}
