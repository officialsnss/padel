<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "coupons";
    protected $fillable = [
        'name',
        'code',
        'no_of_users_used',
        'no_of_times',
        'discount_type',
        'amount',
        'minimum_amount',
        'status',
        'currency_id',
        'created_at',
        'updated_at',
    ];
}
