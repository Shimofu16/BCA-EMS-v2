<?php

namespace App\Http\Livewire\Backend\Student;

use Carbon\Carbon;
use App\Models\Annual;
use App\Models\Balance;
use App\Models\Payment;
use Livewire\Component;
use App\Models\GradeLevel;
use App\Models\PaymentLog;
use App\Models\SchoolYear;
use App\Models\BankAccount;
use Illuminate\Support\Str;
use App\Models\EnrollmentLog;
use Livewire\WithFileUploads;
use App\Http\Controllers\General\FileController;
use App\Http\Controllers\General\ExportController;

class EnrollmentForm extends Component

{
    use WithFileUploads;
    public $isEnrollment;
    public $student;
    public $guardian;
    public $currentSy;
    public $newGl;

    public $student_lrn;

    /* public $retVal = () ? a : b ; */

    public $form_138;


    public $payment_method;
    public $payment_options;
    public $payment_proof;
    public $total_payment = 0;
    /* public $preschool = false, $elem = false, $jhs = false;
    public $downloadFiles = false;
    public $dowloadForms  = false;*/
    public $eCopies = ['STUDENT', 'HEAD TEACHER', 'ADMIN'];
    public $pCopies = ['STUDENT', 'ADMIN'];

    public $isDone = false;
    public $isDoneSelectingStudentType = false;
    public $isDoneFillUp = false;
    public $isEFormDownloaded = false;
    public $isPFormDownloaded = false;
    public $isFormDownloaded = false;

    public $accounts;
    public $totalSteps = 3;
    public $currentStep = 1;
    public $currentTitle;
    public $old = true;
    protected $messages = [
        'student_lrn.required' => 'The student`s LRN cannot be empty.',
        'student_lrn.numeric' => 'The student`s LRN must be a 12-digit number.',
        'student_lrn.digits' => 'The student`s LRN must be 12 digits long.',
        'student_lrn.unique' => 'The student`s LRN is already in use.',
        'first_name.required' => 'The first name cannot be empty.',
        'first_name.string' => 'The first name must be a string.',
        'middle_name.required' => 'The middle name cannot be empty.',
        'middle_name.string' => 'The middle name must be a string.',
        'last_name.required' => 'The last name cannot be empty.',
        'last_name.string' => 'The last name must be a string.',
        'gender.required' => 'The gender cannot be empty.',
        'email.required' => 'The email address cannot be empty.',
        'email.unique' => 'The email address is already in use.',
        'email.email' => 'The email address format is not valid.',
        'birth_date.required' => 'The birth_date cannot be empty.',
        'birth_date.date' => 'The birth_date must be a valid date.',
        'birth_date.before' => 'The birth_date must be before today.',
        'birthplace.required' => 'The birthplace cannot be empty.',
        'birthplace.string' => 'The birthplace must be a string.',
        'address.required' => 'The address cannot be empty.',
        'address.string' => 'The address must be a string.',
        'grade_level_id.required' => 'The grade level cannot be empty.',
        'grade_level_id.numeric' => 'The grade level must be a number.',

        /* step 2 */
        /* Father */
        'father_name.required' => 'The father name cannot be empty.',
        'father_name.string' => 'The father name must be a string.',
        'father_birthdate.required' => 'The father birth_date cannot be empty.',
        'father_birthdate.date' => 'The father birth_date must be a valid date.',
        'father_birthdate.before' => 'The father birth_date must be before today.',
        'father_contact_no.required' => 'The father contact number cannot be empty.',
        'father_contact_no.numeric' => 'The father contact number must be a number.',
        'father_contact_no.min' => 'The father contact number must be 11 digits long.',
        'father_contact_no.max' => 'The father contact number must be 15 digits long.',
        'father_contact_no.digits' => 'The father contact number must be 15 digits long.',
        'father_landline.numeric' => 'The father landline must be a number.',
        'father_landline.digits' => 'The father landline must be 10 digits long.',
        'father_office_contact.numeric' => 'The father office contact must be a number.',
        'father_office_contact.digits' => 'The father office contact must be 15 digits long.',


        /* Mother */
        'mother_name.required' => 'The mother name cannot be empty.',
        'mother_name.string' => 'The mother name must be a string.',
        'mother_birthdate.required' => 'The mother birth_date cannot be empty.',
        'mother_birthdate.date' => 'The mother birth_date must be a valid date.',
        'mother_birthdate.before' => 'The mother birth_date must be before today.',
        'mother_contact_no.required' => 'The mother contact number cannot be empty.',
        'mother_contact_no.numeric' => 'The mother contact number must be a number.',
        'mother_contact_no.min' => 'The mother contact number must be 11 digits long.',
        'mother_contact_no.max' => 'The mother contact number must be 15 digits long.',
        'mother_contact_no.digits' => 'The mother contact number must be 15 digits long.',
        'mother_landline.numeric' => 'The mother landline must be a number.',
        'mother_landline.digits' => 'The mother landline must be 10 digits long.',
        'mother_office_contact.numeric' => 'The mother office contact must be a number.',
        'mother_office_contact.digits' => 'The mother office contact must be 15 digits long.',



        /* step 3 */
        'guardian_name.required' => 'The guardian name cannot be empty.',
        'guardian_name.string' => 'The guardian name must be a string.',
        'guardian_contact.required' => 'The guardian contact cannot be empty.',
        'guardian_contact.numeric' => 'The guardian contact must be a number.',
        'guardian_contact.digits' => 'The guardian contact must be 11 digits long.',
        'guardian_address.required' => 'The guardian address cannot be empty.',
        'guardian_address.string' => 'The guardian address must be a string.',
        'guardian_email.required' => 'The guardian email cannot be empty.',
        'guardian_email.email' => 'The guardian email format is not valid.',
        'guardian_relationship.required' => 'The guardian relationship cannot be empty.',

        /* Step 4 */
        'psa.required' => 'The Birth Certificate is required.',
        'psa.mimes' => 'The Birth Certificate file must be in pdf, jpg, jpeg, or png format.',
        'psa.max' => 'The Birth Certificate file size must be less than 8192KB.',
        'form_137.required' => 'The Form 137 is required.',
        'form_137.mimes' => 'The Form 137 file must be in pdf, jpg, jpeg, or png format.',
        'form_137.max' => 'The Form 137 file size must be less than 8192KB.',
        'good_moral.required' => 'The Good Moral certificate is required.',
        'good_moral.mimes' => 'The Good Moral certificate file must be in pdf, jpg, jpeg, or png format.',
        'good_moral.max' => 'The Good Moral certificate file size must be less than 8192KB.',
        'photo.required' => 'The 1x1 Photo ID is required.',
        'photo.mimes' => 'The 1x1 Photo ID file must be in jpg, jpeg, or png format.',
        'photo.max' => 'The 1x1 Photo ID file size must be less than 2192KB.',

        /* step 5 */
        'conPayment.required' => 'The confirmation of payment field cannot be empty.',
        'payment_method.required' => 'The payment method field cannot be empty.',
        'payment_proof.required' => 'The payment proof field cannot be empty.',
        'payment_proof.mimes' => 'The payment proof must be a jpeg, jpg, or png image.',
        'payment_proof.max' => 'The payment proof image must not exceed 2192 kilobytes.',
    ];
    public function mount()
    {

        if ($this->student->enrollmentCompleted == 1) {
            $this->isDone = true;
        }

        $this->accounts = BankAccount::all();
        $this->currentSy = SchoolYear::where('is_active', '=', 1)->first();
        $this->isEnrollment = ($this->currentSy->enrollment_status === "open") ? true : false;
        $this->newGl = $this->student->grade_level_id + 1;
        $this->newGl = ($this->newGl > 14) ? 14 : $this->newGl;
    }

    public function downloadEForm()
    {
        try {
            $title = 'enrollment';
            $st = 2;
            // if yung value ng grade level id ay between 1 - 3 pre school yun
            if ($this->newGl >= 1 && $this->newGl <= 4) {
                $gt = 1;
            }
            // if yung value ng grade level id ay between 4 - 9  thats Elementary
            if ($this->newGl >= 5 && $this->newGl <= 10) {
                $gt = 2;
            }
            // and if yung value ng grade level id ay between 10 - 13  Junior High School
            if ($this->newGl >= 11 && $this->newGl <= 14) {
                $gt = 3;
            }
            $student = [
                'id' => $this->student->id,
                'lrn' => $this->student_lrn,
                'student_id' => $this->student->student_id,
                'last_name' => $this->student->last_name,
                'first_name' =>  $this->student->first_name,
                'mi' => Str::ucfirst(Str::substr($this->student->middle_name, 0, 1)),
                'address' => $this->student->address,
                'birth_date' => $this->student->birth_date,
                'birthplace' => $this->student->birthplace,
                'grade_level' => GradeLevel::where('id', '=', $this->newGl)->first()->grade_name,
            ];
            $guardian = [
                'name' => $this->guardian->name,
                'address' => $this->guardian->address,
                'contact' => $this->guardian->contact_no,
                'email' => $this->guardian->email,
                'relation' => $this->guardian->relationship,
            ];
            $sy = SchoolYear::where('is_active', '=', 1)->first();
            $PDF = ExportController::forms($title, $this->eCopies, $this->payment_method, $st, $gt, $student, $guardian, $this->getStudentName());
            $this->isEFormDownloaded  = true;
            return response()->streamDownload(
                fn () => print($PDF),
                $title . '_form_' . $sy->name . '.pdf'
            );
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function downloadPForm()
    {

        $title = 'payment';
        $st = 2;
        // if yung value ng grade level id ay between 1 - 3 pre school yun
        if ($this->newGl >= 1 && $this->newGl <= 4) {
            $gt = 1;
        }
        // if yung value ng grade level id ay between 4 - 9  thats Elementary
        if ($this->newGl >= 5 && $this->newGl <= 10) {
            $gt = 2;
        }
        // and if yung value ng grade level id ay between 10 - 13  Junior High School
        if ($this->newGl >= 11 && $this->newGl <= 14) {
            $gt = 3;
        }
        $student = [
            'id' => $this->student->id,
            'lrn' => $this->student_lrn,
            'student_id' => $this->student->student_id,
            'last_name' => $this->student->last_name,
            'first_name' =>  $this->student->first_name,
            'mi' => Str::ucfirst(Str::substr($this->student->middle_name, 0, 1)),
            'address' => $this->student->address,
            'birth_date' => $this->student->birth_date,
            'birthplace' => $this->student->birthplace,
            'grade_level' => GradeLevel::where('id', '=', $this->newGl)->first()->grade_name,
        ];
        $guardian = [
            'name' => $this->guardian->name,
            'address' => $this->guardian->address,
            'contact' => $this->guardian->contact_no,
            'email' => $this->guardian->email,
            'relation' => $this->guardian->relationship,
        ];
        $sy = SchoolYear::where('is_active', '=', 1)->first();
        $PDF = ExportController::forms($title, $this->pCopies, $this->payment_method, $st, $gt, $student, $guardian, $this->getStudentName());
        if ($this->isEFormDownloaded) {

            $this->isFormDownloaded = true;
            // $this->resetExcept(['isDoneFillUp', 'isFormDownloaded', 'currentSy', 'isEnrollment']);
        }
        return response()->streamDownload(
            fn () => print($PDF),
            $title . '_form_' . $sy->name . '.pdf'
        );
    }
    public function increaseStep()
    {
        $this->validateData();
        $this->resetErrorBag();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
        if ($this->currentStep == $this->totalSteps) {
            $this->getTotalPayment();
        }
    }
    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }
    public function validateData()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'student_lrn' => 'numeric|nullable|digits:12|unique:students,student_lrn',
                ], $this->messages);
                break;
            case 2:
                $this->validate([
                    'form_138' => 'required|mimes:pdf,jpg,jpeg,png|max:2192',
                ], $this->messages);
                break;
            case 3:
                if ($this->payment_options == 'Bank Deposit') {
                    $this->validate([
                        'payment_options' => 'required',
                        'payment_method' =>  'required',
                        'payment_proof' => 'required|mimes:jpg,jpeg,png|max:2192',
                    ], $this->messages);
                } else {

                    $this->validate([
                        'payment_options' => 'required',
                        'payment_method' =>  'required',
                    ], $this->messages);
                }
                break;
        }
    }

    public function getAge()
    {
        return Carbon::parse($this->student->birth_date)->diff(Carbon::now())->y;
    }
    public function getStudentName()
    {
        return  Str::ucfirst($this->student->first_name) . ' ' . Str::ucfirst(Str::substr($this->student->middle_name, 0, 1)) . ' ' . Str::ucfirst($this->student->last_name);
    }
    public function getDepartment($level)
    {
        // if yung value ng grade level id ay between 1 - 3 pre school yun
        if ($level >= 1 && $level <= 4) {
            return "Preschool";
        }
        // if yung value ng grade level id ay between 4 - 9  thats Elementary
        if ($level >= 5 && $level <= 10) {
            return "Elementary";
        }
        // and if yung value ng grade level id ay between 10 - 13  Junior High School
        if ($level >= 11 && $level <= 14) {
            return  "Junior High School";
        }
    }
    public function getLevel($level)
    {
        switch ($level) {
            case 1:
                return 1;
                break;
            case 2:
                return 1;
                break;
            case 3:
                return 2;
                break;
            case 4:
                return 3;
                break;
            case 5:
                return 4;
                break;
            case 6:
                return 4;
                break;
            case 7:
                return 4;
                break;
            case 8:
                return 5;
                break;
            case 9:
                return 5;
                break;
            case 10:
                return 5;
                break;
            case 11:
                return 6;
                break;
            case 12:
                return 6;
                break;
            case 13:
                return 6;
                break;
            case 14:
                return 6;
                break;
        }
    }
    public function payment($path)
    {
        $level_id = $this->getLevel($this->newGl);
        $current_sy = SchoolYear::where('is_active', '=', 1)->first();
        $annuals = Annual::where('sy_id', '=', $current_sy->id)->where('level_id', '=', $level_id)->get();
        $balance = 0;
        $payment_method = '';
        $reminder_at = '';
        foreach ($annuals as $annual) {
            $balance += $annual->amount;
        }
        switch ($this->payment_method) {
            case 1:
                $reminder_at = now()->addYear(1);
                $payment_method = 'Annual';
                break;
            case 2:
                $reminder_at = now()->addMonth(6);
                $payment_method = 'Semi-Annual';
                break;
            case 3:
                $reminder_at = now()->addMonth(3);
                $payment_method = 'Quarterly';
                break;
            case 4:
                $reminder_at = now()->addMonth(1);
                $payment_method = 'Monthly';
                break;
        }

        $bal = Balance::where('student_id', '=', $this->student->id)->first();
        $bal->update([
            'amount' => $bal->amount + $balance,
            'reminder_at' => $reminder_at,
            'updated_at' => now(),
        ]);
        $payment = Payment::create([
            'student_id' => $this->student->id,
            'sy_id' => $current_sy->id,
            'grade_level_id' => $this->newGl,
            'mop' => $this->payment_options,
            'payment_method' => $payment_method,
        ])->id;
        PaymentLog::create([
            'student_id' => $this->student->id,
            'payment_id' => $payment,
            'created_by' => 'Created by Student upon enrollment',
            'created_at' => now(),
        ]);
        if ($this->payment_proof != null) {
            FileController::pop($path, $payment, $this->payment_proof, $current_sy->name);
        }
    }
    private function getTotalPayment()
    {
        $level_id = $this->getLevel($this->newGl);
        $annuals = Annual::where('sy_id', '=', $this->currentSy->id)->where('level_id', '=', $level_id)->get();
        foreach ($annuals as $annual) {
            $this->total_payment += $annual->amount;
        }
    }
    public function registerStudent()
    {
        $this->validateData();
        $this->resetErrorBag();
        /* update the sy to current sy  */
        $age = $this->getAge();
        $name = $this->getStudentName();
        try {
            $path = 'uploads/requirements/' . $name;
            $this->student->age = $age;
            $this->newGl = $this->newGl;
            $this->student->sy_id = $this->currentSy->id;
            $this->student->status = "enrollee";
            $this->student->enrollmentCompleted = 1;
            $this->student->department = $this->getDepartment($this->newGl);
            $this->student->update();
            EnrollmentLog::create([
                'student_id' => $this->student->id,
                'grade_level_id' => $this->newGl,
                'sy_id' => $this->currentSy->id,
                'student_type' => 'Old Student',
                'department' => $this->getDepartment($this->newGl),
                'created_at' => now(),
            ]);
            $this->payment($path);
            FileController::old($path, $this->student->id, $this->form_138);
            $this->isDoneFillUp = true;
        } catch (\Throwable $th) {
            dd($th, $this->student->student_id);
        }
    }
    public function render()
    {
        switch ($this->currentStep) {
            case 1:
                $this->currentTitle = "Student Information";
                break;
            case 2:
                $this->currentTitle = "Requirements";
                break;
            case 3:
                $this->currentTitle = "Payment";
                break;
            case 4:
                $this->currentTitle = "Download Forms";
                break;
            default:

                break;
        }
  return view('livewire.backend.student.enrollment-form');
    }
}
