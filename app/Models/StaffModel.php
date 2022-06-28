<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    use HasFactory;
    protected $table = 'staff';

    protected $fillable = [
        'id', 'nama', 'no_regist', 'id_user', 'created_at', 'updated_at'
    ];

    public function userRole()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
