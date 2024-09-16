<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentTag extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'content_tags';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id','content_tag_type','content_tag_id'
    ];

    public function channel(){
    	return $this->belongsTo('App\Models\Channel','model_id')->where('content_tag_type','App\Models\Channel');
    }

    public function audio(){
    	return $this->belongsTo('App\Models\Audio','model_id')->where('content_tag_type','App\Models\Audio');
    }

}
