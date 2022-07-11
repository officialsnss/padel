<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TimeSolts;
use App\Models\Club;

class Matches extends Model
{
    use HasFactory;

    protected $table = "matches";

    public function slots()
    {
        return $this->hasMany(TimeSlots::class, 'id', 'slot_id');
    }

    public function clubs()
    {
        return $this->hasMany(Club::class, 'id', 'club_id');
    }
}
