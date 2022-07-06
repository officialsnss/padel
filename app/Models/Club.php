<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Court;
use App\Models\Currencies;
use App\Models\ClubRating;

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

    public function court()
    {
        return $this->hasMany(Court::class, 'club_id', 'id');
    }

    public function currencies()
    {
        return $this->hasMany(Currencies::class, 'id', 'currency_id');
    }

    public function club_rating()
    {
        return $this->hasMany(ClubRating::class, 'club_id', 'id');
    }

    public function cities()
    {
        return $this->hasMany(Cities::class, 'id', 'city_id');
    }
}
