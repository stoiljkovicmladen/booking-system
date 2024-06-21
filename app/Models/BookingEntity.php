<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingEntity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'address',
        'phone',
        'email',
    ];

    public function objects()
    {
        return $this->hasMany(BookingEntityObject::class);
    }
}
