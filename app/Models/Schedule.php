<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $guarded = [];
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->withDefault();
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id')->withDefault();
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id')->withDefault();
    }
    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'grade_level_id')->withDefault();
    }
    public function sy()
    {
        return $this->belongsTo(SchoolYear::class, 'sy_id')->withDefault();
    }
    public function grades()
    {
        return $this->hasMany(Grade::class, "class_id");
    }
    public function days()
    {
        return $this->hasMany(ClassDay::class, 'class_id');
    }

}
