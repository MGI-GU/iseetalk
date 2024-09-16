<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Audit extends JsonResource
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
            'model_type'            => $this->model_type,
            'data_label'            => $this->data_label,
            'status_label'          => $this->status_label,
            'status'                => $this->status,
            'date_label'            => $this->date_label,
            'data_table'            => [ 
                'name'              => @$this->data_table->name,
                'source_label'      => @$this->data_table->source_label,
                'play_number'       => @$this->data_table->play_number,
                'last_update'       => @$this->data_table->last_update
            ],
        ];
        return parent::toArray($request);
    }
}
