<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrioritasModel extends Model
{
    use HasFactory;
    protected $table = 'prioritas';

    protected $fillable = [
        'nama_prioritas', 'deadline', 'created_at', 'updated_at'
    ];
}
