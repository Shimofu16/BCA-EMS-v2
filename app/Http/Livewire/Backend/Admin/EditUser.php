<?php

namespace App\Http\Livewire\Backend\Admin;

use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $user;
    public $roles, $teachers;
    public $first_role, $second_role;
    public bool $hasFirstRole = false;
    public $name, $email, $gender, $teacher_id;

    protected $messages = [
        'email.email' => 'The Email Address format is not valid.',
        'email.unique' => 'The Email Address has already been taken',
        'password.max' => 'The Password must be at most 15 characters.',
        'password_confirmation.max' => 'The Password Confirmation must be at most 15 characters.',
        'password_confirmation.same' => 'The Password Confirmation does not match.',
        'teacher_id.required' => 'The Teacher field is required.',
    ];

    protected $validationAttributes = [
        'name' => 'name',
        'email' => 'email address',
        'gender' => 'gender',
        'password_confirmation' => 'password confirmation',
        'first_role' => 'first role',
        'second_role' => 'second role',
        'teacher_id' => 'teacher'

    ];

    public function updatedFirstRole($value)
    {
        if ($value != null) {
            $this->first_role = $value;
            $this->hasFirstRole = true;
            $this->resetExcept('first_role', 'hasFirstRole', 'roles', 'teachers');
        }
    }
    public function updatedSecondRole($value)
    {
        if ($value != null) {
            $this->second_role = $value;
        }
    }
    public function edit()
    {
        $this->resetErrorBag();
        if ($this->first_role == 4 || $this->second_role == 4) {
            $this->validate([
                'teacher_id' => 'required',
            ]);
            $teacher = Teacher::find($this->teacher_id);
            User::find($this->user->id)->update([
                'name' => $teacher->name,
                'email' => $teacher->email,
                'gender' => $teacher->gender,
                'first_role_id' => $this->first_role,
                'second_role_id' => ($this->second_role != null) ? $this->second_role : null,
                'teacher_id' => $this->teacher_id,
            ]);
        } else {
            $this->validate([
                'name' => 'required',
                'email' => 'email',
                'gender' => 'required',
            ]);
            User::find($this->user->id)->update([
                'name' => $this->name,
                'email' => $this->email,
                'gender' => $this->gender,
                'first_role_id' => $this->first_role,
                'second_role_id' => ($this->second_role != null) ? $this->second_role : null,
            ]);
        }
        return redirect(request()->header('Referer'))->with('successToast', 'User`s data updated successfully');
        $this->reset();
    }
    public function mount()
    {
        $this->roles = Role::all();
        $this->teachers = Teacher::with('user')->whereDoesntHave('user')->get();
        $this->first_role = $this->user->first_role_id;
        $this->second_role = $this->user->second_role_id;
        $this->name = $this->user->getFullName();
        $this->email = $this->user->email;
        $this->gender = $this->user->getGender();
        $this->teacher_id = $this->user->teacher_id;
        if ($this->first_role != null) {
            $this->hasFirstRole = true;
        }
    }
    public function render()
    {
        return view('livewire.backend.admin.edit-user');
    }
}
