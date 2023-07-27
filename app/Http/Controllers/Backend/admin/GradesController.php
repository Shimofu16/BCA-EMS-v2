<?php

namespace App\Http\Controllers\Backend\admin;

use App\Http\Controllers\Controller;
use App\Models\GradeLevel;
use App\Models\Section;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($level_id = null)
    {
        if ($level_id != null) {
            $sections = Section::with('students', 'teacher', 'gradeLevel')
                ->where('grade_level_id', '=', $level_id)
                ->orderBy('id', 'ASC')
                ->get();
        } else {
            $sections = Section::with('students', 'teacher', 'gradeLevel')
                ->orderBy('id', 'ASC')
                ->get();
        }
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.admin-layouts.grades.index', compact('sections', 'gradeLevels'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::with('students')->find($id);
        $students = $section->students()->where('status', '!=', "dropped")
            ->orderBy('gender', 'DESC')
            ->orderBy('last_name', 'ASC')
            ->get();
        return view('BCA.Backend.admin-layouts.grades.show', compact('section', 'students'));
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
    public function update($id)
    {
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