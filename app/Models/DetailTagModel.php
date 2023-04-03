<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTagModel extends Model
{
    use HasFactory;
    protected $table = 'detail_tag';

    protected $fillable = [
        'id', 'id_task', 'id_tag', 'created_at', 'updated_at'
    ];

    public function tagRole()
    {
        return $this->belongsTo(TagModel::class, 'id_tag');
    }
}
