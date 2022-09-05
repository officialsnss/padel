<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedBats extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "bats_booked";
    protected $fillable = [
        'booking_id',
        'bat_id',
        'quantity',
        'created_at',
        'updated_at',
    ];
}
