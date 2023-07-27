<?php

namespace App\Http\Controllers\Backend\registrar;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ClassDay;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GradeLevel;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentSy = session()->get(Auth::id() . '_current_sy');
        $classes = Schedule::with('subject', 'section', 'gradeLevel', 'teacher')
            ->where('sy_id', '=', $currentSy)
            ->get()
            ->sortBy('gradeLevel.id')
            ->sortBy('senction.name');
        $gradeLevels = GradeLevel::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('BCA.Backend.registrar-layouts.classes.index', compact('gradeLevels', 'classes', 'sections', 'teachers', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $subject = Subject::find($request->input('subject_id'));
            $class_code = Str::ucfirst(Str::substr($subject->subject, 0, 1)) . '' . $subject->grade_level_id . ' - 01 ';
            $class_id =   Schedule::create([
                'class_code' => $class_code,
                'grade_level_id' => $subject->grade_level_id,
                'section_id' => $request->input('section_id'),
                'subject_id' => $request->input('subject_id'),
                'teacher_id' => $request->input('teacher_id'),
                'day' => $request->input('day'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ])->id;
            $section = Section::with('students')
                ->where('id', '=', $request->input('section_id'))
                ->first();
            if (!empty($section->students)) {
                /* create grades for the enrolled students but does`t have data in grades table  */
                foreach ($section->students as $student) {
                    Grade::create([
                        'class_id' => $class_id,
                        'student_id' =>  $student->id,
                    ]);
                }
            }

            toast()->success('SYSTEM MESSAGE', 'Class ' . $request->input('class') . ' created successfully..')->autoClose(6000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        try {
            $class = Schedule::findOrFail($id);
            $class->day = $request->input('day');
            $class->start_time = $request->input('start_time');
            $class->end_time = $request->input('end_time');
            $class->update();
            if ($class->wasChanged()) {
                toast()->success('SYSTEM MESSAGE', $request->input('class') . ' updated successfully.')->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //to delete class schedule, first you need to delete the days related to class schedules
        try {
            $class = Schedule::findOrFail($id);
            if (empty($class->section->students->first())) {
                $days = ClassDay::with('class')->where('class_id', '=', $id)->delete();
                toast()->success('SYSTEM MESSAGE', 'Class ' . $class->class_code . ' was Successfully Deleted.')->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                $class->delete();
                return back();
            } else {
                toast()->info('SYSTEM MESSAGE', 'Class ' . $class->class_code . ' was unable to delete because, it has Students.')->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }
}