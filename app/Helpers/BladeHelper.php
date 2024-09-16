<?php

use App\User;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\Page;
use App\Models\Audio;
use App\Models\Share;
use App\Models\Master;
use App\Models\Channel;
use App\Models\Comment;
use App\Models\Playlist;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Attachment;
use App\Models\Image;
use App\Models\Team;
use App\Models\TeamUserRole;
use App\Models\UserActivity;
use App\Models\Project;
use App\Models\MasterLanguages;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Resources\MemberSelect;
use App\Http\Resources\AudioListCollection;

function get_user(){
    if(Auth::check()){
        return User::find(Auth::user()->id);
    }
    return false;
}
function get_apps(){
    return Master::find(1);
}
function get_permission($type=null, $for=null){
    if($type==null){
	    return Permission::get();
    }elseif($type=='admin'){
        $avaiable = ['user', 'audit', 'channel', 'audioslide', 'comment', 'page'];
    } elseif ( $type=='team' ){
        $avaiable = ['project', 'channel', 'audioslide', 'comment', 'team', 'image'];
    }else{
        if($for=='team_member' || $for=='leader'){
            $avaiable = ['user','project', 'channel', 'audioslide', 'comment', 'team', 'image'];
        }else{
            return Permission::get();
        }
    }
	return Permission::whereIn('model', $avaiable)->orderBy('model', 'ASC')->get();
}
function get_active_categories(){
    return Category::active()->where('parent', 0)->get();

}
function get_categories(){
    return Category::active()->get()->pluck('name','id');
}
function get_team_categories(){
    $result = Category::active()->get()->pluck('name','id'); //->new()
    $result->prepend("Select categories", 0);
    return $result;
}

function get_team_user($id){
    $result = TeamUserRole::where('team_id', $id)->get()->pluck('user_id');
    return $result;
}

function check_account($type){
    if(Auth::user()->type==$type){
        return true;
    }
	return false;
}

function urlStorage(){
    return config('app.asset_url').'/';
}

function get_avatar($user){
    if(@$user->attachment_source){
        return $user->attachment_source->slug;
    }
    if(@$user->avatar!=null){
        return $user->avatar;
    }
    return url('img/pankord/user.png');
}

function get_logo($data, $option=NULL){
    if($data->slug){
        if($option=='url'){
            return $data->slug;
        }
        return '<img style="border-radius: 50%;width:100%;" src="'.$data->slug.'" alt="" />';
    }
    return '<i class="fa fa-camera" style="font-size: 30px;margin: 20px;"></i>';
}

function get_cover($data){
    
    if(@$data->background_source){
        $url = urlStorage().@$data->background_source->url;
    }else{
        if(@$data->parent){
            $url = urlStorage().@$data->parent->background_source->url;
        }else{
            $url = url('img/pankord/channel-bg-crop.jpg');
        }
    }
    return $url;
}

function get_image($data){
    if($data){
        return get_audio_cover($data);
    }
    return url('img/pankord/no-img.jpg');
}

function get_audio_source($data){
    if(@$data->audio_source){
        return urlStorage().@$data->audio_source->url;
    }
    if(@$data->parent){
        return urlStorage().@$data->parent->audio_source->url;
    }
    return urlStorage().@$data->audio_user_source->url;
}

function get_audio_cover($data){
    $result = Attachment::find(1);
    if(@$data->cover_source){
        $result = $data->cover_source;
    }
    return $result->slug;
}

function get_attachment_source($data, $type=null){
    $result = Attachment::find(1);
    if($type=='slide'){
        return $data->slide_source;
    }
    if(@$data->attachment_source){
        $result = $data->attachment_source;
    }else{
        if(@$data->parent){
            return $data->parent->attachment_source;
        }
    }
    return $result;
}

function get_attachment($data){
    $result = Attachment::find(1);
    if($data){
        $result = $data;
    }
    return urlStorage().$result->url;
}

function get_image_slide($image){
    if($image){
        if(strpos($image->source, "http://") !== false){
            return $image->source;
        }
        return urlStorage().$image->source;
    }
    return url('img/pankord/no-img.jpg');
}

/*
ADMIN MASTER
DATA SELECT
*/
function get_list_admin(){
    return User::get();
}
function get_select_admin(){
    return get_list_admin()->pluck('name', 'id');
}
function get_role_team($for=null){
    if($for=='team_member'){
        $request = Role::team()->get()->pluck('name', 'id');
    }elseif($for=='general_admin'){
        $request = Role::admin()->where('type', '!=', 'default')->get()->pluck('name', 'id');
        $request->prepend("-- Select Role --", 0);
    }else{
        $request = Role::admin()->get()->pluck('name', 'id');
        $request->prepend("-- Select Role --", 0);
    }
    return $request;
}
function get_select_categories($category){
    $request = Category::active()->where('id','!=',$category->id)->get()->pluck('name','id');
    $request->prepend("Parent", 0);
    return $request;
}
function get_my_team(){
    if(is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin'){
        $request = Team::get()->pluck('name', 'id');
        $request->prepend("-- Select Team --", 0);
    }else{
        $request = TeamUserRole::where('user_id', Auth::user()->id)->where('status', 'active')->leaderteam()->get()->pluck('team.name','team_id');
    }
    return $request;
}
function get_user_playlists(){
    $playlists = Playlist::get();
    if(count($playlists)>0){
        return $playlists;
    }
    return 0;
}
function get_default_channel(){
    return Channel::where('user_id',auth()->user()->id)->first();
}
function get_user_channels($type=null){
    if($type=="vue"){
        $channels = Channel::select('name','id')->where('user_id', Auth::user()->id)->get();
    }else{
        $channels = Auth::user()->user_channels->pluck('name', 'id');
    }
    $channels->prepend("Pilih channel", 0);
    return $channels;
}
function get_user_audios($type=null){
    if($type=="vue"){
        return Audio::select('name','id')->where('user_id', Auth::user()->id)->get();
    }
    return Auth::user()->audios->pluck('name', 'id');
}
function get_tag_link($tags){
    $html = '';
    if(count($tags)>0){
        foreach ($tags as $key => $value) {
            $html = $html. '<a target="_blank" href="'.route('web.search.tag', @$value->name).'" class="label label-info mg-5">#'.@$value->name.'</a>';
        }
    }
    return $html;
}
function get_user_teams($type=null){
    if($type=="vue"){
        return MemberSelect::collection(User::user()->get());
    }
    return User::user()->pluck('email', 'id');
}
function get_user_admin($type=null){
    if($type=="vue"){
        return MemberSelect::collection(User::creatorStreamer()->get());
    }
    return User::creatorStreamer()->pluck('email', 'id');
}
function get_category($data, $category_id=0, $audio_id=0){
    if($category_id>0){
        return Category::find($category_id)->name;
    }
    if($audio_id>0){
        $data = Audio::find($audio_id);
    }
    if(@$data->category_id!=NULL){
        return @$data->category->name;
    }elseif(@$data->channel->project){
        return @$data->channel->project->project->team->category->name;
    }else{
        return 'None';
    }
}
function get_channel_audio($audio){
    if($audio->channel_id){
        return $audio->channel->name;
    }
    return $audio->user->name;
}
function get_status($data){
    if($data->status == '0'){
        return 'Pending';
    }elseif($data->status == '1'){
        return 'Approved';
    }elseif($data->status == 'draft'){
        return 'Draft';
    }elseif($data->status == 'approve'){
        return 'Accepted';
    }elseif($data->status == 'suspend'){
        return 'Rejected';
    }elseif($data->status == 'new'){
        return 'Waiting for Audit';
    }else{
        return strtoupper($data->status);
    }
}
function get_visibility($data){
    if($data->visibility == '0'){
        return 'Need to Set';
    }
    return strtoupper($data->visibility);
}
function get_languages(){
    $request = MasterLanguages::get()->pluck('name','code');
    $request->prepend("None", 'none');
    return $request;
}

// DELETE DATA
function delete_data($datas, $type='soft', $model=null){
    if(!$datas){
        return response()->json(['result' => 'Unauthorize']);
    }
    foreach($datas as $data){

        if($model=='channel' ){
            if($data->no_audio > 0){
                return response()->json(['result' => 'Channel yang sudah memiliki Audioslide tidak bisa dihapus, silahkan hubungi team leader atau creator!']);            
            }
            if($data->source_label == 'User'){
                return response()->json(['result' => 'Channel user tidak bisa dihapus, silahkan hapus melalui User!']);            
            }elseif($data->status != 'draft' && $data->status != 'reject'){
                return response()->json(['result' => 'Channel dalam status "'.$data->status.'" tidak dapat dihapus']);            
            }
        }
        if($model=='project' ){
            if($data->status != 'draft' && $data->status != 'reject'){
                return response()->json(['result' => 'Project dalam status '.$data->status.' tidak dapat dihapus']);            
            }
        }
        if($model=='audio' ){
            if($data->status == 'revoke'){
                return response()->json(['result' => 'Audioslide dalam status '.$data->status.' tidak dapat dihapus']);            
            }
        }
        if($model=='category' ){
            if($data->teams->count()>0){
                return response()->json(['result' => 'Kategori "'.$data->name.'" masih digunakan oleh inHouse Team dan belum dapat dihapus.']);            
            }
            if($data->audios->count()>0){
                return response()->json(['result' => 'Kategori "'.$data->name.'" masih digunakan dibeberapa Konten dan belum dapat dihapus.']);            
            }
        }
        if($type=='force'){
            $data->forceDelete();
        }else{
            $data->delete();
        }
    }
    return response()->json(['result' => 'Berhasil delete data']);
}

/*
COUNTING
*/
function count_user(){
	return User::where('type', '!=', 'admin')->count();
}
function count_broadcaster(){
	return User::where('type', 'creator')->count();
}
function count_active_user(){
	return UserActivity::groupBy('user_id')->count();
}
function count_channel(){
	return Channel::count();
}
function count_audio(){
	return Audio::count();
}
function count_comment(){
	return Comment::count();
}
function count_share(){
	return Share::count();
}
function count_upload(){
	return Attachment::count();
}

function top_channel(){
    return UserActivity::topplay()
        ->join('audios', 'audios.id', 'user_activity.audio_id')
        ->join('channels', 'channels.id', 'audios.channel_id')
        ->groupBy('audios.channel_id')->get();
}

function top_audio($tab, $paginate=5){
    if($tab=='play'){
        $data = UserActivity::where('played_number', '>', 0)->groupBy('audio_id')->selectRaw('*, sum(played_number) as sum')->orderBy('sum', 'desc');
    }elseif($tab=='like'){
        $data = UserActivity::where('liked', '>', 0)->groupBy('audio_id')->selectRaw('*, sum(played_number) as sum')->orderBy('sum', 'desc');
    }elseif($tab=='comment'){
        $data = Comment::selectRaw('count(*) as sum, audio_id')->groupBy('audio_id')->orderBy('sum', 'desc');
    }else{
        $data = Share::selectRaw('count(*) as sum, audio_id')->groupBy('audio_id')->orderBy('sum', 'desc');
    }
    return $data->paginate($paginate);
}

function top_category(){
    return UserActivity::topplay()
        ->join('audios', 'audios.id', 'user_activity.audio_id')
        ->join('category', 'category.id', 'audios.category_id')
        ->where('audios.category_id','!=',NULL)
        ->groupBy('audios.category_id')->get();
}

function top_audio_channel($channel){
    $result = $channel->audios->take(5);
    return $result->sortByDesc('play_number');
}
function top_comment_channel($channel){
    $result = $channel->audios->take(5);
    return $result->sortByDesc('comment_number');
}
function top_like_channel($channel){
    $result = $channel->audios->take(5);
    return $result->sortByDesc('like_number');
}
function top_share_channel($channel){
    $result = $channel->audios->take(5);
    return $result->sortByDesc('share_number');
}
/*
Webfrontend
*/
function get_trend_audio($category=null){
    if($category){
        return Audio::withCount('played')->showPublic()->where('category_id', $category->id)->take(12)->get();
    }
    //$result = Audio::withCount(['played as play_number'])->orderByRaw('play_number desc')->showPublic()->take(12)->get();
    $audio = Audio::withCount(['played as play_number'])->orderByRaw('play_number desc')->showPublic()->take(12)->get();
    $result = $audio->sortByDesc('play_number');
    try {
        return new AudioListCollection($result);
    }catch (\Exception $e) {
        return response()->json([$e->getMessage()]);
    }
    return $result;
}

function get_category_audio($category){
    $result = [];
    if($category){
        $result = Audio::withCount('played')->showPublic()->where('category_id', $category)->paginate(10);
    }
    try {
        return new AudioListCollection($result);
    }catch (\Exception $e) {
        return response()->json([$e->getMessage()]);
    }
    return $result;
}


function get_audio($time=null){
    if($time){
        if($time=='today'){
            // current day
            return Audio::whereDate('created_at', Carbon::today())->show()->get();
        }elseif($time=='week'){
            // last 7 day + 1 day
            return Audio::whereDate( 'created_at', '<', Carbon::today())->whereDate( 'created_at', '>', Carbon::now()->subDays(8))->show()->get();
        }elseif($time=='month'){
            //last 30 day + 7 day
            return Audio::whereDate( 'created_at', '<', Carbon::now()->subDays(8))->whereDate( 'created_at', '>', Carbon::now()->subDays(37))->show()->get();
        }else{
            //last 37 day >
            return Audio::whereDate('created_at', '<', Carbon::now()->subDays(38))->show()->get();
        }
    }
    return Audio::orderBy('updated_at', 'desc')->showPublic()->get();
}

function check_link_auth($url){
    if(Auth::check()){
        return $url;
    }
    return route('login');
}

function owner_this($model){
    if(Auth::check()){
        if($model->user_id==Auth::user()->id && !$model->project){
            return true;
        }
    }
    return false;
}

function subscribe_this($model){
    if(Auth::check()){
        if(count($model->subscriber)>0){
            foreach($model->subscriber as $subscriber){
                if($subscriber && $subscriber->subscriber_id==Auth::user()->id){
                    return $subscriber;
                }
            }
        }
    }
    return 'false';
}

function get_my_activity($take=null){
    return get_user()->activitys->take($take);
}

function get_my_later_listen($take=null){
    return get_user()->laters;
}

function get_my_liked($take=null){
    return get_user()->likes;
}

function get_my_audio_activity($audio){
    if(get_user()){
        return get_user()->activitys->where('audio_id', $audio->id)->first();
    }
    return false;
}

function get_my_subscriber(){
    return get_user()->subscribers;
}

function get_count_my_views(){
    return get_user()->activity->sum('played_number');
}

function get_count_my_total_views(){
    $count = 0;
    foreach(get_user()->audios as $audio){
        $count = $count + $audio->played->sum('played_number');
    }
    return $count;
}

function get_my_top_audio(){
    return get_user()->activity->take(3);
}

function get_my_top_upload_audio(){
    return Audio::select('audios.id','audios.name', 'audios.user_id', 'user_activity.audio_id', 'audios.parent_id', 'audios.backup_id', DB::raw('SUM(user_activity.played_number) As play'))
    ->doesnthave('project')
    ->where('audios.user_id', get_user()->id)
    ->whereNull('audios.parent_id')
    ->whereNull('audios.backup_id')
    ->leftJoin('user_activity', 'audios.id', '=', 'user_activity.audio_id')
    ->groupBy('user_activity.audio_id')
    ->orderBy('play', 'desc')
    ->take(5)->get();
    // return get_user()->audios->take(3);
}

function get_my_top_upload_channel(){
    return Audio::select('audios.channel_id', 'channels.name', 'audios.user_id', 'user_activity.audio_id', 'audios.parent_id', 'audios.backup_id', DB::raw('SUM(user_activity.played_number) As play'))
    ->doesnthave('project')
    ->whereNull('audios.parent_id')
    ->whereNull('audios.backup_id')
    ->where('audios.user_id', get_user()->id)
    ->leftJoin('user_activity', 'audios.id', '=', 'user_activity.audio_id')
    ->leftJoin('channels', 'channels.id', '=', 'audios.channel_id')
    ->groupBy('audios.channel_id')
    ->orderBy('play', 'desc')
    ->take(5)->get();
    // return get_user()->audios->take(3);
}

function is_my_subscribe($channel){
    if(get_user() && $channel){
        return get_user()->subscribtions->where('channel_id', $channel->id)->first();
    }
    return get_user()->name;
}

function get_subscribe_audio_list($time){
    if(get_user()){
        $channel_ids = get_user()->list_id_subscribtions->toArray();
    }
    $data = Audio::whereIn('channel_id', $channel_ids)->where('status', 'publish')->whereNull('parent_id');

    if($time=='today'){
        $data = $data->whereDate('updated_at', '>', Carbon::now()->subDays(1));
    }elseif($time=='week'){
        $data = $data->whereDate('updated_at', '>', Carbon::now()->subDays(7))->whereDate('updated_at', '<', Carbon::now()->subDays(1));
    }elseif($time=='mounth'){
        $data = $data->whereDate('updated_at', '<', Carbon::now()->subDays(8))->whereDate('updated_at', '>', Carbon::now()->subDays(50));
    }elseif($time=='old'){
        $data = $data->whereDate('updated_at', '<', Carbon::now()->subDays(100));
    }else{
        return $data = $data->orderBy('updated_at', 'desc')->paginate(10);
    }

    return $data->get();
}

function get_channel($type=null){
    if($type=='best'){
        return Channel::best()->show()->take(6)->get();
    }elseif($type=='populer'){
        return Channel::populer()->show()->get();
    }elseif($type=='show'){
        return Channel::show()->get();
    }else{
        return Channel::orderBy('created_at', 'desc')->get();
    }
}

function get_channel_creator(){
    return User::creator()->get();
}

function get_new_anouncement(){
    return Page::page()->where('status', 'publish')->orderBy('created_at', 'desc')->first();
}

function get_news_feed(){
    return Page::where('type', 'news')->where('status', 'publish')->orderBy('created_at', 'desc')->take(5)->get();
}

function get_footer_pages(){
    return Page::footer()->publish()->orderBy('created_at', 'asc')->get();
}

//
//HELPER BLADE
//
function countFormat($num) {
    if($num>1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
    }
    return $num;
}
function find_recomendation($audio){
    $result = "";
    $data = Audio::find($audio);
    if( $data->category_id!=null ){
       $result = Audio::with('channel')->where('category_id', $data->category_id)->where('channel_id', '!=', $data->channel_id)->where('id', '!=', $audio)->showPublic()->paginate(10); //$data->category->audios()->where('id', '!=', $audio)->paginate(10);
    }
    if( !$result ){
        $result = Audio::with('channel')->where('user_id', $data->user_id)->where('channel_id', '!=', $data->channel_id)->where('id', '!=', $audio)->showPublic()->paginate(10);
    }
    return $result;
}

//AUDIO HELPER
function audio_setting_comment($audio){
    $comment = $audio->allow_comment == 0 ? 'Not Allow Comment ': ($audio->allow_comment == 1 ? 'Allow Comment ':'Review Comment ');
    $sort = $audio->sort_comment == 0 ? 'sort by Popular':'sort by Newest';

    return $comment.' '.$sort;
}
function audio_setting_rate($audio){
    return $audio->allow_rating == 0 ? 'False':'True';

}
function audio_setting_notification($audio){
    return $audio->allow_notice == 0 ? 'False':'True';
}
function audio_setting_age($audio){
    return $audio->allow_age == 0 ? 'False':'True';

}
function audio_setting_attachment($audio){
    return 0;
}
function get_request_position($request){
    $result = 0;
    if($request->to=='down'){
        $result = $request->position + 1;
    }else{
        $result = $request->position - 1;
        if($result < 0){
            $result = 0;
        }
    }

    return $result;
}

//SLIDE HELPER
function next_slide($data, $time){
    $slide = Image::where('audio_id', $data->audio_id)->where('time_show', '>', $time)->orderBy('time_show', 'asc')->first();
    return $slide;
}

function prev_slide($data, $time=null){
    if($time==null){
        return Image::where('audio_id', $data->audio_id)->where('time_show', '<', $data->time_show)->orderBy('time_show', 'desc')->first();
    }
    return Image::where('audio_id', $data->audio_id)->where('time_show', '<', $time)->orderBy('time_show', 'desc')->first();
}

// FORMAT DATA
function ga_date_readable($data){
    $monthNum  = substr($data, 4);
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F'); // March

    return $monthName.' '.mb_substr($data, 0, 4);
}
function date_label($at){
    $date = Carbon::parse($at); // now date is a carbon instance
    return Carbon::make($date)->diffForHumans();
}
function short_text($input, $length=50){
    $text = strip_tags($input);
    if(strlen($text) > $length)
        return preg_replace("/\s+?(\S+)?$/", '', substr($text, 0, $length))."...";
    return $text;
}
function convert_time($dec)
{
    // start by converting to seconds
    $seconds = floor($dec);
    // we're given hours, so let's get those the easy way
    $hours = floor($seconds / 3600);
    // since we've "calculated" hours, let's remove them from the seconds variable
    //$seconds -= $hours * 3600;
    // calculate minutes left
    $minutes = floor($seconds / 60);
    // remove those from seconds as well
    $seconds -= $minutes * 60;
    // return the time formatted HH:MM:SS
    return lz($hours).":".lz($minutes).":".lz($seconds);
}
// lz = leading zero
function lz($num)
{
    return (strlen($num) < 2) ? "0{$num}" : $num;
}
//slug maker
function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function get_notification_type($data){
    if(@$data->notification){
        if(strpos(@$data->notification->type, 'email') !== false){
            return 'email';
        }
        if(strpos(@$data->notification->type, 'app') !== false){
            return 'app';
        }
    }
    return 'none';
}

function get_list_notification($unread=true){
    if($unread){
        $data = Auth::user()->unread_notice;
    }else{
        $data = Auth::user()->notice;
    }

    return $data;
}

function is_admin($user){
    $data='false';
    if($user->roleusers){
        foreach($user->roleusers as $role){
            if($role->role_id==1){
                $data='super_admin';
            }elseif($role->role_id==2){
                $data='master_admin';
            }elseif($role->role->role_for=='admin'){
                $data='admin';
            }
        }
    }
    return $data;
}

function is_member($user){
    $data='false';
    if($user->type){
        $data='member';
    }
    return $data;
}

function is_leader($user){
    $data='false';
    if($user->roleusers){
        foreach($user->roleusers as $role){
            if($role->role_id==3){
                $data='leader';
            }
        }
    }
    return $data;
}

function is_graphic_design($user){
    $data='false';
    if($user->roleusers){
        foreach($user->roleusers as $role){
            if($role->role_id==4){
                $data='Graphic Designer';
            }
        }
    }
    return $data;
}

function is_copy_writer($user){
    $data='false';
    if($user->roleusers){
        foreach($user->roleusers as $role){
            if($role->role_id==5){
                $data='Copy Writer';
            }
        }
    }
    return $data;
}

function is_audio_enginer($user){
    $data='false';
    if($user->roleusers){
        foreach($user->roleusers as $role){
            if($role->role_id==6){
                $data='Audio Enginer';
            }
        }
    }
    return $data;
}

function is_slide_manager($user){
    $data='false';
    if($user->roleusers){
        foreach($user->roleusers as $role){
            if($role->role_id==11 || $role->role_id==8){
                $data='Slide Manager';
            }
        }
    }
    return $data;
}

function get_own_team(){
    if(Auth::check()){
        // return Auth::user()->roleusers;
        if(is_admin(Auth::user())!=='false'){
            return Team::with('leader','category')->orderBy('id', 'desc')->get();
        }
        $team_ids = TeamUserRole::where('user_id', Auth::user()->id)->where('team_id', '!=', 0)->pluck('team_id');
        //if team member show own team
        if($team_ids){
            return Team::with('leader','category')->whereIn('id', $team_ids)->orderBy('id', 'desc')->get();
        }
    }
}

function get_own_project($filter){
    if(Auth::check()){
        $data = Project::with('team')->orderBy('id', 'desc');

        if(count($filter)>0){
            foreach($filter as $key => $fi){
                if($key == 'status' && $fi != 'all'){
                    $data = $data->where($key, $fi);
                }
            }
        }

        if(is_admin(Auth::user())!='false'){
            return $data->get();
        }
        $team_ids = TeamUserRole::where('user_id', Auth::user()->id)->where('team_id', '!=', 0)->pluck('team_id');
        if($team_ids){
            return $data->whereIn('team_id', $team_ids)->get();
        }
    }
}

function get_own_channel($filter){
    if(Auth::check()){
        $data = Channel::orderBy('id', 'desc')->whereNull('parent_id')->whereNull('backup_id');
        if(count($filter)>0){
            foreach($filter as $key => $fi){
                if($key == 'status' && $fi != 'all'){
                    $data = $data->where($key, $fi);
                }
                if($key=='deleted_at' && $fi == 'deleted'){
                    $data = $data->onlyTrashed();
                }
                if($key == 'all' && $fi == 'all'){
                    $filter='all';
                }
                if($key == 'search'){
                    $data = $data->where('name', 'like', '%'.$fi.'%');
                }
                if($key == 'offset' && $fi > 0){
                    $data = $data->offset($fi)->limit(10);
                }
            }
        }else{
            $data = $data->where('status', 'publish');
        }
        if(is_admin(Auth::user())=='super_admin' || is_admin(Auth::user())=='master_admin'){
            if(@$filter=='all'){
                return $data->paginate(10);
            }
            return $data->where('status', '!=', 'draft')->paginate(10);
        }
        // if(is_admin(Auth::user())=='admin'){
        //     return $data->doesnthave('project')->get();
        // }
        if(is_admin(Auth::user())=='admin'){
            //SETUP FILTER BY CATEGORY
            $array_category = [];
            foreach(Auth::user()->admin->category as $category){
                array_push($array_category, $category['id']);
            }
            $data = $data->whereHas('audios', function($query) use ($array_category) {
                        $query->doesnthave('project')->whereIn('category_id', $array_category);
                    });
            return $data->paginate(10);
        }
        $team_ids = TeamUserRole::where('user_id', Auth::user()->id)->where('team_id', '!=', 0)->pluck('team_id');
        if($team_ids){
            $data = $data->whereHas('project.project', function($query) use ($team_ids) {
                $query->whereIn('team_id', $team_ids);
            })->paginate(10);
            return $data;
        }
    }
}

function get_own_audio($filter){
    if(Auth::check()){
        $data = Audio::orderBy('id', 'desc')->whereNull('parent_id')->whereNull('backup_id');

        if(count($filter)>0){
            foreach($filter as $key => $fi){
                if($key == 'inhouse' && $fi == 'inhouse'){
                    $data = $data->has('project');
                }
                if($key == 'upload' && $fi == 'upload'){
                    $data = $data->doesnthave('project');
                }
                if($key == 'deleted' && $fi == 'deleted'){
                    $data = $data->onlyTrashed();
                }
                if($key == 'status' && $fi != 'all'){
                    $data = $data->where($key, $fi);
                }
                if($key == 'all' && $fi == 'all'){
                    $filter='all';
                }
                if($key == 'search'){
                    $data = $data->where('name', 'like', '%'.$fi.'%');
                }
                if($key == 'offset' && $fi > 0){
                    $data = $data->offset($fi)->limit(10);
                }
            }
        }else{
            // $data = $data->where('status', 'publish');
        }

        if(is_admin(Auth::user())=='super_admin' || is_admin(Auth::user())=='master_admin'){
            if(@$filter=='all'){
                return $data->paginate(10);
            }
            return $data->where('status', '!=', 'draft')->paginate(10);
        }
        if(is_admin(Auth::user())=='admin'){
            //SETUP FILTER BY CATEGORY
            $array_category = [];
            foreach(Auth::user()->admin->category as $category){
                array_push($array_category, $category['id']);
            }
            return $data->doesnthave('project')->whereIn('category_id', $array_category)->paginate(10);
        }
        $team_ids = TeamUserRole::where('user_id', Auth::user()->id)->where('team_id', '!=', 0)->pluck('team_id');
        // return $data->get();

        if($team_ids){
            $data = $data->whereHas('project.project', function($query) use ($team_ids) {
                $query->whereIn('team_id', $team_ids);
            })->paginate(10);
            $result= $data;
        }
        return $result;
    }
}

function get_own_audio_comment($filter){
    if(Auth::check()){
        $data = Comment::whereHas('audio')->with('audio', 'user')->orderBy('id', 'desc');

        if(count($filter)>0){
            foreach($filter as $key => $fi){
                if($key == 'inhouse' && $fi == 'inhouse'){
                    $data = $data->whereHas('audio.project');
                }
                if($key == 'upload' && $fi == 'upload'){
                    $data = $data->doesnthave('audio.project');
                }
                if($key == 'deleted' && $fi == 'deleted'){
                    $data = $data->onlyTrashed();
                }
                if($key == 'status' && $fi != 'all'){
                    $data = $data->where($key, $fi);
                }
            }
        }

        if(is_admin(Auth::user())=='super_admin' || is_admin(Auth::user())=='master_admin'){
            return $data->get();
        }
        if(is_admin(Auth::user())=='admin'){
            //SETUP FILTER BY CATEGORY
            $array_category = [];
            foreach(Auth::user()->admin->category as $category){
                array_push($array_category, $category['id']);
            }
            $data = $data->whereHas('audio', function($query) use ($array_category) {
                        $query->doesnthave('project')->whereIn('category_id', $array_category);
                    });
            return $data->get();
        }
        $team_ids = TeamUserRole::where('user_id', Auth::user()->id)->where('team_id', '!=', 0)->pluck('team_id');
        // return $data->get();
        if($team_ids){
            $data = $data->whereHas('audio.project.project', function($query) use ($team_ids) {
                $query->whereIn('team_id', $team_ids);
            })->get();
            return $data;
        }
    }
}

function format_id($model, $id){
    $format_id = Hashids::connection($model)->encode($id);
    return $format_id;
}

function format_time($s){
    $seconds = $s % 60;
    $foo = $s - $seconds;
    $minutes = $foo / 60;
    $minute = $minutes % 60;
    $fooM = $minutes - $minute;
    $hour = $fooM / 60;
    if($seconds < 10){
        $seconds = sprintf("0%d", $seconds);
    }
    if($minute < 10){
        $minute = sprintf("0%d", $minute);
    }
    if($hour < 10){
        $hour = sprintf("0%d", $hour);
    }
    if($hour < 1){
        $time_text = $minute . ":" . $seconds;
    }else{
        $time_text = $hour . ":" . $minute . ":" . $seconds;
    }

    return $time_text;
}

function check_pending_comment($user, $audio){
    
    if($audio->allow_comment==2){
        return Comment::where('user_id', $user->id)->where('status', 'review')->where('audio_id', $audio->id)->count();
    }
}

function send_error_report($data){
    $report = "*Report*	:".$data['report'].
					"\n/\/\n*Pesan	:" .$data['pesan'].
					"\n/\/\n*Agen*	:" .$data['agen'].
					"\n/\/\n*Reveral*	:" .$data['reveral'].
					"\n/\/\n*URL*	:" .$data['url'].
                    "\n/\/\n*Date*	:" .$data['date'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.telegram.org/bot1521531308:AAHeNePTXEMKXwkSQp3_iVDj5jXyAnKQi74/sendMessage?chat_id=247934212&text='.urlencode($report),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $data['pesan'];
}

function url_get_contents($url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}


function count_format($num){
    if($num>1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display. ' views';
  }
  if($num<2){
    return $num.' view';
  }
  return $num.' views';
}


function filterInput($content, $type='med'){
    if ($type=='low') 
    {
        $exclude = array('<?', '?>', 'mysql_', 'base64_', 'document.cookie','alert(','eval(');
    }
    elseif ($type=='med') 
    {
        $exclude = array('&lt;script&gt;','&lt;script&gt;','&lt;/script&gt;','<script', 'script>', '</script', '<?', '?>', 'mysql_', 'base64_', '{{HTML::script', '<iframe', '</iframe', 'document.cookie','eval(','alert(', 'XMLHttpRequest', '$.get', '$.ajax', '$.post',);
    }
    elseif ($type=='high') 
    {
        $exclude = array('&lt;script&gt;','&lt;/script&gt;','&lt;iframe&gt;', '<script', 'script>', '</script', '<?', '?>', 'mysql_', 'base64_', '{{HTML::script', 'document.cookie', '<iframe', '</iframe', 'eval(','alert(', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'XMLHttpRequest', '$.get', '$.ajax', '$.post', 'http://', 'https://', '-- ');
    }
    return str_ireplace($exclude, '', $content);
}