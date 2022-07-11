<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;
    protected $table = 'players_details';

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
