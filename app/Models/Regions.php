<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'name_arabic',
        'country_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
