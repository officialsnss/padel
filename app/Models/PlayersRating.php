<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayersRating extends Model
{
    use HasFactory;

    protected $table = 'players_rating';

    protected $fillable = [
        'player_id',
        'rate'
    ];
}
