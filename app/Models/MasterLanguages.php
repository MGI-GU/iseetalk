<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterLanguages extends Model
{
    use SoftDeletes;
    
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'master_languages';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];

}
