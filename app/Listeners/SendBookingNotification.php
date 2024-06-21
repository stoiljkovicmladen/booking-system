<?php

namespace App\Listeners;

use App\Events\BookingProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendBookingNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingProcessed $event): void
    {
        // TODO: Send email notification
        Log::info('Booking processed / Email notification sent', ['booking_id' => $event->booking->id]);

    }
}
