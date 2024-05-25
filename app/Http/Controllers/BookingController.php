<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessBooking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        $request->validate([
            'object_id' => 'required|exists:booking_entity_objects,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $bookingData = [
            'object_id' => $request->object_id,
            'user_id' => $request->user()->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ];

        ProcessBooking::dispatch($bookingData);

        return response()->json(['message' => 'Booking is being processed.']);
    }
    
}
