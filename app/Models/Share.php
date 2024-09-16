<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'shares';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'media', 'audio_id', 'user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function audio(){
    	return $this->belongsTo('App\Models\Audio','audio_id');
    }
}
