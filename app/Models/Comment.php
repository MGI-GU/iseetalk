<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Comment extends Model
{
  use SoftDeletes;

  protected $guarded = array();
  public static $rules = array();
  protected $table = 'comments';
  protected $appends = ['date_label','status_label', 'user_name', 'user_pic'];
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'comment', 'audio_id', 'comment_id', 'user_id', 'status'
  ];

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  public function comments()
  {
    return $this->hasMany('App\Models\Comment', 'comment_id');
  }
  public function comment_own()
  {
    return $this->belongsTo('App\Models\Comment', 'comment_id');
  }
  public function audio()
  {
    return $this->belongsTo('App\Models\Audio', 'audio_id');
  }

  public function getDateLabelAttribute()
  {
    $date = Carbon::parse($this->created_at); // now date is a carbon instance
    return Carbon::make($date)->diffForHumans();
  }

  public function getUserNameAttribute()
  {
    return $this->user->name;
  }

  public function getUserPicAttribute()
  {
    return $this->user->picture;
  }

  public function getStatusLabelAttribute() {
    switch ($this->status) {
        case 'public':
            return '<span class="label label-success">Public Published</span>';
            break;
        case 'review':
            return '<span class="label label-warning">Waiting to Published</span>';
            break;
        case 'publish':
            return '<span class="label label-success">Published after Review</span>';
            break;

        default:
            return '<span class="label label-danger">Spam</span>';
            break;
    }
}

  /**
   * Set delete status comment
   *
   * @return void
   */
  public function setSpam()
  {
    $this->attributes['status'] = 'spam';
    self::save();
  }
  public function setPublish()
  {
    $this->attributes['status'] = 'publish';
    self::save();
  }
  public function setReview()
  {
    $this->attributes['status'] = 'review';
    self::save();
  }
  public function setDelete()
  {
    $this->attributes['status'] = 'delete';
    self::save();
  }
}
