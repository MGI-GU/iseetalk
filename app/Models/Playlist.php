<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Playlist extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'playlists';
    protected $appends = ['slug', 'src_cover'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'channel_id'
    ];

    public function channel(){
    	return $this->belongsTo('App\Models\Channel','channel_id');
    }

    public function audios()
    {
        return $this->belongsToMany('App\Models\Audio');
    }

    // APPENDS
    public function getSlugAttribute(){
        foreach($this->audios as $audio){
            return Hashids::encode($audio->id);
        }
    }
    public function getSrcCoverAttribute(){
        foreach($this->audios as $audio){
            return get_audio_cover($audio);
        }
    }
}
