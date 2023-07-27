<?php

namespace App\Http\Livewire\Backend\Admin;

use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddUser extends Component
{
    public $roles, $teachers;
    public $first_role, $second_role;
    public bool $hasFirstRole = false;
    public $name, $email, $gender, $password, $password_confirmation, $teacher_id;
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
    public function add()
    {
        $this->resetErrorBag();

        $rules = [
            'first_role' => 'required',
            'password' => 'required|max:15',
            'password_confirmation' => 'required|max:15|same:password',
        ];

        if ($this->first_role == 4 || $this->second_role == 4) {
            $rules['teacher_id'] = 'required';
            $teacher = Teacher::find($this->teacher_id);
            $data = [
                'email' => $teacher->email,
                'first_role_id' => $this->first_role,
                'second_role_id' => $this->second_role ?? null,
                'teacher_id' => $teacher->id,
            ];
        } else {
            $rules['name'] = 'required';
            $rules['email'] = 'email|unique:users,email';
            $rules['gender'] = 'required';
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'gender' => $this->gender,
                'first_role_id' => $this->first_role,
                'second_role_id' => $this->second_role ?? null,
            ];
        }

        $this->validate($rules);

        $data['password'] = Hash::make($this->password);
        User::create($data);

        return redirect(request()->header('Referer'))->with('successToast', 'User created successfully');
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->teachers = Teacher::with('user')->whereDoesntHave('user')->get();
    }
    public function render()
    {
        return view('livewire.backend.admin.add-user');
    }
}
