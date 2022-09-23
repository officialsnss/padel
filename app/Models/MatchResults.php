<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchResults extends Model
{
    use HasFactory;
    
    protected $table = "match_result";

    protected $fillable = [
        'match_id',
        'team1',
        'team2',
        'team1_score',
        'team2_score',
        'no_of_rounds',
        'winner'
    ];
}
