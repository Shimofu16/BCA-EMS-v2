<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;

    public $guarded = [];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class, 'grade_level_id');
    }
    public function sy()
    {
        return $this->belongsTo(SchoolYear::class, 'sy_id');
    }
    public function balance()
    {
        return $this->hasOne(Balance::class, 'student_id', 'id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }
    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'student_id');
    }
    public function enrollmentLogs()
    {
        return $this->hasMany(EnrollmentLog::class, 'student_id');
    }
    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'student_id', 'id');
    }
    public function getFullName()
    {
        return Str::ucfirst($this->first_name) . ' ' . Str::ucfirst(Str::substr($this->middle_name, 0, 1)) . ' ' . Str::ucfirst($this->last_name);
    }
    public function getClassSchedule($sy)
    {
        return Schedule::with('sy', 'section')
            ->where('sy_id', '=', $sy)
            ->where('section_id', '=', $this->section_id)->get();
    }
}
