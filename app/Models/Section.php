<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public $guarded = [];
    public function students()
    {
        return $this->hasMany(Student::class, 'section_id');
    }
    public function classes()
    {
        return $this->hasMany(Schedule::class, 'section_id');
    }
    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'grade_level_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
}
