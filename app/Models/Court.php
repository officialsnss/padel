<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourtRating;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'club_id',
        'court_type',
        'court_number',
        'game_type',
        'single_price',
        'double_price',
        'currency_id',
        'featured_image',
        'status',
        'created_at',
        'updated_at'
    ];

    public function court_rating()
    {
        return $this->hasMany(CourtRating::class, 'court_id', 'id');
    }

    public function club()
    {
        return $this->hasMany(Club::class, 'id', 'club_id');
    }
}
