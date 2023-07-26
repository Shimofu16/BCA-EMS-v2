<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    public $guarded = [];
    public function students()
    {
        return $this->hasMany(Student::class, 'sy_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'sy_id');
    }
    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'sy_id');
    }

    public function enrollmentLogs()
    {
        return $this->hasMany(EnrollmentLog::class, 'sy_id');
    }
    public function classes()
    {
        return $this->hasMany(Schedule::class, 'sy_id');
    }
}
