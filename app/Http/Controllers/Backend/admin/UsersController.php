<?php

namespace App\Http\Controllers\Backend\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = null)
    {
        if ($type == 'student') {
            $users = User::with('student')
                ->where('student_id', '!=', null)
                ->get()
                ->sortBy('student.last_name');
        }
        if ($type == 'faculty') {
            $users = User::with('first', 'second', 'teacher')
                ->where('teacher_id', '!=', null)
                ->get()
                ->sortBy('first.role');
        }
        $title = Str::ucfirst($type) . ' Accounts';
        return view('BCA.Backend.admin-layouts.manage.users.index', compact('users', 'title','type'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::find($id);
        return view('BCA.Backend.admin-layouts.manage.users.show', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$type)
    {
        $user = User::find($id);
        return view('BCA.Backend.admin-layouts.manage.users.show', compact('user','type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function forceLogout($id)
    {
        try {
            $user = User::find($id);
            $user->update([
                'status' => 'offline'
            ]);
            $log = $user->logs()->latest()->first();
            $log->update([
                'time_out' => now(),
                'updated_at' => now(),
                'updated_by' => Auth::user()->getFullName()
            ]);
            return redirect()->back()->with('successToast', 'User has been logged out!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
