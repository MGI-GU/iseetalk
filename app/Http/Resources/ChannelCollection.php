<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Channel as ChannelList;

class ChannelCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'rows' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
            'total' => $this->collection->count()
        ];
        return parent::toArray($request);
    }
}
