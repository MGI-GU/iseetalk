<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebAudio extends JsonResource
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
            'description'           => short_text($this->description, 380),
            'src_cover'             => $this->src_cover,
            'visibility_label'      => $this->visibility_label,
            'progress_label'        => $this->project ? $this->project->status : 'Studio',
            'status_label'          => $this->status_label,
            'status'                => $this->status,
            'date_label'            => $this->date_label,
            'play_number'           => $this->play_number,
            'comment_number'        => $this->comment_number,
            'like_number'           => $this->like_number,
            'dislike_number'        => $this->disliked->count(),
            'slug'                  => $this->slug,
            'format_id'             => $this->format_id,
            'time'                  => format_time($this->duration),
            'source_label'          => [ 
                'name' => $this->source_label,
                'channel' => $this->channel ? $this->channel->name : '',
                'project' => @$this->channel->project ? $this->channel->project->project->name : '',
                'category' => get_category($this->channel),
                'team' => @$this->channel->project ? @$this->channel->project->project->team->name : '',
            ],
        ];
    }
}
