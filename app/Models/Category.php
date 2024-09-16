<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = array();
    public static $rules = array();
    protected $table = 'category';
    protected $appends = ['slug', 'src_cover', 'status_label', 'count_channel', 'date_label'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status', 'team_id', 'parent', 'order'
    ];

    public function team(){
    	return $this->belongsTo('App\Models\Team','team_id');
    }
    public function audios(){
    	return $this->hasMany('App\Models\Audio','category_id');
    }
    public function subcategory(){
    	return $this->hasMany('App\Models\Category','parent');
    }
    public function channels(){
    	return $this->hasMany('App\Models\Channel','category');
    }
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team', 'category_team', 'category_id', 'team_id');
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }
    public function scopeNew($q)
    {
        return $q->where('team_id', NULL);
    }

    public function getSlugAttribute(){
        return Hashids::encode($this->id);
    }

    public function getSrcCoverAttribute(){
        return get_image($this->id);
    }

    public function attachment_source(){
    	return $this->hasOne('App\Models\Attachment', 'model_id', 'id')->where('model','category')->where('status', 1);
    }

    public function getCountChannelAttribute(){
        if($this->channels){
            return $this->channels->count();
        }
        return 0;
    }

    public function getStatusLabelAttribute() {
        switch ($this->status) {
            case 'active':
                return '<span class="label label-success">Published</span>';
                break;
            case 'block':
                return '<span class="label label-info">Suspend</span>';
                break;
            case 'draft':
                return '<span class="label label-info">Draft</span>';
                break;
            case 'review':
                return '<span class="label label-info">Review</span>';
                break;

            default:
                return '<span class="label label-warning">Pending to review</span>';
                break;
        }
    }

    public function getDateLabelAttribute() {
		$date = Carbon::parse($this->updated_at); // now date is a carbon instance
		return Carbon::make($date)->isoFormat('D MMMM Y');
    }

    /**
    * Set team
    *
    * @return void
    */
    public function setTeam($id)
    {
        $this->attributes['team_id'] = $id;
        self::save();
    }
    public function setNullTeam()
    {
        $this->attributes['team_id'] = null;
        self::save();
    }
}
