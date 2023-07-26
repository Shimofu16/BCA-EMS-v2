<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $guarded = [];
    /* relationship of subjects and teacher*/
    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'grade_level_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_subjects');
    }
    public function grades()
    {
        return $this->belongsTo(Grade::class,'subject_id');
    }
    public function classes()
    {
        return $this->hasMany(Schedule::class, 'subject_id');
    }
}
