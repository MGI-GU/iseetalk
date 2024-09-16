<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $guarded = array();
    public static $rules = array();
    protected $table = 'images';
    protected $appends = ['slug', 'format_time_show', 'format_time_end'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'source', 'attachment_id', 'time_show', 'time_end', 'audio_id', 'pages'
    ];

    public function attachment(){
    	return $this->belongsTo('App\Models\Attachment','attachment_id');
    }

    public function audio(){
    	return $this->belongsTo('App\Models\Audio','audio_id');
    }

    public function getSlugAttribute(){
        return urlStorage().$this->url;
    }

    public function getFormatTimeShowAttribute(){
        return convert_time($this->time_show);
    }

    public function getFormatTimeEndAttribute(){
        return convert_time($this->time_end);
    }

    public function setDraft()
    {
        $this->attributes['time_show'] = null;
        $this->attributes['time_end'] = null;
        self::save();
    }
}
