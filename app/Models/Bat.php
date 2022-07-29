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
        'featured_image',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];
}
