<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlots extends Model
{
    use HasFactory;
    
    protected $table = "time_slots";

    protected $fillable = [
        'club_id',
        'start_time',
        'end_time',
        'status',
        'created_at',
        'updated_at',
    ];
}
