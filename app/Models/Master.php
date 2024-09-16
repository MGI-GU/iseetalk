<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'master';
    protected $casts = [
        'api' => 'array',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone'
    ];

}
