<?php

namespace App\Http\Controllers\Backend\registrar;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VerificationCode;
use App\Http\Controllers\Controller;
use App\Http\Controllers\General\MailController;
use App\Models\EnrollmentLog;
use App\Models\GradeLevel;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\Teacher;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $colors = [
            'new student' => '#f6ad55',
            'old student' => '#fc8181',
            'transferee' => '#90cdf4',
        ];
        $enrolleeCount = Student::where('status', 0)
            ->where('status', '=', 'enrollee')
            ->where('hasVerifiedEmail', '=', 1)
            ->count();
        $enrolledCount = Student::where('status', 1)
            ->where('status', '=', 'enrolled')
            ->count();
        $unverifiedStudents = Student::where('status', 'enrollee')
            ->where('hasVerifiedEmail', 0)
            ->get();
        $sectionCount = Section::count();
        $teacherCount = Teacher::where('isResigned', 0)->count();
        $gradeLevels = GradeLevel::all();
        $currentSy = session()->get(Auth::id() . '_current_sy');

        $schoolYears = SchoolYear::with('enrollmentLogs')->orderBy('name', 'ASC')->get();
        $enrollmentBySchoolYear = $schoolYears->groupBy('name')
            ->reduce(
                function ($columnChartModel, $data) {
                    return $columnChartModel->addSeriesColumn('New', $data->first()->name, $data->first()->enrollmentLogs->where('student_type', 'New Student')->count())
                        ->addSeriesColumn('Old', $data->first()->name, $data->first()->enrollmentLogs->where('student_type', 'Old Student')->count())
                        ->addSeriesColumn('Transferee', $data->first()->name, $data->first()->enrollmentLogs->where('student_type', 'Transferee')->count());
                },
                LivewireCharts::multiColumnChartModel()
                    /* give me a good title for this chart */
                    ->setTitle('Enrollment by School Year')
                    ->setDataLabelsEnabled(true)
                    ->setAnimated(true)
                    ->setColumnWidth(15)
                    ->stacked()
                    ->withGrid()
                    /* generate unique colors that is good for chart */
                    ->setColors(collect(['#f6ad55', '#fc8181', '#90cdf4', '#63b3ed', '#4299e1', '#3182ce', '#2b6cb0', '#2c5282', '#2a4365', '#4fd1c5', '#38b2ac', '#319795', '#2c7a7b', '#285e61', '#48bb78', '#38a169', '#2f855a', '#276749', '#9ae6b4', '#68d391', '#4fd1c5', '#38b2ac', '#319795', '#2c7a7b', '#285e61', '#48bb78', '#38a169', '#2f855a', '#276749', '#9ae6b4', '#68d391', '#4fd1c5', '#38b2ac', '#319795', '#2c7a7b', '#285e61', '#48bb78', '#38a169', '#2f855a', '#276749', '#9ae6b4', '#68d391', '#4fd1c5', '#38b2ac', '#319795', '#2c7a7b', '#285e61', '#48bb78', '#38a169', '#2f855a', '#276749', '#9ae6b4', '#68d391']))

            );
        //generate a pie chart
        $newStudentsCount = EnrollmentLog::with('sy')->where('student_type', 'New Student')
            ->where('sy_id', '=', $currentSy)
            ->count();
        $oldStudentsCount = EnrollmentLog::with('sy')->where('student_type', 'Old Student')
            ->where('sy_id', '=', $currentSy)
            ->count();
        $transfereeStudentsCount = EnrollmentLog::with('sy')->where('student_type', 'Transferee')
            ->where('sy_id', '=', $currentSy)
            ->count();
        $studentTypesBySchoolYear =
            (LivewireCharts::pieChartModel())
            ->setTitle('Total Enrollees')
            ->setAnimated(true)
            ->setDataLabelsEnabled(true)
            ->addSlice('New Students', $newStudentsCount, '#f6ad55')
            ->addSlice('Old Students', $oldStudentsCount, '#fc8181')
            ->addSlice('Transferee Students', $transfereeStudentsCount, '#90cdf4')
            ->setColors(['#f6ad55', '#fc8181', '#90cdf4']);
        return view(
            'BCA.Backend.registrar-layouts.dashboard.index',
            compact('enrolleeCount', 'enrolledCount', 'unverifiedStudents', 'sectionCount', 'teacherCount', 'gradeLevels', 'currentSy', 'schoolYears', 'enrollmentBySchoolYear', 'studentTypesBySchoolYear')
        );
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
    public function sendVerificationCode()
    {
        $students = Student::where('hasVerifiedEmail', 0)
            ->where('enrollee', 0)
            ->get();
        foreach ($students as $student) {
            $code = sha1(time() . $student->student_id);
            $name = Str::ucfirst($student->first_name);
            $recipient = $student->email;
            VerificationCode::where('student_id', '=', $student->id)->firstOrCreate([
                'student_id' => $student->id,
                'verification_code' => $code,
                'date_sent' => now(),
                'expiration_date' => now()->addDay(3),
            ]);
            MailController::sendVerificationCodeMail($name, $recipient, $code);
        }
        toast()->success('SYSTEM MESSAGE', "The verification code was sent successfully.")->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
        return redirect()->back();
    }
    public function acceptAllUnverifiedEmails()
    {
        $students = Student::where('hasVerifiedEmail', 0)
            ->where('status', 'enrollee')
            ->get();
            foreach ($students as $student) {
                $student->update(['hasVerifiedEmail'=>1]);
            }
            return back()->with('successToast', 'All unverified emails were updated successfully.');
    }
}
