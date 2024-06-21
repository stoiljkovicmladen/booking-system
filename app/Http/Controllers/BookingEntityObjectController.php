<?php

namespace App\Http\Controllers;

use App\Models\BookingEntityObject;
use Illuminate\Http\Request;

class BookingEntityObjectController extends Controller
{
    // Index Booking Entity Object
    public function index()
    {
        return BookingEntityObject::orderBy('created_at', 'desc')->get();
    }

    // Store Booking Entity Object
    public function store(Request $request)
    {
        $request->validate([
            'booking_entity_id' => 'required',
            'name' => 'required',
            'type' => 'required',
        ]);

        return BookingEntityObject::create($request->all());
    }
}
