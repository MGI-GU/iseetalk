<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Team extends JsonResource
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
            'leader_name'           => $this->leader_name,
            'updated_at'            => $this->updated_at,
            'category'              => @$this->categoryTeam ? @$this->categoryTeam->category->name:'-',
            'count_audio'           => $this->count_audio,
            'count_channel'         => $this->count_channel,
            'count_member'          => $this->count_member,
            'count_project'         => $this->count_project,
        ];
        return parent::toArray($request);
    }
}
