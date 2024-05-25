<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\BookingEntityObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bookingData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($bookingData)
    {
        $this->bookingData = $bookingData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Perform booking logic
        $bookingEntityObject = BookingEntityObject::find($this->bookingData['object_id']);

        if ($bookingEntityObject->is_available) {
            $booking = Booking::create([
                'booking_entity_object_id' => $this->bookingData['object_id'],
                'user_id' => $this->bookingData['user_id'],
                'booking_time' => now(),
                'start_time' => $this->bookingData['start_time'],
                'end_time' => $this->bookingData['end_time'],
                'status' => 'confirmed',
            ]);

            // Mark the object as not available
            $bookingEntityObject->is_available = false;
            $bookingEntityObject->save();

            Log::info('Booking processed successfully', ['booking_id' => $booking->id]);
        } else {
            Log::error('Booking failed: Object not available', ['object_id' => $this->bookingData['object_id']]);
        }
    }
}

