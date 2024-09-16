<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TeamUserRole extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'team_user';
    protected $appends = ['user_name', 'role_name', 'status_label'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id','user_id', 'role_id', 'status'
    ];

    public function team(){
    	return $this->belongsTo('App\Models\Team','team_id');
    }
    public function role(){
    	return $this->belongsTo('App\Models\Role','role_id');
    }
    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }

    public function admin(){
    	return $this->hasOne('App\Models\Admin', 'user_role_id', 'id');
    }

    public function getUserNameAttribute() {
        return $this->user->name ?? '';
    }
    public function getRoleNameAttribute() {
        return $this->role->name ?? '';
    }

    public function scopeAdmin($query)
    {
        return $query->where('role_id','>',1);
    }
    public function scopeLeaderteam($query)
    {
        return $query->where('role_id',3);
    }
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }
    public function scopeGroupuser($query)
    {
        return $query->groupBy('id');
    }

    // public function setRemoveMember()
    // {
    //     self::delete();
    // }

    public function getStatusLabelAttribute() {
        switch ($this->status) {
            case 'active':
                return '<span class="label label-success">Active</span>';
                break;

            default:
                return '<span class="label label-warning">Suspend</span>';
                break;
        }
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($role) { // called BEFORE delete()
            $role->user->update([
                'type' => 'creator',
                'admin_id' => null
            ]);
        });
    }
}
