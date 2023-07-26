<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Teacher extends Model
{
    use HasFactory;

    public $guarded = [];
    public function advisory()
    {
        return $this->hasOne(Section::class, 'teacher_id');
    }
    public function hasAdvisory(){
        if ($this->advisory()->exists()) {
            return true;
        }
        return false;
    }
    public function ClassSchedules()
    {
        return $this->hasMany(Schedule::class, 'teacher_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'teacher_id');
    }
    public function getFullName()
    {
        return Str::ucfirst($this->name);
    }
}
