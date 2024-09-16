<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'tags';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function audios()
    {
        return $this->morphedByMany('App\Model\Audio', 'content_tag');
    }

    public function channels()
    {
        return $this->morphedByMany('App\Model\Channel', 'content_tag');
    }
}
