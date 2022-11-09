<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'club_id',
        'no_of_hours',
        'price',
        'currency_id',
        'isBatBooked',
        'batPrice',
        'coach_id',
        'booking_date',
        'order_id',
        'status'
    ];

    public function clubs()
    {
        return $this->belongsTo(Club::class,'club_id', 'id');
    }

    public function slots()
    {
        return $this->belongsTo(TimeSlots::class,'slot_id', 'id');
    }

    public function players()
    {
        return $this->hasMany(Players::class, 'player_id', 'id');
    }

    public function bookingSlots()
    {
        return $this->hasMany(BookingSlots::class, 'booking_id', 'id');
    }
}
