<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $guarded = array();
    public static $rules = array();
    protected $table = 'teams';
    protected $appends = ['format_id','leader_name', 'count_project', 'count_channel', 'count_audio', 'count_member'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description'
    ];

    public function roleuser(){
    	return $this->hasMany('App\Models\TeamUserRole', 'team_id');
    }
    public function rolemember(){
    	return $this->hasMany('App\Models\TeamUserRole', 'team_id')->where('role_id', '!=', 3);
    }
    public function leader(){
    	return $this->hasOne('App\Models\TeamUserRole', 'team_id')->where('role_id',3);
    }
    public function categoryTeam(){
    	return $this->hasOne('App\Models\CategoryTeam', 'team_id');
    }
    public function projects(){
    	return $this->hasMany('App\Models\Project', 'team_id');
    }
    public function category()
    {
        return $this->hasOneThrough('App\Models\Category', 'App\Models\CategoryTeam', 'team_id', 'id', 'id', 'team_id');
    }

    public function getCountProjectAttribute() {
        return $this->projects->count();
    }

    public function getCountChannelAttribute() {
        $sum_channel_number = 0;
        if($this->projects){
            // return $this->category->channels->count();
            foreach($this->projects as $project){
                $sum_channel_number += intval($project->channels->count());
            }
        }
        return $sum_channel_number;
        
    } 
    public function getCountMemberAttribute() {
        if($this->rolemember){
            return $this->rolemember->count();
        }else{
            return 0;
        }
    }

    public function getCountAudioAttribute() {
        $count = 0;
        // if($this->category ){
        //     if($this->category->channels->count()>0){
        //         foreach($this->category->channels as $channel){
        //             $count += $channel->no_audio;
        //         }
        //     }
        // }
        if($this->projects){
            foreach($this->projects as $project){
                if(@$project->channels){
                    foreach($project->channels as $channel){
                        $count += intval($channel->no_audio);
                    }
                }
            }
        }
        return $count;
    }

    public function getLeaderNameAttribute() {
        if($this->leader && $this->leader->user){
            return $this->leader->user->name;
        }
        return '-';
    }

    public function getFormatIdAttribute() {
        return format_id('team', $this->id);
    }
    
    //SCOPE
    public function scopeOwn($q)
    {
        return $q->where('is_read');
    }

    //BOOT
    protected static function boot() {
        parent::boot();

        static::deleting(function($team) { // called BEFORE delete()
            // $team->roleuser->delete();
        });
    }
}
