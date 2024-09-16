<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserSetting extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'web_subscription', 'web_recommendation', 'web_channel', 'web_all_comment', 'web_my_comment_reply', 'email_permission', 'email_subscription', 'email_product', 'email_channel', 'language', 'user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
}
