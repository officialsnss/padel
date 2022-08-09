<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = "cms_pages";

    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'title',
        'content',
        'slug',
        'status',
        'created_at',
        'updated_at',
    ];
}
