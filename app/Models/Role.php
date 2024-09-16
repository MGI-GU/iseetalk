<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'roles';
    protected $appends = ['status_label', 'type_label'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description','role_for', 'type', 'status'
    ];

    public function permission(){
    	return $this->belongsToMany('App\Models\Permission');
    }
    public function permission_by_model(){
    	return $this->belongsToMany('App\Models\Permission')->groupBy('model')->orderBy('id');
    }
    public function roleuser(){
    	return $this->hasMany('App\Models\TeamUserRole', 'role_id');
    }
    public function rolebyuser(){
    	return $this->hasMany('App\Models\TeamUserRole', 'role_id')->groupBy('user_id');
    }

    public function scopeTeam($q)
    {
        return $q->where('role_for', 'team_member')->where('status', 'active');
    }

    public function scopeAdmin($q)
    {
        return $q->where('role_for', 'LIKE', '%admin%');
    }

    public function getStatusLabelAttribute() {
        switch ($this->status) {
            case 'active':
                return '<span class="label label-success">Active</span>';
                break;

            default:
                return '<span class="label label-warning">Disable</span>';
                break;
        }
    }

    public function getTypeLabelAttribute() {
        switch ($this->role_for) {
            case 'super_admin':
                return '<span class="label label-danger">Super Admin</span>';
                break;
            case 'master_admin':
                return '<span class="label label-danger">Master Admin</span>';
                break;
            case 'leader':
                return '<span class="label label-info">Team Leader</span>';
                break;
            case 'admin':
                return '<span class="label label-warning">General Admin</span>';
                break;

            default:
                return '<span class="label label-info">Team Member</span>';
                break;
        }
    }
}
