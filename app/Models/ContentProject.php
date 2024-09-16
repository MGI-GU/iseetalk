<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentProject extends Model
{
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'content_projects';
    public $timestamps = false;
    protected $appends = ['source_label', 'status_label'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id','model','model_id','source', 'status', 'note', 'weblink'
    ];

    public function project(){
    	return $this->belongsTo('App\Models\Project','project_id');
    }

    public function channel(){
    	return $this->belongsTo('App\Models\Channel','model_id');
    }

    public function audio(){
    	return $this->belongsTo('App\Models\Audio','model_id');
    }

    public function source_content(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model','contentProject')->where('type', 'source')->where('status', 1);
    }

    public function getSourceLabelAttribute() {
        switch ($this->source) {
            case 'audio_file':
                return 'Attachment from Audio File';
                break;
            case 'text_file':
                return 'Attachment from Text File';
                break;
            case 'web_link':
                return 'Web Link';
                break;

            default:
                return 'Not Set';
                break;
        }
    }

    public function getStatusLabelAttribute() {
        switch ($this->status) {
            case 'step1':
                return 'Copy Writer';
                break;
            case 'step2':
                return 'Audio Enginner';
                break;
            case 'step3':
                return 'Slide Manager';
                break;
            case 'step4':
                return 'Graphic designer';
                break;
            case 'review':
                return 'Leader Review';
                break;
            default:
                return 'Completed';
                break;
        }
    }
}
