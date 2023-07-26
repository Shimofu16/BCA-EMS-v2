<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;
    public $guarded = [];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function gradeLevel(){
        return $this->belongsTo(GradeLevel::class,'grade_level_id');
    }
    public function sy(){
        return $this->belongsTo(SchoolYear::class, 'sy_id');
    }
}
