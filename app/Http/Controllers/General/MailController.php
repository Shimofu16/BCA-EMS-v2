<?php

namespace App\Http\Controllers\General;

use App\Models\Balance;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Mail\Enrollment\Code;
use App\Models\VerificationCode;
use App\Mail\Enrollment\Verified;
use App\Mail\Users\sendAccountInfo;
use App\Http\Controllers\Controller;

use App\Mail\EnrollmentAccepted;
use Illuminate\Support\Facades\Mail;
use App\Mail\Payment\dueDateReminder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MailController extends Controller
{
    public static function sendAcceptedMail($name, $student_id, $recipient, $password, $isOld)
    {
        $data = [
            'name' => $name,
            'student_id' => $student_id,
            'password' => $password,
            'isOld' => $isOld
        ];
        Mail::to($recipient)->send(new EnrollmentAccepted($data));
    }
    public static function sendVerificationCodeMail($name, $recipient, $verification_code)
    {
        try {
            $data = [
                'name' => $name,
                'verification_code' => $verification_code
            ];
            Mail::to($recipient)->send(new Code($data));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public static function sendDueDateReminderMail()
    {
        $balances = Balance::where('reminder_at', '>=', now()->startOfMonth())
            ->where('reminder_at', '<=', now()->endOfMonth())
            ->get();

        foreach ($balances as $balance) {
            $data = [
                'name' => $balance->student->first_name,
                'date' => $balance->reminder_at,
            ];
            Mail::to($balance->student->email)->send(new dueDateReminder($data));
        }
    }
    public static function sendAccountInfo($recipient, $data)
    {
        Mail::to($recipient)->send(new  sendAccountInfo($data));
    }
    public static function sendVerifiedMail($name, $recipient,)
    {
        $data = [
            'name' => $name,
        ];
        Mail::to($recipient)->send(new Verified($data));
    }
    public function verifyStudent(Request $request)
    {
        try {
            // Find the verification code
            $verification_code = VerificationCode::where('verification_code', $request->token)
                ->firstOrFail();

            // Find the student associated with the verification code
            $student = Student::where('id', $verification_code->student_id)->firstOrFail();

            // Mark the student's email as verified
            $student->hasVerifiedEmail = 1;
            $student->save();

            // Delete the verification code
            $verification_code->delete();

            // Send the verified email
            $this->sendVerifiedMail($student->first_name, $student->email);

            // Redirect with a success message
            alert()->success('Success', 'Your email address has been successfully validated!');
            return redirect()->route('enroll.index');
        } catch (ModelNotFoundException $th) {
            // If the verification code or student is not found, show an error message

            alert()->error('Error', 'Invalid Verification Code')->footer('<a href="/resend/verification">Resend Verification Code?</a>');
            return redirect()->route('enroll.index');
        }
    }
    public function resendCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:students,email']);

        $student = Student::where('email', $request->email)->first();
        if ($student) {
            VerificationCode::where('student_id', $student->student_id)->delete();
            if ($student->hasVerifiedEmail == 0) {
                $code = sha1(time() . $student->student_id);
                VerificationCode::create([
                    'student_id' => $student->student_id,
                    'verification_code' => $code,
                    'date_sent' => now(),
                    'expiration_date' => now()->addDay(3),
                ]);
                MailController::sendVerificationCodeMail($student->first_name, $student->email, $code);
                alert()->success('Success', 'Verification code successfully sent to your Email')->autoClose(5000);
            } else {
                alert()->info('Information', 'Your Email is already verified')->autoClose(5000);
            }
        } else {
            alert()->error('Error', 'Invalid Email')->autoClose(5000);
        }
        return back();
    }
}
