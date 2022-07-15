<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function staffRole()
    {
        return $this->hasOne(StaffModel::class, 'id_user');
    }
}
