<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile', 'path', 'email', 'password', 'status', 'first_role_id', 'second_role_id', 'teacher_id', 'student_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function first()
    {
        return $this->belongsTo(Role::class, 'first_role_id', 'id');
    }
    public function second()
    {
        return $this->belongsTo(Role::class, 'second_role_id', 'id')->withDefault();
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function logs()
    {
        return $this->hasMany(ActivityLog::class, 'user_id');
    }
    public function hasRole($role)
    {
        if (Str::lower($this->first->name) == $role || Str::lower($this->second->name) == $role) {
            return true;
        }
        return false;
    }
    function isFirstRole($role)
    {
        return Str::lower($this->first->name) === Str::lower($role);
    }
    function isSecondRole($role)
    {
        if ($this->second->name != null && Str::lower($this->second->name) === Str::lower($role)) {
            return true;
        }
        return false;
    }
    public function getFullName()
    {
        if ($this->teacher_id != null) {
            return $this->teacher->name;
        } else if ($this->student_id != null) {
            return $this->student->getFullName();
        }
        return $this->name;

    }
    public function getGender()
    {
        if ($this->teacher_id != null) {
            return $this->teacher->gender;
        } else if ($this->student_id != null) {
            return $this->student->gender;
        }
        return $this->gender;
    }
    public function isActive()
    {
        if ($this->status == "online") {
            return true;
        }
        return false;
    }
    public function getRole()
    {
        if ($this->hasRole('administrator')) {
            return 'admin';
        }    
        return Str::lower($this->first->name);
    }
}
