<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Club;
use App\Booking;

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

    public function Booking()
    {
        return $this->hasMany(Booking::class);
    }
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
