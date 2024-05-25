<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingEntityObject extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_entity_id',
        'name',
        'type',
        'is_available',
    ];

    public function bookingEntity()
    {
        return $this->belongsTo(BookingEntity::class);
    }
    
}
