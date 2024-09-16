<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('web.index');
// })->name('home');
// Route::get('/home', function () {
//     return view('web.index');
// })->name('home.index');

Route::get('/category/{category}', function () {
    return view('web.category');
});
Route::get('/daftar', function () {
    return view('auth.register');
});
// Route::get('/share/{content}', function () {
//     return view('web.share');
// });

Route::get('/', 'HomeController@frontIndex')->name('web.index');
Route::get('/home', 'HomeController@index')->name('home.index');

Route::get('/page/{slug}', 'Web\PageController@show')->name('web.page');
Route::get('/page/web', 'Web\PageController@show')->name('web.page.footer');
Route::get('/upload', 'Web\UploadController@index')->name('upload');
Route::post('/upload', 'Web\UploadController@store')->name('upload.store')->middleware('role:creator');
Route::post('/upload/{id}', 'Web\UploadController@update')->name('upload.update')->middleware('role:creator');
Route::post('/upload/cancel', 'Web\UploadController@store')->name('upload.cancel')->middleware('role:creator');
Route::get('/upload/{id}', 'Web\UploadController@show')->name('upload.finish')->middleware('role:creator');

Route::get('/category', 'Web\CategoryController@index')->name('web.setting.index');
Route::get('/setting', 'Web\SettingController@index')->name('web.setting.index');
Route::get('/setting/{page}', 'Web\SettingController@show')->name('web.setting.show');
Route::post('/setting', 'Web\SettingController@store')->name('web.setting.store');
Route::put('/setting/{setting}', 'Web\SettingController@update')->name('web.setting.update');
Route::post('/feed/{name}/{id}', 'Web\FeedController@store')->name('web.feed.store');
Route::get('/feed/{name}', 'Web\FeedController@show')->name('web.feed.show');
Route::get('/subscriptions', 'Web\SubscribeController@index')->name('web.subscribe.index');
Route::post('/subscribe/{channel}', 'Web\SubscribeController@store')->name('web.subscribe.store');
Route::get('/library', 'Web\LibraryController@index')->name('web.library.index');
Route::get('/user/{id}', 'Web\ChannelController@user')->name('web.channel.user');
Route::get('/mychannel', 'Web\ChannelController@index')->name('web.channel.index');
Route::get('/browse', 'Web\ChannelController@browse')->name('web.channel.browse');
Route::get('/channel/{channel}', 'Web\ChannelController@show')->name('web.channel.show');
Route::get('/channel/{channel}/{page}', 'Web\ChannelController@page')->name('web.channel.page');
Route::get('/trending', 'Web\TrendingController@index')->name('web.trending');
Route::get('/listen/{id}', 'Web\ListenController@show')->name('web.listen');
Route::post('/listen/{id}', 'Web\ListenController@store')->name('web.listen.post');
Route::post('/comment/{audio}/post', 'Web\CommentController@store')->name('web.audio.comment.post');

Route::get('/attachment/{id}', 'Web\AttachmentController@show')->name('attachment.show');
Route::get('/attachment/{id}/download', 'Web\AttachmentController@download')->name('attachment.download');

//NEXT PROGRESS AFTER PDF/PPT SUCCESS UPLOAD
// Route::get('/attachment/{id}/generate', 'Web\AttachmentController@generate')->name('attachment.generate');
//NEXT PROGRESS AFTER PDF/PPT SUCCESS SPLING
// Route::get('/image/{id}/upload', 'Web\AttachmentController@upload')->name('attachment.slide.image');

Route::post('/search', 'Web\SearchController@show')->name('web.search');
Route::get('/result/{keyword}', 'Web\SearchController@show')->name('web.search.show');
Route::get('/share/{id}', 'Web\ListenController@share')->name('web.share');
Route::get('/hashtag/{keyword}', 'Web\SearchController@tag')->name('web.search.tag');

/*
REQUEST VUE AJAX
*/
Route::get('/listen/{id}/comments', 'Web\CommentController@show')->name('web.audio.comment');
Route::get('/audio/{id}/recommended', 'Web\AudioController@show')->name('web.audio.recomend');


/*
STUDIO
*/
Route::group(['prefix' => 'studio', 'middleware' => 'role:creator'], function(){
    Route::get('/', 'Studio\DashboardController@index')->name('studio.index');

    Route::get('/audio', 'Studio\AudioController@index')->name('studio.audio.index');
    Route::get('/audio/{audio}', 'Studio\AudioController@show')->name('studio.audio.show');
    Route::get('/audio/{audio}/{page}', 'Studio\AudioController@edit')->name('studio.audio.edit');
    Route::post('/upload/audio', 'Studio\AudioController@store')->name('studio.audio.store');
    Route::put('/audio/{audio}', 'Studio\AudioController@update')->name('studio.audio.update');
    Route::post('/audio/reorder', 'Studio\AudioController@order')->name('studio.audio.order');
    Route::post('/audio/{audio}/delete', 'Studio\AudioController@destroy')->name('studio.audio.delete');
    Route::get('/audio/{audio}/update/{status}', 'Studio\AudioController@status')->name('studio.audio.update.status');

    Route::get('/channel', 'Studio\ChannelController@index')->name('studio.channel.index');
    Route::get('/channel/{id}', 'Studio\ChannelController@show')->name('studio.channel.edit');
    Route::get('/channel/{id}/edit', 'Studio\ChannelController@edit')->name('studio.channel.audio');
    Route::put('/channel/{channel}', 'Studio\ChannelController@update')->name('studio.channel.update');
    Route::post('/channel/{channel}/delete', 'Studio\ChannelController@destroy')->name('studio.channel.delete');
    Route::delete('/channel', 'Studio\ChannelController@delete')->name('studio.channel.remove');
    Route::get('/channel/{channel}/update/{status}', 'Studio\ChannelController@status')->name('studio.channel.update.status');
    Route::get('/channel/{id}/subscriber', 'Studio\ChannelController@subscriber')->name('studio.channel.update.subscriber');
    
    Route::get('/analytic', 'Studio\AnalyticController@index')->name('studio.analytic');
    Route::get('/analytic/audio/list', 'Studio\AnalyticController@audio')->name('studio.analytic.audio.list');
    Route::get('/analytic/{audio}', 'Studio\AnalyticController@show')->name('studio.analytic.audio');

    Route::get('/comments', 'Studio\CommentController@index')->name('studio.comment');
    Route::get('/comment/{comment}', 'Studio\CommentController@edit')->name('studio.comment.edit');
    Route::get('/comment/{comment}/spam', 'Studio\CommentController@destroy')->name('studio.comment.delete');
    Route::post('/comment/publish', 'Studio\CommentController@publish')->name('studio.comment.publish');
    Route::delete('/comment', 'Studio\CommentController@delete')->name('studio.comment.remove');

    Route::get('/audio/{audio}/comment', 'Studio\CommentController@show')->name('studio.audio.comment');
    Route::post('/audio/{audio}/comment', 'Studio\CommentController@store')->name('studio.comment.store');
    Route::get('/audio/{audio}/comment/comments', 'Studio\CommentController@show')->name('studio.audio.comment');
    Route::get('/audio/{audio}/comment/comments/comments', 'Studio\CommentController@show')->name('studio.audio.comment.api');

    Route::post('/slide', 'Studio\SlideController@store')->name('studio.slide.get');
    Route::put('/slide/{slide}', 'Studio\SlideController@update')->name('studio.slide.update');
    Route::delete('/slide/draft', 'Studio\SlideController@draft')->name('studio.slide.draft');
    Route::get('/slide/setup', 'Studio\SlideController@setup')->name('studio.slide.setup');
    Route::get('/slide/{attachment}/recreate', 'Studio\SlideController@create')->name('studio.slide.create');
    Route::get('/slide/{attachment}/refresh', 'Studio\SlideController@refresh')->name('studio.slide.attach.refresh');
    Route::post('/slide/restore', 'Studio\SlideController@restore')->name('studio.slide.restore');
    Route::post('/slide/replace', 'Studio\SlideController@replace')->name('studio.slide.replace');
    Route::delete('/slide', 'Studio\SlideController@delete')->name('studio.slide.delete');
    Route::delete('/slide/attachment/{attachment}', 'Studio\SlideController@destroy')->name('studio.slide.attach.delete');

    Route::get('/channel/create/new', 'Studio\ChannelController@create')->name('studio.channel.create');
    Route::post('/create', 'Studio\ChannelController@store')->name('studio.channel.store');

    Route::post('/search', 'Studio\SearchController@show')->name('studio.search');
    Route::get('/result/{keyword}', 'Studio\SearchController@show')->name('studio.search.show');

    Route::get('/download/{id}', 'Studio\DownloadController@show')->name('studio.download');
    Route::post('/duplicate/slide', 'Studio\SlideController@copy')->name('studio.slide.copy');

});

/*
ADMIN
*/
Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function(){
    Route::get('/', 'Admin\DashboardController@index')->name('admin.index');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');
    Route::get('/analytic/{page}', 'Admin\DashboardController@analytic')->name('admin.analytic');

    Route::get('/user', 'Admin\UserController@index')->name('admin.user.index');
    Route::get('/user/add', 'Admin\UserController@create');
    Route::post('/user', 'Admin\UserController@store')->name('admin.user.store');
    Route::get('/user/{user}', 'Admin\UserController@show')->name('admin.user.show');
    Route::get('/user/{user}/edit', 'Admin\UserController@edit')->name('admin.user.edit');
    Route::put('/user/{user}', 'Admin\UserController@update')->name('admin.user.update');
    Route::post('/user/delete', 'Admin\UserController@delete')->name('admin.user.delete');
    Route::post('/user/restore', 'Admin\UserController@restore')->name('admin.user.restore');
    Route::delete('/user/{user}', 'Admin\UserController@destroy')->name('admin.user.destroy');

    Route::get('/category', 'Admin\CategoryController@index')->name('admin.category.index');
    Route::get('/category/add', 'Admin\CategoryController@create');
    Route::get('/category/{category}/remove', 'Admin\CategoryController@remove')->name('admin.category.remove.team');
    Route::post('/category', 'Admin\CategoryController@store')->name('admin.category.store');
    Route::get('/category/{category}', 'Admin\CategoryController@edit')->name('admin.category.edit');
    Route::put('/category/{category}', 'Admin\CategoryController@update')->name('admin.category.update');
    Route::post('/category/restore', 'Admin\CategoryController@restore')->name('admin.category.restore');
    Route::delete('/category/delete', 'Admin\CategoryController@delete')->name('admin.category.delete');
    Route::delete('/category', 'Admin\CategoryController@destroy')->name('admin.category.destroy');

    Route::get('/comment', 'Admin\CommentController@index')->name('admin.comment.index');
    Route::post('/comment/{audio}', 'Admin\CommentController@store')->name('admin.comment.store');
    Route::get('/comment/{comment}', 'Admin\CommentController@edit')->name('admin.comment.edit');
    Route::put('/comment/{comment}', 'Admin\CommentController@update')->name('admin.comment.update');
    Route::post('/comment/set/publish', 'Admin\CommentController@publish')->name('admin.comment.publish');
    Route::post('/comment/user/restore', 'Admin\CommentController@restore')->name('admin.comment.restore');
    Route::get('/comment/{comment}/spam', 'Admin\CommentController@spam')->name('admin.comment.spam');
    Route::delete('/comment/delete', 'Admin\CommentController@delete')->name('admin.comment.delete');

    Route::get('/role', 'Admin\RoleController@index')->name('admin.role.index');
    Route::get('/role/add', 'Admin\RoleController@create');
    Route::post('/role', 'Admin\RoleController@store')->name('admin.role.store');
    Route::get('/role/{role}', 'Admin\RoleController@edit')->name('admin.role.edit');
    Route::put('/role/{role}', 'Admin\RoleController@update')->name('admin.role.update');
    Route::delete('/role/{role}', 'Admin\RoleController@destroy')->name('admin.role.delete');

    Route::get('/audit', 'Admin\AuditController@index')->name('admin.audit.index');
    Route::get('/audit/{audit}', 'Admin\AuditController@edit')->name('admin.audit.edit');
    Route::put('/audit/{audit}', 'Admin\AuditController@update')->name('admin.audit.update');

    Route::get('/role', 'Admin\RoleController@index')->name('admin.role.index');
    Route::get('/role/add', 'Admin\RoleController@create');
    Route::post('/role', 'Admin\RoleController@store')->name('admin.role.store');
    Route::get('/role/{role}', 'Admin\RoleController@edit')->name('admin.role.edit');
    Route::put('/role/{role}', 'Admin\RoleController@update')->name('admin.role.update');
    Route::delete('/role', 'Admin\RoleController@destroy')->name('admin.role.delete');

    Route::get('/member', 'Admin\MemberController@index')->name('admin.member.index');
    Route::get('/member/index', 'Admin\MemberController@index')->name('admin.admin.index');
    Route::get('/member/add', 'Admin\MemberController@create');
    Route::post('/member', 'Admin\MemberController@store')->name('admin.member.store');
    Route::get('/member/{member}', 'Admin\MemberController@edit')->name('admin.member.edit');
    Route::put('/member/{member}', 'Admin\MemberController@update')->name('admin.member.update');
    Route::delete('/member', 'Admin\MemberController@destroy')->name('admin.member.delete');
    Route::delete('/member/{member}', 'Admin\MemberController@delete')->name('admin.member.deleteByid');

    Route::get('/team', 'Admin\TeamController@index')->name('admin.team.index');
    Route::get('/team/add', 'Admin\TeamController@create');
    Route::post('/team', 'Admin\TeamController@store')->name('admin.team.store');
    Route::get('/team/{team}/show', 'Admin\TeamController@show')->name('admin.team.show');
    Route::get('/team/{team}', 'Admin\TeamController@edit')->name('admin.team.edit');
    Route::put('/team/{team}', 'Admin\TeamController@update')->name('admin.team.update');
    Route::post('/team/{team}/add', 'Admin\TeamController@add')->name('admin.team.add.user');
    Route::get('/team/member/{role}', 'Admin\TeamController@updateMember')->name('admin.team.get.user');
    Route::put('/team/member/{role}', 'Admin\TeamController@updateMember')->name('admin.team.update.user');
    Route::get('/team/{team}/remove', 'Admin\TeamController@remove')->name('admin.team.remove.user');
    Route::post('/team/restore', 'Admin\TeamController@restore')->name('admin.team.restore');
    Route::delete('/team/delete', 'Admin\TeamController@delete')->name('admin.team.delete');
    Route::delete('/team/{team}', 'Admin\TeamController@destroy')->name('admin.team.destroy');
    Route::get('/team/category/{team}/remove', 'Admin\TeamController@removeCategory')->name('admin.team.remove.category');

    Route::get('/page', 'Admin\PageController@index')->name('admin.page.index');
    Route::get('/page/add', 'Admin\PageController@create');
    Route::post('/page', 'Admin\PageController@store')->name('admin.page.store');
    Route::get('/page/{page}', 'Admin\PageController@edit')->name('admin.page.edit');
    Route::put('/page/{page}', 'Admin\PageController@update')->name('admin.page.update');
    Route::delete('/page/delete', 'Admin\PageController@destroy')->name('admin.page.delete');

    Route::get('/setting/index', 'Admin\MasterController@index')->name('admin.master.index');
    Route::get('/setting', 'Admin\MasterController@index')->name('admin.setting.index');
    Route::get('/setting/{page}', 'Admin\MasterController@show')->name('admin.master.tech');
    Route::post('/setting', 'Admin\MasterController@store')->name('admin.master.store');
    Route::post('/setting/language', 'Admin\MasterController@storeLanguage')->name('admin.master.store.language');
    Route::delete('/language/delete/{language}', 'Admin\MasterController@deleteLanguage')->name('admin.language.delete');

    Route::get('/project', 'Admin\ProjectController@index')->name('admin.project.index');
    Route::get('/project/add', 'Admin\ProjectController@create')->name('admin.project.add');
    Route::post('/project', 'Admin\ProjectController@store')->name('admin.project.store');
    Route::get('/project/{project}/detail', 'Admin\ProjectController@show')->name('admin.project.show');
    Route::get('/project/{project}/analitic', 'Admin\ProjectController@analytic')->name('admin.project.analytic');
    Route::get('/project/{project}/audit', 'Admin\ProjectController@audit')->name('admin.project.audit');
    Route::get('/project/{project}/edit', 'Admin\ProjectController@edit')->name('admin.project.edit');
    Route::put('/project/{project}', 'Admin\ProjectController@update')->name('admin.project.update');
    Route::get('/project/{project}/update/{status}', 'Admin\ProjectController@status')->name('admin.project.update.status');
    Route::post('/project/restore', 'Admin\ProjectController@restore')->name('admin.project.restore');
    Route::post('/project/changes', 'Admin\ProjectController@change')->name('admin.project.change');
    Route::delete('/project/delete', 'Admin\ProjectController@delete')->name('admin.project.delete');
    Route::delete('/project/{project}', 'Admin\ProjectController@destroy')->name('admin.project.destroy');

    Route::get('/channel', 'Admin\ChannelController@index')->name('admin.channel.index');
    Route::get('/project/add/channel', 'Admin\ChannelController@create')->name('admin.channel.add');
    Route::post('/channel', 'Admin\ChannelController@store')->name('admin.channel.store');
    Route::get('/project/channel/{channel}', 'Admin\ChannelController@show')->name('admin.channel.show');
    Route::get('/channel/{channel}/edit', 'Admin\ChannelController@edit')->name('admin.channel.edit');
    Route::get('/channel/{channel}/analytic', 'Admin\ChannelController@analytic')->name('admin.channel.analytic');
    Route::get('/channel/{channel}/update/{status}', 'Admin\ChannelController@status')->name('admin.channel.update.status');
    Route::put('/channel/{channel}', 'Admin\ChannelController@update')->name('admin.channel.update');
    Route::post('/channel/restore', 'Admin\ChannelController@restore')->name('admin.channel.restore');
    Route::delete('/channel/delete', 'Admin\ChannelController@delete')->name('admin.channel.delete');
    Route::delete('/channel', 'Admin\ChannelController@destroy')->name('admin.channel.destroy');

    Route::get('/audio/index', 'Admin\AudioController@index')->name('admin.audio.index');
    Route::get('/audio', 'Admin\AudioController@index')->name('admin.audioslide.index');
    Route::get('/project/add/audio', 'Admin\AudioController@create');
    Route::post('/audio', 'Admin\AudioController@store')->name('admin.audio.store');
    Route::get('/project/audio/{audio}', 'Admin\AudioController@show')->name('admin.audio.show');
    Route::get('/audio/{audio}/edit', 'Admin\AudioController@edit')->name('admin.audio.edit');
    Route::get('/audio/{audio}/analytic', 'Admin\AudioController@analytic')->name('admin.audio.analytic');
    Route::get('/audio/{audio}/comment', 'Admin\AudioController@comment')->name('admin.audio.comment');
    Route::get('/audio/{audio}/slide', 'Admin\AudioController@slide')->name('admin.audio.slide');
    Route::put('/audio/{audio}', 'Admin\AudioController@update')->name('admin.audio.update');
    Route::get('/audio/{audio}/update/{status}', 'Admin\AudioController@status')->name('admin.audio.update.status');
    Route::post('/audio/restore', 'Admin\AudioController@restore')->name('admin.audio.restore');
    Route::delete('/audio/delete', 'Admin\AudioController@delete')->name('admin.audio.delete');
    Route::delete('/audio', 'Admin\AudioController@destroy')->name('admin.audio.destroy');
    Route::get('/audio/{audio}/set-slide/{status}', 'Admin\AudioController@slideStatus')->name('admin.audio.set.slide.status');

    Route::post('/upload', 'Admin\UploadController@store')->name('admin.upload.store');
    Route::post('/upload/{id}', 'Admin\UploadController@update')->name('admin.upload.update');
    Route::post('/upload/cancel/admin', 'Admin\UploadController@store')->name('admin.upload.cancel');
    Route::get('/attachment/{id}', 'Admin\UploadController@show')->name('admin.upload.finish');

    Route::post('/slide', 'Admin\SlideController@store')->name('admin.slide.get');
    Route::put('/slide/{slide}', 'Admin\SlideController@update')->name('admin.slide.update');
    Route::delete('/slide/{slide}', 'Admin\SlideController@destroy')->name('admin.slide.destroy');
    // Route::get('/slide/{audio}/show', 'Admin\UploadController@show')->name('admin.upload.finish');

    // NEW
    Route::get('/attachment', 'Admin\UploadController@index')->name('admin.attachment.index');
    Route::get('/share', 'Admin\DashboardController@index')->name('admin.share.index');
    // Route::get('/share', 'Admin\DashboardController@index')->name('admin.share.index');
    Route::post('/slide', 'Admin\SlideController@store')->name('admin.slide.get');
    Route::get('/slide/set/draft', 'Admin\SlideController@remove')->name('admin.slide.draft');
    Route::delete('/slide', 'Admin\SlideController@delete')->name('admin.slide.delete');
    Route::post('/slide/restore', 'Admin\SlideController@restore')->name('admin.slide.restore');
    Route::get('/slide/setup', 'Admin\SlideController@setup')->name('admin.slide.setup');
    Route::post('/slide/replace', 'Admin\SlideController@replace')->name('admin.slide.replace');
    Route::post('/duplicate/slide', 'Admin\SlideController@copy')->name('admin.slide.copy');
});

Auth::routes(['verify'=>true]);

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

// use Analytics;
// use Spatie\Analytics\Period;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf ;
use ConvertApi\ConvertApi;
use App\Http\Resources\AudioShowResource;
use App\Notifications\RegisterNotification;
use App\User;
use App\Models\Attachment;


Route::get('/test', function(){
    //$file = 'public/test.jpg';
    //return Storage::get($file);
    $user= User::find(1);
    event(new App\Events\UserWasCreated($user));
    return 'Saved';
});
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'done';
});
Route::get('/queue-restart', function() {
    Artisan::call('queue:restart');
    return 'done';
});
Route::get('/restart-service', function(){
    $user = "mastertop";
    $token = "164SS6FNIMZV63XD5BG1PYPIYJNVG2RG";

    $query = "https://iseetalk.com:2087/json-api/restartservice?api.version=1&service=mysql";
    //$query = "https://iseetalk.com:2087/json-api/listaccts?api.version=1";
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

    $header[0] = "Authorization: whm $user:$token";
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl, CURLOPT_URL, $query);

    $result = curl_exec($curl);

    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_status != 200) {
        echo "[!] Error: " . $http_status . " returned\n";
    } else {
        $json = json_decode($result);
        echo "[+] Current cPanel users on the system:\n";
            echo "\t" . $result . "\n";
    }

    curl_close($curl);
    return 'success';
});



