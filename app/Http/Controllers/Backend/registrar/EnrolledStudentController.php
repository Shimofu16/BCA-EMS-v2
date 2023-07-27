<?php

namespace App\Http\Controllers\Backend\registrar;

use Carbon\Carbon;
use App\Models\Section;
use App\Models\Student;
use App\Models\GradeLevel;
use Illuminate\Support\Str;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EnrolledStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($level_id = null, $section_id = null)
    {
        if ($level_id != null) {
            $students = Student::with('section', 'gradeLevel')
                ->where('status', '=', 'enrolled')
                ->where('hasVerifiedEmail', '=', 1)
                ->where('enrollmentCompleted', '=', 1)
                ->where('grade_level_id', '=', $level_id)
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $students = Student::with('section', 'gradeLevel')
                ->where('status', '=', 'enrolled')
                ->where('hasVerifiedEmail', '=', 1)
                ->where('enrollmentCompleted', '=', 1)
                ->orderBy('id', 'asc')
                ->get();
        }
        $gradeLevels = GradeLevel::all();
        $sections = Section::all();
        return view('BCA.Backend.registrar-layouts.students.enrolled.index', compact('students', 'gradeLevels', 'sections'));
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
    private function checkIfRequirementExists($studentId,  $filename,  $hasFile)
    {
        $student = Student::find($studentId);
        $name = Str::ucfirst($student->first_name) . ' ' . Str::ucfirst(Str::substr($student->middle_name, 0, 1)) . ' ' . Str::ucfirst($student->last_name);
        $path = 'uploads/requirements/' . $name;
        $fileTypes = [
            'jpg',
            'pdf',
            'jpeg',
            'png',
        ];
        try {
            $requirement = Requirement::where('student_id', '=', $studentId)
                ->where('isSubmitted', 1)
                ->firstOrFail();
            if (!file_exists(storage_path('app/' . $requirement->filepath))) {
                Requirement::where('student_id', '=', $studentId)
                    ->where('isSubmitted', 1)
                    ->delete();
                $hasFile = false;
            } else {
                $hasFile = true;
            }
            return $hasFile;
        } catch (ModelNotFoundException $e) {
            $filePath = storage_path() . '/app/uploads/requirements/' . $name . '/' . $filename . '.';
            foreach ($fileTypes as $fileType) {
                $filePath = $filePath . $fileType;
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                if ($extension !== null) {
                    if (file_exists($filePath)) {
                        Requirement::create([
                            'student_id' => $student->id,
                            'filepath' => $path . '/' . $filename . '.' . $fileType,
                            'isSubmitted' => 1,
                        ]);
                        $requirement = Requirement::where('student_id', '=', $student->id)
                            ->where('isSubmitted', 1)
                            ->firstOrFail();
                        $hasFile = true;
                        break;
                    }
                    $hasFile = false;
                    break;
                }
            }
            return $hasFile;
        }
    }
    private function getRequirement($studentId, $filename)
    {
        return Requirement::with('student')
            ->where('student_id', '=', $studentId)
            ->first();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $name = Str::ucfirst($student->first_name) . ' ' . Str::ucfirst(Str::substr($student->middle_name, 0, 1)) . ' ' . Str::ucfirst($student->last_name);
        $path = 'uploads/requirements/' . $name;

        $hasFilePhoto = false;
        $hasFilePhoto = $this->checkIfRequirementExists($student->id, 'photo', $hasFilePhoto);
        $studentPhoto = $this->getRequirement($id, 'photo');

        $hasFilePsa = false;
        $hasFilePsa = $this->checkIfRequirementExists($student->id, 'psa', $hasFilePsa);
        $psaFile = $this->getRequirement($id, 'psa');

        $hasFileForm138 = false;
        $hasFileForm138 =  $this->checkIfRequirementExists($student->id, 'form 138', $hasFileForm138);
        $form138File = $this->getRequirement($id, 'form 138');

        $hasFileGoodMoral = false;
        $hasFileGoodMoral =  $this->checkIfRequirementExists($student->id, 'good moral', $hasFileGoodMoral);
        $goodMoral = $this->getRequirement($id, 'good moral');

        $father = FamilyMember::where('student_id', '=', $student->id)->where('relationship_type', 'father')->first();
        $mother = FamilyMember::where('student_id', '=', $student->id)->where('relationship_type', 'mother')->first();
        $guardian = FamilyMember::where('student_id', '=', $student->id)->where('relationship_type', 'guardian')->first();
        $sections = Section::all();
        $gradeLevels = GradeLevel::all();

        return view(
            'BCA.Backend.registrar-layouts.students.enrollees.show',
            compact(
                'sections',
                'gradeLevels',
                'student',
                'father',
                'mother',
                'guardian',
                'studentPhoto',
                'goodMoral',
                'form138File',
                'psaFile',
                'hasFilePsa',
                'hasFileForm138',
                'hasFileGoodMoral',
                'hasFilePhoto'
            )
        );
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
            $student = Student::findOrFail($id);
            $age = Carbon::parse($request->input('birth_date'))->diff(Carbon::now());
            $student->student_lrn = $request->input('student_lrn');
            $student->first_name = $request->input('first_name');
            $student->middle_name = $request->input('middle_name');
            $student->last_name = $request->input('last_name');
            $student->gender = $request->input('gender');
            $student->age = $age->y;
            $student->email = $request->input('email');
            $student->birth_date = $request->input('birth_date');
            $student->birthplace = $request->input('birthplace');
            $student->address = $request->input('address');
            $student->section_id = $request->input('section_id');
            $student->grade_level_id = $request->input('grade_level_id');
            if ($student->isDirty()) {
                $student->update();
                toast()->success('SYSTEM MESSAGE', 'updated successfully.')->autoClose(6000)->width('400px')->padding('10px')->background('#f8f9fc')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                return redirect()->back();
            }
            toast()->info('SYSTEM MESSAGE', ' Nothing changed')->autoClose(6000)->width('400px')->padding('10px')->background('#f8f9fc')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect()->back();
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
        try {
            $student = Student::findOrFail($id);
            $student->status ="dropped";
            $student->update();
            $name = $student->first_name;
            toast()->success('SYSTEM MESSAGE', $name . '`s information has been archived.')->autoClose(6000)->width('400px')->padding('10px')->background('#f8f9fc')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect()->route('registrar.enrolled.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }
}
