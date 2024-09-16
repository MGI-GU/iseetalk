<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
            'comment'               => short_text($this->comment, 380),
            'status'                => $this->status,
            'audio' => [ 
                'id'        => @$this->audio->id ? @$this->audio->id : '', 
                'name'      => @$this->audio->name ? @$this->audio->name : '', 
                'src_cover' => @$this->audio ? @$this->audio->src_cover : '',
                'slug'      => @$this->audio ? @$this->audio->slug : '',
                'user_id'   => @$this->audio ? @$this->audio->user_id : '',
            ],
            'user' => [ 
                'id'            => @$this->user ? $this->user->id : '', 
                'picture'       => @$this->user ? $this->user->picture : '', 
                'name'          => @$this->user ? $this->user->name : '', 
            ],
            'date_label'            => $this->date_label,
            'status_label'          => $this->status_label,
        ];
        return parent::toArray($request);
    }
}
