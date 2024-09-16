<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'picture'               => $this->picture,
            'format_id'             => $this->format_id,
            'phone'                 => $this->phone,
            'email'                 => $this->email,
            'type'                  => $this->type,
            'email_verified_at'     => $this->email_verified_at,
            'status'                => $this->status,
            'date_label'            => $this->date_label,
            'platform'              => $this->platform,
        ];
        return parent::toArray($request);
    }
}
