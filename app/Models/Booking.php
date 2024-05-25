<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_entity_object_id',
        'user_id',
        'booking_time',
        'start_time',
        'end_time',
        'status',
    ];

    public function bookingEntityObject()
    {
        return $this->belongsTo(BookingEntityObject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
