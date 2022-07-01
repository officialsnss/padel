<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'region_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
