<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSlots extends Model
{
    use HasFactory;

    protected $table = "booking_slots";
    public $timestamps = true;
    protected $fillable = [
        'booking_id',
        'slots',
        'status',
        'created_at',
        'updated_at',
    ];
}
