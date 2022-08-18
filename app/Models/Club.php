<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Court;
use App\Models\Currencies;
use App\Models\ClubRating;
use App\Models\Cities;
use App\Models\ClubImages;

class Club extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'service_charge',
        'single_price',
        'double_price',
        'indoor_courts',
        'outdoor_courts',
        'currency_id',
        'address',
        'region_id',
        'city_id',
        'zipcode',
        'amenities',
        'country',
        'status',
        'latitude',
        'longitude',
        'ordering',
        'featured_image',
        'commission',
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

    public function images()
    {
        return $this->hasMany(ClubImages::class, 'club_id', 'id');
    }
}
