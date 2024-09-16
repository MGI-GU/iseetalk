<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMedia extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'user_media';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'media','url','user_id'
    ];

    public function user(){
    	return $this->belongsTo('User','user_id');
    }
}
