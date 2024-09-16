<?php

namespace App\Observers;

use App\Models\Page;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     *
     * @param  \App\Page  $page
     * @return void
     */
    public function created(Page $page)
    {
        //
    }

    /**
     * Handle the Page "updated" event.
     *
     * @param  \App\Page  $page
     * @return void
     */
    public function updated(Page $page)
    {
        //
    }

    /**
     * Handle the Page "deleted" event.
     *
     * @param  \App\Page  $page
     * @return void
     */
    public function deleted(Page $page)
    {
        //  DELETE ALL NOTIFICATION
        if($page->notification->count() > 0 ){
            $page->notification->user_notification()->delete();
            $page->notification()->delete();
        }
    }

    /**
     * Handle the Page "restored" event.
     *
     * @param  \App\Page  $page
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }

    /**
     * Handle the Page "force deleted" event.
     *
     * @param  \App\Page  $page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }
}
