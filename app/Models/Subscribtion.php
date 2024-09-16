<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribtion extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'subscriptions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id', 'subscriber_id', 'user_id', 'alert_type', 'approved'
    ];

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function subscriber(){
    	return $this->belongsTo('App\User','subscriber_id');
    }
    public function channel(){
    	return $this->belongsTo('App\Models\Channel','channel_id');
    }

    public function setAlert()
    {
        $this->attributes['alert_type'] = 1;
        self::save();
    }
    public function setUnalert()
    {
        $this->attributes['alert_type'] = 0;
        self::save();
    }
}
