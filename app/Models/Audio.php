<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Audio extends Model
{
    use SoftDeletes;
    
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'audios';
    protected $appends = ['format_id','date_label', 'last_update', 'status_label', 'visibility_label', 'source_label', 'comment_number', 'share_number', 'play_number', 'like_number', 'slug', 'src_cover'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source', 'thumbnail', 'duration', 'name', 'description', 'visibility', 'status', 'channel_id', 'category_id', 'user_id','language','allow_rating','allow_notice','allow_age','sort_comment','allow_comment','contain','position', 'parent_id', 'backup_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }

    public function channel(){
    	return $this->belongsTo('App\Models\Channel','channel_id');
    }

    public function category(){
    	return $this->belongsTo('App\Models\Category','category_id');
    }

    public function has_channel(){
    	return $this->hasOne('App\Models\Channel','channel_id');
    }

    public function project(){
    	return $this->hasOne('App\Models\ContentProject', 'model_id', 'id')->where('model', 'audio');
    }
    public function comments(){
    	return $this->hasMany('App\Models\Comment','audio_id');
    }
    public function show_comments(){
    	return $this->hasMany('App\Models\Comment','audio_id')->whereIn('status', ['public', 'publish']);
    }
    
    public function liked(){
    	return $this->hasMany('App\Models\UserActivity','audio_id')->where('liked', true);
    }
    public function disliked(){
    	return $this->hasMany('App\Models\UserActivity','audio_id')->where('dislike', true);
    }
    public function shares(){
    	return $this->hasMany('App\Models\Share','audio_id');
    }
    public function played(){
    	return $this->hasMany('App\Models\UserActivity','audio_id');
    }
    public function audio_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model', 'audio')->where('type', 'audio_file')->where('status', 1)->orderBy('created_at', 'DESC');
    }
    public function pdf_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model', 'audio')->where('type', 'pdf')->where('status', 1);
    }
    public function slide(){
        return $this->hasMany('App\Models\Image','audio_id');
    }
    public function slide_source(){
        return $this->hasMany('App\Models\Image','audio_id')->where('time_end', '!=', 0)->orderBy('time_show', 'asc');
    }
    public function active_slide(){
        return $this->hasMany('App\Models\Image','audio_id')->where('time_end', '>', 1);
    }
    public function first_slide(){
        return $this->hasMany('App\Models\Image','audio_id')->where('time_show', 0);
    }
    public function playlists(){
        return $this->belongsToMany('App\Models\Playlist');
    }
    public function audio_user_source(){
    	return $this->belongsTo('App\Models\Attachment','source');
    }
    public function attachment_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model','audio')->where('type', 'attachment')->where('status', 1);
    }
    public function cover_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model','audio')->where('type', 'cover')->where('status', 1);
    }
    public function attachment_sources(){
    	return $this->hasMany('App\Models\Attachment', 'model_id', 'id')->where('model','audio')->where('type', 'attachment')->where('status', 1)->orderBy('created_at', 'desc');
    }

    public function parent(){
    	return $this->belongsTo('App\Models\Audio','parent_id');
    }

    public function edition(){
    	return $this->hasOne('App\Models\Audio','parent_id');
    }

    public function publish(){
    	return $this->belongsTo('App\Models\Audio','backup_id');
    }
    public function backup(){
    	return $this->hasOne('App\Models\Audio','backup_id');
    }

    /**
     * Many to Many Polymorphic HashTag.
     */
    public function tags(){
        return $this->morphToMany('App\Models\Tag', 'content_tag');
    }

    /**
     * One to One Polymorphic Audit.
     */
    public function audit()
    {
        return $this->morphOne('App\Models\Audit', 'model');
    }
    public function orderable()
    {
        return $this->morphOne('App\Models\OrderPosition', 'orderable');
    }

    /**
     * Addtional Attribute
     */
    public function getDateLabelAttribute() {
		$date = Carbon::parse($this->created_at); // now date is a carbon instance
		// return Carbon::make($date)->diffForHumans();
		return Carbon::make($date)->isoFormat('D MMMM Y');
    }

    public function getLastUpdateAttribute() {
		$date = Carbon::parse($this->updated_at); // now date is a carbon instance
		return Carbon::make($date)->diffForHumans();
    }
    
    public function getStatusLabelAttribute() {
        switch ($this->status) {
            case 'publish':
                return '<span class="label label-success">Published</span>';
                break;
            case 'unpublish':
                return '<span class="label label-danger">Unpublished</span>';
                break;
            case 'reject':
                return '<span class="label label-danger">Rejected</span>';
                break;
            case 'revision':
                return '<span class="label label-danger">Rejected</span>';
                break;
            case 'draft':
                return '<span class="label label-default">Draft</span>';
                break;
            case 'review':
                return '<span class="label label-info">Waiting for Audition</span>';
                break;
            case 'revoke':
                return '<span class="label label-warning">Revoke</span>';
                break;

            default:
                return '<span class="label label-info">Under Audition</span>';
                break;
        }
    }
    public function getVisibilityLabelAttribute() {
        switch ($this->visibility) {
            case 'public':
                return '<span class="label label-info">Public</span>';
                break;
            case 'private':
                return '<span class="label label-danger">Private</span>';
                break;

            default:
                return '<span class="label label-info">Public</span>';
                break;
        }
    }
    public function getCommentNumberAttribute() {
        return $this->comments->count();
    }
    public function getShareNumberAttribute() {
        return $this->shares->count();
    }
    public function getSourceLabelAttribute() {
        if( $this->project ){
            return 'inHouse';
        }else{
            return 'User';
        }
    }
    public function getLikeNumberAttribute() {
        return $this->liked->count();
    }
    public function getPlayNumberAttribute() {
        if($this->played->sum('played_number')>1)
            return (int) $this->played->sum('played_number');
        return (int) $this->played->sum('played_number');
    }
    public function getSlugAttribute(){
        return Hashids::encode($this->id);
    }
    public function getSrcCoverAttribute(){
        return get_audio_cover($this);
    }
    public function getFormatIdAttribute() {
        return format_id('audioslide', $this->id);
    }

    // 
    // SCOPE
    // 
    public function scopeShowPublic($q)
    {
        return $q->whereHas('channel', function ($query) {
            $query->where('status', 'publish');
        })->where('status', '=', 'publish')->where('visibility', '=', 'public');
    }
    public function scopePublish($q)
    {
        return $q->whereHas('channel', function ($query) {
            $query->where('status', 'publish');
        })->where('status', '=', 'publish');
    }
    public function scopeSubToday($q)
    {
        return $q->whereDate('created_at', Carbon::today());
    }
    public function scopeSubWeek($q)
    {
        return $q->whereDate( 'created_at', '<', Carbon::today())->whereDate( 'created_at', '>', Carbon::now()->subDays(8));
    }
    public function scopeSubMonth($q)
    {
        return $q->whereDate( 'created_at', '<', Carbon::now()->subDays(8))->whereDate( 'created_at', '>', Carbon::now()->subDays(37));
    }
    public function scopeSubOlder($q)
    {
        return $q->whereDate('created_at', '<', Carbon::now()->subDays(38));
    }
    public function scopeShow($q)
    {
        return $q->doesnthave('project')->where("parent_id", null)->where("backup_id", null)->whereNotIn('status', ['deleted','block'])->whereHas('cover_source')->orderBy('created_at', 'desc');
    }
    public function scopeNewest($q)
    {
        return $q->show()->orderBy( 'created_at', 'desc')->take(1);
    }
    public function scopeUploaded($q)
    {
        return $q->doesnthave('project')->whereNotIn('status', ['deleted'])->orderBy('created_at', 'desc')->where("parent_id", null)->where("backup_id", null);
    }
    public function scopeOrder($q)
    {
        return $q->whereHas('orderable', function ($query) {
            $query->orderBy('position', 'asc');
        });
    }

    /**
    * Set audio
    *
    * @return void
    */
    public function setLike($id)
    {
        $this->attributes['team_id'] = $id;
        self::save();
    }
    public function setSave($id)
    {
        $this->attributes['team_id'] = $id;
        self::save();
    }
    public function setShare($id)
    {
        $this->attributes['team_id'] = $id;
        self::save();
    }
    public function setDeleteUser()
    {
        $this->attributes['status'] = 'deleted';
        self::save();
    }
    public function setRevoke()
    {
        $this->attributes['status'] = 'revoke';
        self::save();
    }
    public function setUnpublish()
    {
        $this->attributes['status'] = 'unpublish';
        self::save();
    }
    public function setPublish()
    {
        $this->attributes['status'] = 'publish';
        self::save();
    }
}
