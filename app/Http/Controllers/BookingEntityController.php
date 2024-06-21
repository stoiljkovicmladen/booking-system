<?php

namespace App\Http\Controllers;

use App\Models\BookingEntity;
use Illuminate\Http\Request;

class BookingEntityController extends Controller
{
    // Get All Booking Entities
    public function index()
    {
        return BookingEntity::orderBy('created_at', 'desc')->get();
    }

    // Store Booking Entity
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        return BookingEntity::create($request->all());
    }
}
