<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "coaches_details";
    protected $fillable = [
        'user_id',
        'description',
        'arabic_description',
        'experience',
        'price',
        'currency_id',
        'clubs_assigned',
        'status',
        'created_at',
        'updated_at',
    ];
}
