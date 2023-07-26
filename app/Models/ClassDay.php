<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassDay extends Model
{
    use HasFactory;
    protected $table = "class_days";
    public $guarded = [];
    public function class()
    {
        return $this->belongsTo(Schedule::class, 'class_id');
    }
}
