<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Resources\AudioCollection;
use App\Http\Resources\ChannelCollection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        AudioCollection::withoutWrapping();
        ChannelCollection::withoutWrapping();
    }
}
