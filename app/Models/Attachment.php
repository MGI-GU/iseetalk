<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;
    
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'attachments';
    protected $appends = ['slug','slug_id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'model', 'model_id', 'user_id', 'status', 'storage', 'size', 'url', 'type_data'
    ];

    public function user(){
    	return $this->belongsTo('User','user_id');
    }

    public function audio_upload(){
    	return $this->hasOne('App\Models\Audio', 'source', 'id');
    }

    public function image(){
    	return $this->hasMany('App\Models\Image','attachment_id');
    }

    public function image_show(){
    	return $this->hasMany('App\Models\Image','attachment_id')->where('time_end', '!=', 0)->orderBy('time_show', 'asc');
    }

    public function image_draft(){
    	return $this->hasMany('App\Models\Image','attachment_id')->where('time_show', '=', 0)->where('time_end', '=', 0);
    }

    public function image_deleted(){
    	return $this->hasMany('App\Models\Image','attachment_id')->onlyTrashed();
    }

    public function getSlugAttribute(){
        return urlStorage().$this->url;
    }

    public function getSlugIdAttribute(){
        return Hashids::encode($this->id);
    }

    public function scopeSlide($q)
    {
        return $q->whereIn('type_data', ['pdf', 'ppt', 'pptx']);
    }
}
