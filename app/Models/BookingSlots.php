<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSlots extends Model
{
    protected $table = "booking_slots";

    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'booking_id',
        'slots',
        'created_at',
        'updated_at',
    ];
}
