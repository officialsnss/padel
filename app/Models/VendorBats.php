<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBats extends Model
{
    use HasFactory;

    protected $table = "vendor_bats";

    public function bats()
    {
        return $this->hasMany(Bat::class, 'id', 'bat_id');
    }

    public function club()
    {
        return $this->hasMany(Club::class, 'id', 'club_id');
    }

    public function currencies()
    {
        return $this->hasMany(Currencies::class, 'id', 'currency_id');
    }
}
