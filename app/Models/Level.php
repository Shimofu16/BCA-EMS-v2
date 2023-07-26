<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function annuals()
    {
        return $this->hasMany(Annual::class, 'level_id', 'id');
    }
}
