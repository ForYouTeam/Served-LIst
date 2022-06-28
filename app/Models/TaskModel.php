<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;
    protected $table = 'task';

    protected $fillable = [
        'code_task', 'nama_task', 'level_prioritas', 'created_at', 'updated_at'
    ];

    public function prioritasRole()
    {
        return $this->belongsTo(PrioritasModel::class, 'level_prioritas');
    }

    public function tagsRole()
    {
        return $this->hasMany(DetailTagModel::class, 'id_task');
    }
}
