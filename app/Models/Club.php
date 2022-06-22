<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'service_charge',
        'currency_id',
        'address',
        'region_id',
        'city_id',
        'zipcode',
        'country',
        'status',
        'created_at',
        'updated_at',
    ];
}
