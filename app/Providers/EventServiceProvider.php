<?php

namespace App\Providers;

use App\Events\BookingProcessed;
use App\Listeners\SendBookingNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BookingProcessed::class => [
            SendBookingNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
