<?php

namespace App\Http\Controllers\General;


use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Grade;
use App\Models\Requirement;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    public static function forms($title, $copies = [], $pm, $st, $gt, $student = [], $guardian = [], $name)
    {
        try {
            $sy = SchoolYear::where('is_active', '=', 1)->first();
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('BCA.Exports.form.index', compact('copies', 'title', 'pm', 'st', 'gt', 'sy', 'student', 'guardian'));
            $pdf->setPaper(
                'a4',
                'portrait'
            );

            $path = 'uploads/requirements/' . $name;
            $filePath = $path . '/' . $title . '-form-' . $sy->name . '.pdf';

            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            $path = storage_path() . '/' . 'app/' . $filePath;
            Requirement::create([
                'student_id' => $student['id'],
                'filepath' =>  $filePath,
                'isSubmitted' => 1,
            ]);

            // return $pdf->download($title . '_form_' . $sy->name . '.pdf');
            return $pdf->save($path)->download($title . '-form-' . $sy->name . '.pdf');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public static function classList($section_id)
    {
        try {
            $section = Section::find($section_id);
            $sy = SchoolYear::where('is_active', '=', 1)->first();
            $students =  $section->students()
                ->where('status', '=', 'enrolled')
                ->orderBy('gender', 'DESC')
                ->orderBy('last_name', 'ASC')
                ->get();
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('BCA.Exports.class_list.index', compact('students', 'sy'));
            return $pdf->download('class_list_' . $section->name . '_' . $section->gradeLevel->name . '.pdf');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public static function officialClassList()
    {
        try {
            $students = Student::where('status', '=', 'enrolled')
                ->orderBy('gender', 'DESC')
                ->orderBy('last_name', 'ASC')
                ->get();
            $sy = SchoolYear::where('is_active', '=', 1)->first();
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('BCA.Exports.official_class_list.index', compact('students', 'sy'));
            return $pdf->download('official_class_list.pdf');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public static function grade($id, $sy_id, $isStudent)
    {
        $isStudent = ($isStudent == 1) ? true : false;
        $student = Student::with('grades')->find($id);
        $grades = Grade::with('class')
            ->where('student_id', '=', $id)
            ->whereHas('class', function ($query) use ($sy_id) {
                $query->where('sy_id', '=', $sy_id);
            })
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('a3', 'portrait');
        $pdf->loadView('BCA.Exports.grades.index', compact('student', 'grades', 'isStudent'));
        return $pdf->download('Grade-' . $student->last_name . '-' . \Illuminate\Support\Str::substr($student->first_name, 0, 1) . '.pdf');
    }
    public static function classSchedule($id, $isStudent)
    {
        $isStudent = ($isStudent == 1) ? true : false;
        $name = '';
        $sy = SchoolYear::where('is_active', '=', 1)->first();
        if ($isStudent) {
            $student = Student::find($id);
            $schedules  = Schedule::with('sy', 'section')
                ->where('sy_id', '=', $sy->id)
                ->where('section_id', '=', $student->section_id)
                ->get();
            $name = $student->getFullName();
            $section = Section::find($student->section_id);
        } else {
            $schedules = Schedule::with('teacher')
                ->where('teacher_id', '=', $id)
                ->get();
            $user = Teacher::find($id);
            $name = $user->name;
            $section = Section::with('teacher')->where('teacher_id', '=', $id)->first();
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('BCA.Exports.class_schedule.index', compact('schedules', 'sy', 'section', 'isStudent'));
        return $pdf->download('Class-Schedule-' . $name . '.pdf');
    }
}
