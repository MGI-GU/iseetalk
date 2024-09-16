<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $guarded = array();
    public static $rules = array();
    protected $table = 'notifications';
    protected $appends = ['type_label'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'type', 'notifiable_type', 'notifiable_id', 'data'
    ];

    public function notificationable()
    {
        return $this->morphTo();
    }

    public function user_notification(){
    	return $this->hasMany('App\Models\UserNotification','notification_id');
    }

    public function page(){
    	return $this->belongsTo('App\Models\Page','notifiable_id');
    }

    public function getTypeLabelAttribute() {
        if ($this->type == 'app_creator') {
            return '<span class="label label-info">Nofitication to the Creators</span>';
        }elseif($this->type == 'email_creator'){
            return '<span class="label label-info">Email to the Creators</span>';
        }elseif($this->type == 'email_user' || $this->type == 'email'){
            return '<span class="label label-info">Email to all Users</span>';
        }else{
            return '<span class="label label-info">Nofitication to all Users</span>';
        }
	}
}
