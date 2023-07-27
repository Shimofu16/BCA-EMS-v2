<?php

namespace App\Http\Controllers\Backend\registrar;

use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GradeLevel;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($level_id = null)
    {
        if ($level_id != null) {
            $sections = Section::with('students', 'gradeLevel')
                ->where('grade_level_id', '=', $level_id)
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $sections = Section::with('students', 'gradeLevel')
                ->orderBy('id', 'asc')
                ->get();
        }
        $teachers = Teacher::all();
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.registrar-layouts.section.index', compact('sections',  'teachers', 'gradeLevels'));
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
        $request->validate([
            'section_name' => 'required',
            'grade_level_id' => 'required',
            'teacher_id' => 'required',
        ]);
        try {
            $hasSection = $this->checkSection($request->input('section_name'));
            if ($hasSection) {
                return redirect()->back()->with('errorAlert', Str::ucfirst($request->input('section_name')) . ' is already at the other table.');
            }
            Section::create([
                'section_name' => $request->input('section_name'),
                'teacher_id' => ($request->input('teacher_id') == '-- Select Adviser --') ? null :  $request->input('teacher_id'),
                'grade_level_id' => ($request->input('grade_level_id') == '-- Select Grade Level --') ? null :  $request->input('grade_level_id'),
            ]);
            return redirect()->back()->with('successToast', 'Section ' . Str::ucfirst($request->section_name) . ' created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::with('section')->where('section_id', '=', $id)
            ->where('status', '!=', 'dropped')
            ->orderBy('gender', 'DESC')
            ->orderBy('last_name', 'ASC')
            ->get();
        $title = Section::find($id);
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.registrar-layouts.section.show', compact('students', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->section_name = $request->input('section_name');
            $section->teacher_id = ($request->input('teacher_id') == 'delete') ? null :  $request->input('teacher_id');
            $section->updated_by = Auth::user()->getFullName();
            $section->updated_at = now();
            $hasSection = $this->checkSection($request->input('section_name'));
            if ($section->isDirty('section_name')) {
                if ($hasSection) {
                    return redirect()->back()->with('errorAlert', Str::ucfirst($request->input('section_name')) . ' is already at the other table.');
                }
            }
            $section->update();
            return redirect()->back()->with('successToast', 'Section updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }

    private function checkSection($section)
    {
        $sections = Section::all();
        foreach ($sections as $item) {
            if (Str::lower($item->section_name) == Str::lower($section)) {
                return true;
                break;
            }
        }
        return false;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        if ($section->students->where('isDropped', '=', 0)->count() == null) {
            $secName = $section->section_name;
            $section->delete();
            toast()->success('SYSTEM MESSAGE', Str::ucfirst($secName) . ' was Successfully Deleted.')->autoClose(6000)->width('400px')->padding('10px')->background('#f8f9fc')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect()->back();
        }
        toast()->error('SYSTEM MESSAGE' . 'Section ' . $section->section_name . ' can\'t be deleted. ')->autoClose(6000)->width('400px')->padding('10px')->background('#f8f9fc')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
        return redirect()->back();
    }
}
