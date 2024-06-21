<?php

namespace App\Jobs;

use App\Events\BookingProcessed;
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
        Log::info('Processing booking', $this->bookingData);

        $bookingEntityObject = BookingEntityObject::find($this->bookingData['object_id']);

        if (! $bookingEntityObject) {
            Log::error('Booking entity object not found', ['object_id' => $this->bookingData['object_id']]);
        }

        try {
            $booking = Booking::create([
                'booking_entity_object_id' => $this->bookingData['object_id'],
                'booking_entity_id' => $bookingEntityObject->bookingEntity->id,
                'user_id' => $this->bookingData['user_id'],
                'booking_date' => now(),
                'start_time' => $this->bookingData['start_time'],
                'end_time' => $this->bookingData['end_time'],
                'status' => 'confirmed',
            ]);
    
            // TODO: Payment processing
    
            // Dispatch the event after processing the booking
            event(new BookingProcessed($booking));
    
            Log::info('Booking processed successfully', ['booking_id' => $booking->id]);
        } catch (\Exception $e) {
            Log::error('Error processing booking', ['message' => $e->getMessage()]);
        }
        

    }
}
