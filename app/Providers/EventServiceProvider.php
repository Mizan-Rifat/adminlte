<?php

namespace App\Providers;

use App\Events\ProductUpdated;
use App\Listeners\ProductUpdatedListener;
use App\Events\ProductDeleted;
use App\Listeners\ProductDeletedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        ProductUpdated::class => [
            ProductUpdatedListener::class
        ],
        ProductDeleted::class => [
            ProductDeletedListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
