<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    protected $table = "home_slider";

    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'image',
        'heading',
        'button_label',
        'button_url',
        'created_at',
        'updated_at',
    ];
}
