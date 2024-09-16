<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $guarded = array();
    public static $rules = array();
    protected $table = 'pages';
    protected $appends = ['format_id', 'date_label','status_label'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'author_id', 'status', 'slug', 'sub_content', 'type', 'notice'
    ];

    public function author(){
    	return $this->belongsTo('App\User','author_id');
    }

    // public function notification(){
    // 	return $this->hasOne('App\Models\Notification','notifiable_id')->where('notifiable_type', 'page');
    // }

    /**
     * One to One Polymorphic Audit.
     */
    public function notification()
    {
        return $this->morphOne('App\Models\Notification', 'notifiable');
    }

    public function getStatusLabelAttribute() {
        if ($this->status == 'publish') {
            return '<span class="label label-success">Published</span>';
        }elseif($this->status == 'unpublish'){
            return '<span class="label label-danger">'.$this->status.'</span>';
        }else{
            return '<span class="label label-warning">'.$this->status.'</span>';
        }
	}

    public function getDateLabelAttribute() {
		$date = Carbon::parse($this->updated_at); // now date is a carbon instance
		return Carbon::make($date)->isoFormat('lll');
    }

    public function getFormatIdAttribute() {
        return format_id('page', $this->id);
    }

    //
    //SCOPE
    //
    public function scopeFooter($q)
    {
        return $q->where('type', 'footer');
    }
    public function scopePage($q)
    {
        return $q->where('type', 'page');
    }
    public function scopePublish($q)
    {
        return $q->where('status', 'publish');
    }
}
