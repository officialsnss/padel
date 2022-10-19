<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachUnavailability extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "coaches_unavailability";
    protected $fillable = [
        'coach_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'reason',
        'status',
        'created_at',
        'updated_at',
    ];
}
