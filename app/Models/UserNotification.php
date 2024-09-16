<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{

    protected $guarded = array();
    public static $rules = array();
    protected $table = 'notification_users';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_id', 'user_id', 'is_read'
    ];

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }

    public function notification(){
    	return $this->belongsTo('App\Models\Notification','notification_id');
    }

    //SCOPE
    public function scopeUnread($q)
    {
        return $q->whereNull('is_read');
    }

    /**
    * Set
    *
    * @return void
    */
    public function setReaded()
    {
        $this->attributes['is_read'] = 1;
        self::save();
    }
}
