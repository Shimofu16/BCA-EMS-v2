<?php

namespace App\Http\Controllers\Backend\registrar;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($isStudent)
    {
        if ($isStudent == 1) {
            $students = Student::where('status', '=','dropped')->get();
            return view('BCA.Backend.registrar-layouts.archive.show', compact('students', 'isStudent'));
        } else {
            $teachers = Teacher::where('isResigned', 1)->get();
            return view('BCA.Backend.registrar-layouts.archive.show', compact('teachers', 'isStudent'));
        }
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $isStudent)
    {
        if ($isStudent == 1) {
            $student = Student::find($id);
            $student->update(['status' => 'enrolled']);
            $name = $student->getFullName();
        } else {
            $teacher = Teacher::find($id);
            $teacher->isResigned = 0;
            $teacher->save();
            $name = $teacher->name;
        }
        return redirect()->route('registrar.archive.show', $isStudent)->with('successToast','Successfully restored '.$name.'!');
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
