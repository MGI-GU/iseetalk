<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Channel extends Model
{
    use SoftDeletes;
    
    protected $guarded = array();
    public static $rules = array();
    protected $table = 'channels';
    protected $appends = ['format_id', 'date_label', 'last_update', 'status_label','type_label','no_audio', 'no_subscriber', 'source_label', 'play_number', 'slug', 'src_cover'];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status', 'user_id', 'cover', 'logo', 'email', 'location', 'media', 'category', 'type', 'visibility', 'parent_id', 'backup_id'
    ];

    public function subscriber(){
    	return $this->hasMany('App\Models\Subscribtion','channel_id');
    }

    public function subscriber_active(){
    	return $this->hasMany('App\Models\Subscribtion','channel_id')->where('approved', '1');
    }

    public function subscriber_request(){
    	return $this->hasMany('App\Models\Subscribtion','channel_id')->where('approved', '0');
    }

    public function project(){
    	return $this->hasOne('App\Models\ContentProject','model_id')->where('model', 'channel');
    }

    public function audios(){
    	return $this->hasMany('App\Models\Audio','channel_id')->orderBy('position', 'asc')->where('parent_id', NULL)->where('backup_id', NULL);
    }

    public function active_audios(){
    	return $this->hasMany('App\Models\Audio','channel_id')->where('status', 'publish')->orderBy('position', 'asc');
    }

    public function playlists(){
    	return $this->hasMany('App\Models\Playlist','channel_id');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'content_tag');
    }

    public function subscribers()
    {
        return $this->belongsToMany('App\User', 'subscriptions', 'channel_id', 'subscriber_id')->where('alert_type', 1);
    }

    public function parent(){
    	return $this->belongsTo('App\Models\Channel','parent_id');
    }

    public function edition(){
    	return $this->hasOne('App\Models\Channel','parent_id');
    }

    public function publish(){
    	return $this->belongsTo('App\Models\Audio','backup_id');
    }
    public function backup(){
    	return $this->hasOne('App\Models\Channel','backup_id');
    }

    /**
     * One to One Polymorphic Audit.
     */
    public function audit()
    {
        return $this->morphOne('App\Models\Audit', 'model');
    }

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }

    public function attachment_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model','channel')->where('type', 'cover')->where('status', 1);
    }

    public function cover_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model','channel')->where('type', 'cover')->where('status', 1);
    }

    public function background_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model','channel')->where('type', 'background')->where('status', 1);
    }

    function isVerified() 
    {
        if($this->status == 2)  return true;
        else return false;
    }

    public function getDateLabelAttribute() {
		$date = Carbon::parse($this->created_at); // now date is a carbon instance
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
            case 'approve':
                return '<span class="label label-primary">Waiting for Audition</span>';
                break;
            case 'reject':
                return '<span class="label label-danger">Rejected</span>';
                break;
            case 'upload':
                return '<span class="label label-info">Waiting for Approval</span>';
                break;
            case 'review':
                return '<span class="label label-info">Under Audition</span>';
                break;
            case 'public':
                return '<span class="label label-success">Public</span>';
                break;
            case 'revision':
                return '<span class="label label-warning">Need to Update</span>';
                break;
            case 'draft':
                return '<span class="label label-default">Draft</span>';
                break;
            case 'unpublish':
                return '<span class="label label-danger">Unpublished</span>';
                break;
            default:
                return '<span class="label label-default">'.$this->status.'</span>';
                break;
        }
    }

    public function getTypeLabelAttribute() {
        switch ($this->type) {
            case 'best':
                return '<span class="label label-primary">Pilihan '.get_apps()->name.'</span>';
                break;
            case 'populer':
                return '<span class="label label-danger">Populer</span>';
                break;

            default:
                return '';
                break;
        }
    }

    public function getNoAudioAttribute() {
        return $this->audios->count();
    }

    public function getSourceLabelAttribute() {
        if( $this->project || $this->parent ){
            return 'inHouse';
        }else{
            return 'User';
        }
    }

    public function getPlayNumberAttribute() {
        $count = 0;
        foreach($this->active_audios as $audio){
            $count += $audio->played->sum('played_number');
        }
        return $count. ' x';
    }

    public function getSlugAttribute(){
        return Hashids::encode($this->id);
    }

    public function getNoSubscriberAttribute(){
        return countFormat($this->subscriber->count());
    }

    public function getSrcCoverAttribute(){
        return get_attachment_source($this)->slug;
    }

    public function getFormatIdAttribute() {
        return format_id('channel', $this->id);
    }

    public function scopeBest($q)
    {
        return $q->where( 'type', 'best');
    }
    public function scopePopuler($q)
    {
        return $q->where( 'type', 'populer');
    }
    public function scopeShow($q)
    {
        return $q->where('status', 'publish');
    }
    public function scopeUnsubscribe($q)
    {
        if(Auth::check()){
            $user = Auth::user()->list_id_subscribtions;
            // dd($user->toArray());
            return $q->whereNotIn('id', $user->pluck('channel_id'));
        }else{
            return $q;
        }
    }
    public function scopeUploaded($q)
    {
        return $q->doesnthave('project')->whereNotIn('status', ['deleted'])->orderBy('created_at', 'desc')->where("parent_id", null)->where("backup_id", null);
    }

    /**
     * Set channel
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
    public function setWaitApproval()
    {
        $this->attributes['status'] = 'new';
        self::save();
    }
    public function setDelete()
    {
        $this->attributes['status'] = 'deleted';
        self::save();
    }
    public function setRevoke()
    {
        $this->attributes['status'] = 'draft';
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
