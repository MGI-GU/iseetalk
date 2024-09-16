<?php

namespace App\Services;

use App\Models\Audio;
use Illuminate\Http\Request;

class AudioService
{
	public function __construct(Audio $audio)
	{
		$this->audio = $audio ;
	}

    //CUD
    public function create(Request $request)
	{
        $attributes = $request->all();
        return $this->audio->create($attributes);
	}

	public function update(Request $request, $id)
	{
	    $attributes = $request->all();
        return $this->audio->update($id, $attributes);
	}

	public function delete($id)
	{
        return $this->audio->delete($id);
    }
    
    //HELPER
    
}