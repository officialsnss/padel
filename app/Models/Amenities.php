<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'name_arabic',
        'image',
        'created_at',
        'updated_at',
    ];
}
