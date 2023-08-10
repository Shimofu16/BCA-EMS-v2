<?php

namespace App\Http\Controllers\Backend\registrar;

use App\Models\Section;
use App\Models\GradeLevel;
use Illuminate\Support\Str;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General\MailController;
use App\Models\EnrollmentLog;
use App\Models\Grade;
use App\Models\Requirement;
use App\Models\Schedule;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EnrolleeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($level_id = null)
    {
        if ($level_id != null) {
            $students = Student::with('section', 'gradeLevel')
                ->where('status', '=', 'enrollee')
                ->where('hasVerifiedEmail', '=', 1)
                ->where('enrollmentCompleted', '=', 1)
                ->where('grade_level_id', '=', $level_id)
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $students = Student::with('section', 'gradeLevel')
                ->where('status', '=', 'enrollee')
                ->where('hasVerifiedEmail', '=', 1)
                ->where('enrollmentCompleted', '=', 1)
                ->orderBy('id', 'asc')
                ->get();
        }
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.registrar-layouts.students.enrollees.index', compact('students', 'gradeLevels'));
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
    private function updateStudent($id, $section_id)
    {
        Student::where('id', $id)->update([
            'section_id' => $section_id,
            'status' => 'enrolled',
            'updated_by' => Auth::user()->getFullName()
        ]);
    }
    private function createStudentAccount($student, $password)
    {

        User::create([
            'student_id' => $student->id,
            'email' => $student->email,
            'password' => Hash::make($password),
            'first_role_id' => 5
        ]);
    }
    private function createStudentGrades($enrollee, $id)
    {
        $currentSy = SchoolYear::where('is_active', '=', 1)->first();
        $classes = Schedule::with('section', 'sy')
            ->where('sy_id', '=', $currentSy->id)
            ->where('section_id', '=', $id)->get();

        foreach ($classes as $key => $class) {
            Grade::with('class')
                ->where('class_id', '=', $class->id)
                ->where('student_id', '=', $enrollee->id)
                ->firstOrCreate([
                    'class_id' => $class->id,
                    'student_id' => $enrollee->id
                ]);
        }
    }
    private function sendEmail($enrollee, $password, $isOld)
    {
        MailController::sendAcceptedMail($enrollee->first_name, $enrollee->student_id, $enrollee->email, $password, $isOld);
    }

    private function enrollmentLog($student_id, $sy_id, $grade_level_id, $section_id)
    {
        $log = EnrollmentLog::with('student', 'section', 'gradeLevel')
            ->where('student_id', '=', $student_id)
            ->where('sy_id', '=', $sy_id)
            ->where('grade_level_id', '=', $grade_level_id)
            ->first()
            ->update([
                'section_id' => $section_id,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $id)
    {
        if ($request->input('section_id') == null) {
            alert()->info('SYSTEM MESSAGE', 'Section is required')->autoClose(6000)->width('500px')->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return back();
        }
        $enrollee = Student::find($id);
        $hasFilePsa = $this->checkIfRequirementExists($enrollee->id, 'psa', false);
        $hasFileForm138 = $this->checkIfRequirementExists($enrollee->id, 'form 138', false);
        $hasFileGoodMoral = $this->checkIfRequirementExists($enrollee->id, 'good moral', false);
        $hasFilePhoto = $this->checkIfRequirementExists($enrollee->id, 'photo', false);
        $isOld = true;
        // $password = 'password';
        $password = 'bca' . Str::random(5);
        switch ($enrollee->student_type) {
            case 'New Student':
                if (($enrollee->hasPromissory == 1  && $hasFilePsa == true  && $hasFilePhoto == true) || ($enrollee->hasPromissory == 0 &&  $hasFilePhoto == true)) {
                    if ($enrollee->hasVerifiedEmail == 1) {
                        try {
                            $this->createStudentAccount($enrollee, $password);
                            $this->createStudentGrades($enrollee, $request->input('section_id'));
                              $this->sendEmail($enrollee, $password, false);
                            $this->updateStudent($id, $request->input('section_id'));
                            $this->enrollmentLog($enrollee->id, $enrollee->sy_id, $enrollee->grade_level_id, $request->input('section_id'));

                            toast()->success('SYSTEM MESSAGE', 'Successfully Enrolled  ' . $enrollee->first_name)->autoClose(6000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                            return redirect()->route('registrar.enrolled.index');
                        } catch (\Throwable $th) {
                            alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(6000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
                            return back();
                        }
                    } else {
                        toast()->error('SYSTEM MESSAGE', $enrollee->first_name . ' email is not verified')->autoClose(6000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                        return back();
                    }
                }
                break;
            case 'Old Student':
                if ($hasFileForm138 == true) {
                    try {
                        $this->createStudentGrades($enrollee, $request->input('section_id'));
                        $this->updateStudent($enrollee->id, $request->input('section_id'));
                        $this->enrollmentLog($enrollee->id, $enrollee->sy_id, $enrollee->grade_level_id, $request->input('section_id'));
                        $this->sendEmail($enrollee, $password, $isOld);
                        toast()->success('SYSTEM MESSAGE', 'Successfully Enrolled ' . $enrollee->first_name)->autoClose(6000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                        return redirect()->route('registrar.enrolled.index');
                    } catch (\Throwable $th) {
                        alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(6000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
                        return back();
                    }
                }
                break;
            case 'Transferee':
                if (($enrollee->hasPromissoryNote == 1 && $hasFileForm138 == true && $hasFileGoodMoral == true) || ($enrollee->hasPromissoryNote == 0  && $hasFilePsa == true  &&  $hasFileForm138 == true && $hasFileGoodMoral == true &&  $hasFilePhoto == true)) {
                    if ($enrollee->hasVerifiedEmail == 1) {
                        try {
                            $this->createStudentAccount($enrollee, $password);
                            $this->createStudentGrades($enrollee, $request->input('section_id'));
                            $this->enrollmentLog($enrollee->id, $enrollee->sy_id, $enrollee->grade_level_id, $request->input('section_id'));
                              $this->sendEmail($enrollee, $password, false);
                            $this->updateStudent($id, $request->input('section_id'));
                            toast()->success('SYSTEM MESSAGE', 'Successfully Enrolled  ' . $enrollee->first_name)->autoClose(6000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                            return redirect()->route('registrar.enrolled.index');
                        } catch (\Throwable $th) {
                            alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(6000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
                            return back();
                        }
                    } else {
                        toast()->error('SYSTEM MESSAGE', $enrollee->first_name . ' email is not verified')->autoClose(6000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                        return back();
                    }
                }
                break;
        }
        toast()->error('SYSTEM MESSAGE', $enrollee->first_name . '`s requirements is empty/not complete')->autoClose(6000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
        return back();
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
        $studentPhoto = $this->getRequirement($student->id, 'photo');

        $hasFilePsa = false;
        $hasFilePsa = $this->checkIfRequirementExists($student->id, 'psa', $hasFilePsa);
        $psaFile = $this->getRequirement($student->id, 'psa');

        $hasFileForm138 = false;
        $hasFileForm138 =  $this->checkIfRequirementExists($student->id, 'form 138', $hasFileForm138);
        $form138File = $this->getRequirement($student->id, 'form 138');

        $hasFileGoodMoral = false;
        $hasFileGoodMoral =  $this->checkIfRequirementExists($student->id, 'good moral', $hasFileGoodMoral);
        $goodMoral = $this->getRequirement($student->id, 'good moral');

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
