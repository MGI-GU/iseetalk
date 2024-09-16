<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AudioList extends JsonResource
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
            'name'                  => short_text($this->name, 50),
            'full_name'             => $this->name,
            'src_cover'             => $this->src_cover,
            'visibility_label'      => $this->visibility_label,
            'status_label'          => $this->status_label,
            'status'                => $this->status,
            'date_label'            => $this->date_label,
            'play_number'           => $this->play_number,
            'play_number_string'    => count_format($this->play_number),
            'comment_number'        => $this->comment_number,
            'like_number'           => $this->like_number,
            'dislike_number'        => $this->disliked->count(),
            'slug'                  => $this->slug,
            'created_at'            => $this->created_at ? $this->created_at->diffForHumans():'',
            'updated_at'            => $this->updated_at ? $this->updated_at->diffForHumans():'',
            'time'                  => $this->duration ? format_time($this->duration): 0,
            'source_label'          => [ 
                'name' => $this->source_label,
                'channel' => $this->channel ? $this->channel->name : '',
                'channel_cover' => $this->channel ? get_attachment_source($this->channel)->slug : '',
                'channel_slug' => $this->channel ? route('web.channel.show', [@$this->channel->slug]) : ''
            ],
        ];
        return parent::toArray($request);
    }
}
