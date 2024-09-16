<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Observers\AttachmentObserver;
use App\Observers\ChannelObserver;
use App\Observers\AudioObserver;
use App\Observers\AuditObserver;
use App\Observers\UserObserver;
use App\Observers\ProjectContentObserver;
use App\Observers\CommentObserver;
use App\Observers\ProjectObserver;
use App\Observers\PageObserver;
use App\Models\Attachment;
use App\Models\Channel;
use App\Models\Audio;
use App\Models\Audit;
use App\Models\ContentProject;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Page;
use App\User;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Channel::observe(ChannelObserver::class);
        Audio::observe(AudioObserver::class);
        User::observe(UserObserver::class);
        Attachment::observe(AttachmentObserver::class);
        Audit::observe(AuditObserver::class);
        ContentProject::observe(ProjectContentObserver::class);
        Comment::observe(CommentObserver::class);
        Project::observe(ProjectObserver::class);
        Page::observe(PageObserver::class);

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
