<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = true;


    protected $attributes = [
        'bat_id' => '0',
        'slot_id' => '0',
    ];

    public function court()
    {
        return $this->belongsTo(Court::class,'court_id', 'id');
    }

    public function slots()
    {
        return $this->belongsTo(TimeSlots::class,'slot_id', 'id');
    }

    public function players()
    {
        return $this->hasMany(Players::class, 'player_id', 'id');
    }
}
