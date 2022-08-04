<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'booking_id',
        'currency_id',
        'amount',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $table = "wallets";
}
