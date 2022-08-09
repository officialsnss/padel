<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;
    protected $table = 'players_details';

    protected $fillable = [
        'user_id',
        'ordering'
    ];
    
    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function matches()
    {
        return $this->hasMany(Matches::class, 'player_id', 'id');
    }
}
