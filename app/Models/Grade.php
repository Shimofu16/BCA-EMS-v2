<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    public $guarded = [];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id')->withDefault();
    }
    public function class()
    {
        return $this->belongsTo(Schedule::class, 'class_id');
    }
}
