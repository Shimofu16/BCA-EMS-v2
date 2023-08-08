<?php

namespace App\Http\Controllers\Backend\teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::where('status', '=', 'enrolled')->get();
        return view('BCA.Backend.teacher-layouts.grades.index', compact('students'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $students = Grade::with('student', 'class')
                ->whereHas('student', function ($query) {
                    $query->where('status', '=', 'enrolled');
                })
                ->where('class_id', '=', $id)
                ->get()
                ->sortBy('student.last_name');
            $section = Schedule::find($id)->section->section_name;
            if ($students->isEmpty()) {
                alert()->info('SYSTEM MESSAGE', 'There are no students to grade.')->autoClose(6000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
                return redirect()->back();
            }
            return view('BCA.Backend.teacher-layouts.grades.show', compact('students', 'section'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
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
