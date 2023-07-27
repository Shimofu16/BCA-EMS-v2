<?php

namespace App\Http\Controllers\Frontend\Tracker;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\MailController;
use App\Models\Student;
use App\Models\VerificationCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EnrollmentTrackerController extends Controller
{
    public function index()
    {
        return view('BCA.Frontend.pages.portal.form');
    }
    public function track(Request $request)
    {
        try {
            //find the student`s email
            $student = Student::where('email', '=', $request->input('email'))->firstOrFail();

            try {
                //find if the student`s email is verified
                $student = Student::where('email', '=', $request->input('email'))
                    ->where('hasVerifiedEmail', '=', 1)->firstOrFail();
                $isEnrolled = ($student->status == 1) ? true : false;
                if ($isEnrolled) {
                    alert()->info('SYSTEM MESSAGE', "You're already enrolled. Please check the email for more information.")->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
                    return redirect()->back();
                }
                alert()->info('SYSTEM MESSAGE', "Your enrollment for our school is being processed. You'll soon receive a confirmation email from us.")->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
                return redirect()->back();
            } catch (\Throwable $th) {
                //if not, send another verification code.
                $code = sha1(time() . $student->student_id);
                $name = Str::ucfirst($student->first_name);
                $recipient = $student->email;
                VerificationCode::create([
                    'student_id' => $student->student_id,
                    'verification_code' => $code,
                    'date_sent' => now()->toDateString(),
                    'expiration_date' => now()->addDay(3),
                ]);
                MailController::sendVerificationCodeMail($name, $recipient, $code);
                alert()->info('SYSTEM MESSAGE', "We were unable to validate your email address, which is unfortunate. We have emailed you a new verification code in order to verify your identity.")->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            //if no email in database throw a message.
            alert()->error('SYSTEM MESSAGE', "The provided credentials do not match our records")->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return redirect()->back();
        }
    }
   public function trackViaEmail($id)
    {
        try {
            //find the student`s email
            $student = Student::findOrFail($id);
            $code = sha1(time() . $student->student_id);
            $name = Str::ucfirst($student->first_name);
            $recipient = $student->email;
            VerificationCode::where('student_id', '=', $id)->firstOrCreate([
                'student_id' => $student->id,
                'verification_code' => $code,
                'date_sent' => now(),
                'expiration_date' => now()->addDay(3),
            ]);
            MailController::sendVerificationCodeMail($name, $recipient, $code);
            toast()->success('SYSTEM MESSAGE', "The verification code was sent successfully.")->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //if no email in database throw a message.
            alert()->error('SYSTEM MESSAGE', "The provided credentials do not match our records")->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return redirect()->back();
        }
    }
}
