<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class ContactUs extends Model
{
    use HasFactory;
    
    protected $table = "contact_us";
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'sender_id',
        'receiver_id', 
        'message'
    ];
    
    public function userData()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
    
}
