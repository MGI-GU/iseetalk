<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAudit extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'log_audit';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'audit_id', 'status', 'admin_id', 'noted'
    ];

    public function admin(){
    	return $this->belongsTo('App\User','admin_id');
    }

    public function audit(){
    	return $this->belongsTo('App\Models\Audit','audit_id');
    }
}
