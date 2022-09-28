<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bat extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "bats";
    protected $fillable = [
        'name',
        'name_arabic',
        'featured_image',
        'description',
        'description_arabic',
        'status',
        'created_at',
        'updated_at',
    ];
}
