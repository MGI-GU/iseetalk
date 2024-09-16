<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class OrderPosition extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'order_position';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position', 'orderable_id', 'orderable_type'
    ];

    public function orderable()
    {
        return $this->morphTo();
    }
    
}
