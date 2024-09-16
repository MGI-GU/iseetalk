<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Auth\Notifications\ResetPassword;
use Carbon\Carbon;

class User extends Authenticatable //implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    protected $appends = ['format_id','slug','picture', 'role_name','date_label'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'name', 'email', 'password', 'phone', 'birthday', 'avatar', 'type', 'platform', 'role_id', 'personal_status', 'location', 'sex', 'provider', 'provider_id', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //
    //RELATIONSHIP
    //
    public function channels(){
    	return $this->hasMany('App\Models\Channel','user_id');
    }
    public function user_channels(){
    	return $this->hasMany('App\Models\Channel','user_id')->uploaded();
    }
    public function default_channel(){
    	return $this->hasOne('App\Models\Channel','user_id');
    }
    public function show_channels(){
    	return $this->hasMany('App\Models\Channel','user_id')->show();
    }
    public function audios(){
    	return $this->hasMany('App\Models\Audio','user_id')->orderBy('updated_at');
    }
    public function user_audios(){
    	return $this->hasMany('App\Models\Audio','user_id')->uploaded();
    }
    public function comments(){
    	return $this->hasMany('App\Models\Comment','user_id');
    }
    public function show_comments(){
    	return $this->hasMany('App\Models\Comment','user_id')->where('status', 'public');
    }
    public function shares(){
    	return $this->hasMany('App\Models\Share','user_id');
    }
    public function activitys(){
    	return $this->hasMany('App\Models\UserActivity','user_id')->orderBy('updated_at', 'desc');
    }
    public function laters(){
    	return $this->hasMany('App\Models\UserActivity','user_id')->where('listen_later', 1)->orderBy('updated_at');
    }
    public function likes(){
        return $this->hasMany('App\Models\UserActivity','user_id')->where('liked', 1)->orderBy('updated_at');
    }
    public function attachments(){
    	return $this->hasMany('App\Models\Attachment','user_id');
    }
    //User who follow by subsciber
    public function subscribers(){
    	return $this->hasMany('App\Models\Subscribtion','user_id');
    }
    //User who subscibe for channel / user
    public function subscribtions(){
    	return $this->hasMany('App\Models\Subscribtion','subscriber_id');
    }
    public function list_id_subscribtions(){
    	return $this->hasMany('App\Models\Subscribtion','subscriber_id')->select('channel_id');
    }
    public function roleusers(){
    	return $this->hasMany('App\Models\TeamUserRole', 'user_id');
    }
    public function main_role(){
    	return $this->hasOne('App\Models\TeamUserRole', 'user_id');
    }
    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }
    public function role(){
    	return $this->belongsTo('App\Models\Role', 'role_id'); //->admin();
    }
    public function medias(){
    	return $this->hasMany('App\Models\UserMedia', 'user_id');
    }
    public function activity(){
    	return $this->hasMany('App\Models\UserActivity', 'user_id')->orderBy('played_number', 'desc');
    }
    public function setting(){
    	return $this->hasOne('App\Models\UserSetting', 'user_id');
    }
    public function firstAudio(){
        return $this->hasOne('App\Models\Audio','user_id')->orderBy('created_at', 'desc')->show()->take(1);
    }
    public function attachment_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model','user')->where('type','image')->where('status', 1);
    }
    public function admin(){
    	return $this->belongsTo('App\Models\Admin','admin_id');
    }
    public function unread_notice(){
    	return $this->hasMany('App\Models\UserNotification', 'user_id')->unread();
    }
    public function notice(){
    	return $this->hasMany('App\Models\UserNotification', 'user_id');
    }

    //
    //ATTRIBUTE
    //
    public function getDateLabelAttribute() {
		$date = Carbon::parse($this->created_at); // now date is a carbon instance
		return Carbon::make($date)->isoFormat('D MMMM Y');
    }
    public function getSlugAttribute(){
        return Hashids::encode($this->id);
    }
    public function getPictureAttribute(){
        return get_avatar($this);
    }
    public function getRoleNameAttribute(){
        if($this->role_id){
            return $this->role->name;
        }
        return null;
    }
    public function getFormatIdAttribute() {
        return format_id('user', $this->id);
    }

    //
    //SCOPE
    //
    public function scopeAdmin($q)
    {
        return $q->where('type', 'admin');
    }
    public function scopeUser($q)
    {
        return $q->whereIn('type', ['streamer','creator', 'member']);
    }
    public function scopeCreator($q)
    {
        return $q->orWhere('type', 'creator');
    }
    public function scopeCreatorOnly($q)
    {
        return $q->where('type', 'creator');
    }
    public function scopeMember($q)
    {
        return $q->orWhere('type', 'streamer');
    }
    public function scopeCreatorStreamer($q)
    {
        return $q->whereIn('type', ['streamer','creator']);
    }
    public function scopeInhouse($q)
    {
        return $q->admin()->where('role_id',null)->orWhere('role_id','>',1);
    }
}
