<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    
    protected $table = "payments";
    public $timestamps = true;
    protected $fillable = [
        'user_id ',
        'booking_id ',
        'price',
        'payment_method',
        'advance_price',
        'transaction_id',
        'payment_status',
        'coupons_id',
        'total_amount',
        'currency_id',
        'created_at',
        'updated_at'
    ];

}
