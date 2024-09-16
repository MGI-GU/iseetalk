<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserActivity extends Model
{
    use SoftDeletes;
    
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'user_activity';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'audio_id', 'listened_at', 'listen_later', 'liked', 'dislike', 'user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function audio(){
    	return $this->belongsTo('App\Models\Audio','audio_id');
    }
    
    public function scopeLog($q)
    {
        return $q->where('status', 'active')->orderBy('created_at', 'desc');
    }
    public function scopeLater($q)
    {
        return $q->where('listen_later', 1)->orderBy('created_at', 'desc');
    }
    public function scopeLike($q)
    {
        return $q->where('liked', 1)->orderBy('created_at', 'desc');
    }
    public function scopeTopplay($q)
    {
        return $q->orderBy('played_number', 'desc');
    }
    public function scopeStudio($q)
    {
        return $q->where('played_number', 'desc');
    }

    /**
    * Set data
    *
    * @return void
    */
    public function setLike()
    {
        $this->attributes['liked'] = 1;
        self::save();
    }
    public function setDislike()
    {
        $this->attributes['liked'] = 0;
        self::save();
    }

    public function setSave()
    {
        $this->attributes['listen_later'] = 1;
        self::save();
    }
    public function setUnsave()
    {
        $this->attributes['listen_later'] = 0;
        self::save();
    }
}
