<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $guarded = array();
    public static $rules = array();
    protected $table = 'projects';
    protected $appends = ['format_id', 'date_label', 'status_label'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'team_id', 'status'
    ];

    public function channelProject(){
        return $this->hasMany('App\Models\ContentProject','project_id')->where('model','channel');
    }

    public function channels()
    {
        return $this->belongsToMany('App\Models\Channel', 'content_projects', 'project_id', 'model_id')->where('model', 'channel');
    }

    public function team(){
    	return $this->belongsTo('App\Models\Team','team_id');
    }

    public function audit()
    {
        return $this->morphOne('App\Models\Audit', 'model');
    }

    public function getFormatIdAttribute() {
        return format_id('project', $this->id);
    }

    public function getDateLabelAttribute() {
		$date = Carbon::parse($this->created_at); // now date is a carbon instance
		return Carbon::make($date)->isoFormat('dddd, D MMMM Y');
    }

    public function getStatusLabelAttribute() {
        switch ($this->status) {
            case 'approve':
                return '<span class="label label-primary">Approved</span>';
                break;
            case 'reject':
                return '<span class="label label-danger">Rejected</span>';
                break;
            case 'draft':
                return '<span class="label label-default">Draft</span>';
                break;;

            default:
                return '<span class="label label-info">Waiting for Approval</span>';
                break;
        }
    }

    /**
    * Set status
    *
    * @return void
    */
    public function setApprove()
    {
        $this->attributes['status'] = 'approve';
        self::save();
    }
    public function setReject()
    {
        $this->attributes['status'] = 'reject';
        self::save();
    }
    public function setReview()
    {
        $this->attributes['status'] = 'review';
        self::save();
    }
}
