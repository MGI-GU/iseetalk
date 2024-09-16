<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTeam extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'category_team';

    public function category(){
    	return $this->belongsTo('App\Models\Category','category_id');
    }

    public function team(){
    	return $this->belongsTo('App\Models\Team','team_id');
    }

}
