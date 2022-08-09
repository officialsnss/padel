<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permissions;

class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name', 'permissions'
    ];
    // public function Permissions()
    // {
    //     return $this->belongsToMany(Permissions::class, 'ROLE_PERMISSIONS', 'role_id', 'permission_id');
    // }
}
