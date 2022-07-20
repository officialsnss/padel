<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubImages extends Model
{
    use HasFactory;

    protected $table = "club_images";
    public $timestamps = true;
    protected $fillable = [
        'club_id',
        'image',
        'created_at',
        'updated_at',
    ];

}
