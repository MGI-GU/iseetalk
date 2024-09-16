<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'audits';
    protected $appends = ['data_table', 'data_label', 'status_label'];
    protected $casts = [
        'notes' => 'array'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_type', 'status', 'admin_id'
    ];

    public function auditable()
    {
        return $this->morphTo();
    }

    public function audio(){
    	return $this->belongsTo('App\Models\Audio','model_id');
    }

    public function channel(){
    	return $this->belongsTo('App\Models\Channel','model_id');
    }

    public function admin(){
    	return $this->belongsTo('App\User','admin_id');
    }

    public function project(){
    	return $this->belongsTo('App\Models\Project','model_id');
    }

    public function logs(){
    	return $this->hasMany('App\Models\LogAudit','audit_id');
    }

    public function getDataTableAttribute()
    {
        if($this->model_type === 'App\Models\Project' ){
            return $this->project;
        }elseif($this->model_type === 'App\Models\Audio' ){
            return $this->audio;
        }else{
            return $this->channel;
        }
    }

    public function getDataLabelAttribute()
    {
        if($this->model_type === 'App\Models\Project' ){
            return 'project';
        }elseif($this->model_type === 'App\Models\Audio' ){
            return 'audio';
        }else{
            return 'channel';
        }
    }

    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'publish':
                return '<span class="label label-success">Approved</span>';
                break;
            case 'approve':
                return '<span class="label label-success">Approved</span>';
                break;
            case 'suspend':
                return '<span class="label label-warning">Rejected</span>';
                break;
            case 'reject':
                return '<span class="label label-warning">Rejected</span>';
                break;
            default:
                return '<span class="label label-info">Waiting for Audition</span>';
                break;
        }
    }

    //
    // SCOPE
    //
    public function scopeAudios($q)
    {
        if(is_admin(auth()->user())=='admin'){
           return $q->where('model_type', '=', 'App\Models\Audio')->whereHas('audio', function($query) {
                $query->doesnthave('project')->whereNull('backup_id');
            });
        }
        return $q->where('model_type', '=', 'App\Models\Audio')->whereHas('audio', function($query) {
            $query->whereNull('backup_id')->whereNull('parent_id');
        });
    }
    public function scopeChannels($q)
    {
        if(is_admin(auth()->user())=='admin'){
            return $q->where('model_type', '=', 'App\Models\Channel')->whereHas('channel', function($query) {
                 $query->doesnthave('project')->whereNull('backup_id');
             });
         }
        return $q->where('model_type', '=', 'App\Models\Channel');
    }
    public function scopeProjects($q)
    {
        return $q->where('model_type', '=', 'App\Models\Project');
    }
    public function scopeActive($q)
    {
        return $q->where('status', '!=', 'draft');
    }
    /**
    * Set status
    *
    * @return void
    */
    public function setApprove()
    {
        $this->attributes['status'] = 'approve';
        $this->attributes['admin_id'] = auth()->user()->id;
        self::save();
    }
    public function setRevisi($request)
    {
        $this->attributes['status'] = 'suspend';
        $this->attributes['admin_id'] = auth()->user()->id;
        $this->attributes['notes'] = json_encode($request);
        self::save();
    }
}
