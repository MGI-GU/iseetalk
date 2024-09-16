<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'admins';
    protected $casts = [
        'category' => 'array'
    ];
    protected $appends = ['format_id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_role_id', 'category', 'status'
    ];

    public function role(){
    	return $this->belongsTo('App\Models\TeamUserRole','user_role_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($admin) { // called BEFORE delete()
            $admin->role->user->update([
                'type' => 'creator',
                'admin_id' => null
            ]);
            //DELETE relation ROLE USER
            $admin->role()->delete();
        });
    }

    public function getFormatIdAttribute() {
        return format_id('admin', $this->id);
    }
}
