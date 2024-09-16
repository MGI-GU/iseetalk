<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Channel extends JsonResource
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
            'description'           => short_text($this->description, 200),
            'no_audio'              => $this->no_audio,
            'source_label'          => [ 
                'name' => $this->source_label, 
                'project' => $this->project ? $this->project->project->name : '',
                'category' => $this->project ? @$this->project->project->team->categoryTeam->category->name : '',
                'team' => @$this->project ? @$this->project->project->team->name : '',
            ],
            'status_label'          => $this->status_label,
            'src_cover'             => $this->src_cover,
            'date_label'            => $this->date_label,
            'no_subscriber'         => $this->no_subscriber,
            'slug'                  => $this->slug,
            'format_id'             => $this->format_id,
        ];
        return parent::toArray($request);
    }
}
