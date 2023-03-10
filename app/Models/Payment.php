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
        'user_id',
        'booking_id',
        'price',
        'invoice',
        'advance_price',
        'transaction_id',
        'payment_status',
        'coupons_id',
        'pending_amount',
        'discount_price',
        'total_amount',
        'online_amount',
        'wallet_amount',
        'refund_price',
        'currency_id',
        'payment_status',
        'created_at',
        'updated_at'
    ];

}
