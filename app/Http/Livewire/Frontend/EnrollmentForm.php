<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Controllers\General\ExportController;
use App\Http\Controllers\General\FileController;
use App\Models\Annual;
use App\Models\Balance;
use App\Models\BankAccount;
use App\Models\EnrollmentLog;
use App\Models\FamilyMember;
use App\Models\GradeLevel;
use App\Models\Payment;
use App\Models\PaymentLog;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EnrollmentForm extends Component
{

        // use laravel snappy for downloading the form
        use WithFileUploads;
        public $isEnrollment = false;
        public $currentSy;
        public $student = [];


        public $sdbId;
        public $student_lrn;
        public $student_id;
        public $first_name;
        public $middle_name;
        public $last_name;
        public $ext_name;
        public $gender;
        public $age;
        public $email;
        public $birth_date;
        public $birthplace;
        public $address;
        // public $regions, $region, $region_id;
        // public $provinces, $province, $province_id;
        // public $cities, $city, $city_id;
        // public $barangays, $barangay, $barangay_id;
        public $street;
        public $grade_level_id;
        public $grade_level;
        public $sy;

        /* public $retVal = () ? a : b ; */

        public $father_name;
        public $father_birthdate;
        public $father_landline;
        public $father_email;
        public $father_contact_no;
        public $father_occupation;
        public $father_office_address = '';
        public $father_office_contact;

        public $mother_name;
        public $mother_birthdate;
        public $mother_landline;
        public $mother_email;
        public $mother_contact_no;
        public $mother_occupation;
        public $mother_office_address = '';
        public $mother_office_contact;

        public $guardian_name;
        public $guardian_contact;
        public $guardian_address;
        public $guardian_email;
        public $guardian_relationship;

        public $psa = '';
        public $form_137 = '';
        public $good_moral = '';
        public $photo = '';
        public $promissory_note = 0;

        public $conPayment = '';
        public $annual, $semi, $quarter, $monthly;
        public $payment;
        public $reminder_at;
        public $payment_method;
        public $payment_proof;
        public $total_payment = 0;

        public $eCopies = ['STUDENT', 'HEAD TEACHER', 'ADMIN'];
        public $pCopies = ['STUDENT', 'ADMIN'];


        public $new = false;
        public $transferee = false;
        public $old = false;
        public $student_type;
        public $pn;
        public $levels;
        /* new variables */
        //student information

        //form manipulation
        public $isDoneSelectingStudentType = false;
        public $isDoneFillUp = false;
        public bool $isEFormDownloaded = false;
        public bool $isPFormDownloaded = false;
        public bool $isFormDownloaded = false;
        public $totalSteps = 5;
        public $currentStep = 0;
        public $currentTitle;
        public $accounts;

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
            // 'address.required' => 'The address cannot be empty.',
            // 'address.string' => 'The address must be a string.',
            'region_id.required' => 'The region cannot be empty.',
            'region_id.numeric' => 'The region must be a number.',
            'province_id.required' => 'The province cannot be empty.',
            'province_id.numeric' => 'The province must be a number.',
            'city_id.required' => 'The city cannot be empty.',
            'city_id.numeric' => 'The city must be a number.',
            'barangay_id.required' => 'The barangay cannot be empty.',
            'barangay_id.numeric' => 'The barangay must be a number.',
            'street.required' => 'The street cannot be empty.',
            'street.string' => 'The street must be a string.',
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
            try {
                $sy =  SchoolYear::where('is_active', '=', 1)->where('enrollment_status', '=', 'open')->firstOrFail();
                $this->currentSy = $sy->name;
                $this->isEnrollment = true;
            } catch (\Throwable $th) {
                $this->isEnrollment = false;
                $currentYear = date("Y");
                $this->currentSy = $currentYear . '-' . ($currentYear + 1);
            }
            $this->levels = GradeLevel::all();
            $this->accounts = BankAccount::all();
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
                        'student_lrn' => (($this->grade_level_id > 4) ? 'required|' : 'nullable|') . 'numeric|digits:12|unique:students,student_lrn',
                        'first_name' => 'required|string',
                        'middle_name' => 'required|string',
                        'last_name' => 'required|string',
                        'gender' => 'required',
                        'email' => 'required|unique:students,email|email',
                        'birth_date' => 'required|date|before:today|after:2000-01-01',
                        'birthplace' => 'required|string',
                        'address' => 'required|string',
                        'grade_level_id' => 'required|numeric',
                    ], $this->messages);
                    break;
                case 2:
                    $this->validate([
                        'father_name' => 'required|string',
                        'father_birthdate' => 'required|date|before:today',
                        'father_contact_no' => 'required|numeric|digits:11',
                        'father_landline' => 'numeric|digits:10|nullable',
                        'father_office_contact' => 'numeric|digits:11|nullable',
                        'father_occupation' => 'required|string',

                        'mother_name' => 'required|string',
                        'mother_birthdate' => 'required|date|before:today',
                        'mother_contact_no' => 'required|numeric|digits:11',
                        'mother_landline' => 'numeric|digits:10|nullable',
                        'mother_office_contact' => 'numeric|digits:11|nullable',
                        'mother_occupation' => 'required|string',
                    ], $this->messages);
                    break;
                case 3:
                    $this->validate([
                        'guardian_name' => 'required|string',
                        'guardian_contact' =>  'required|numeric|digits:11',
                        'guardian_address' => 'required|string',
                        'guardian_email' => 'required|email',
                        'guardian_relationship' => 'required',
                    ], $this->messages);
                    break;
                case 4:
                    if ($this->promissory_note == 1) {
                        if ($this->transferee) {
                            $this->validate([
                                'psa' => 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'form_137' => (($this->form_137 == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'good_moral' => (($this->good_moral == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'photo' => 'mimes:jpg,jpeg,png|max:2192',
                            ], $this->messages);
                        } else {
                            $this->validate([
                                'psa' => 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'photo' => (($this->photo == null) ? 'required|'  : '') . 'mimes:jpg,jpeg,png|max:2192',
                            ], $this->messages);
                        }
                    } else {
                        if ($this->transferee) {
                            $this->validate([
                                'psa' => (($this->psa == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'form_137' => (($this->form_137 == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'good_moral' => (($this->good_moral == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'photo' => (($this->photo == null) ? 'required|'  : '') . 'mimes:jpg,jpeg,png|max:2192',
                            ], $this->messages);
                        } else {
                            $this->validate([
                                'psa' => (($this->psa == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'photo' => (($this->photo == null) ? 'required|'  : '') . 'mimes:jpg,jpeg,png|max:2192',
                            ], $this->messages);
                        }
                    }
                    break;
                case 5:
                    if ($this->conPayment == 'Bank Deposit') {
                        $this->validate([
                            'conPayment' => 'required',
                            'payment_method' =>  'required',
                            'payment_proof' => 'required|mimes:jpg,jpeg,png|max:2192',
                        ], $this->messages);
                    } else {

                        $this->validate([
                            'conPayment' => 'required',
                            'payment_method' =>  'required',
                        ], $this->messages);
                    }

                    break;
            }
        }
        /* public function updated($propertyName)
        {
            switch ($this->currentStep) {
                case 1:
                    $this->validateOnly($propertyName, [
                        'student_lrn' => 'numeric|digits:12|unique:students,student_lrn',
                        'first_name' => 'required|string',
                        'middle_name' => 'required|string',
                        'last_name' => 'required|string',
                        'gender' => 'required',
                        'email' => 'required|unique:students,email',
                        'birth_date' => 'required',
                        'birthplace' => 'required|string',
                        'address' => 'required|string',
                        'grade_level_id' => 'required|numeric',
                    ]);
                    break;
                case 2:
                    $this->validateOnly($propertyName, [
                        'father_name' => 'required|string',
                        'father_birthdate' => 'required',
                        'father_contact_no' => 'required|numeric|digits:11',
                        'father_occupation' => 'required',
                        'father_office_address' => 'string',
                        'father_office_contact' => 'numeric',

                        'mother_name' => 'required|string',
                        'mother_birthdate' => 'required',
                        'mother_contact_no' =>  'required|numeric|digits:11',
                        'mother_occupation' => 'required',
                        'mother_office_address' => 'string',
                        'mother_office_contact' => 'numeric',

                    ]);
                    break;
                case 3:
                    $this->validateOnly($propertyName, [
                        'guardian_name' => 'required|string',
                        'guardian_contact' =>  'required|numeric|digits:11',
                        'guardian_address' => 'required',
                        'guardian_email' => 'required',
                        'guardian_relationship' => 'required',
                    ]);
                    break;
                case 4:
                    if ($this->promissory_note == 1) {
                        if ($this->transferee) {
                            $this->validateOnly($propertyName, [
                                'psa' => 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'form_137' => (($this->form_137 == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'good_moral' => (($this->good_moral == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'photo' => 'mimes:jpg,jpeg,png|max:2192',
                            ]);
                        } else {
                            $this->validateOnly($propertyName, [
                                'psa' =>  'mimes:pdf,jpg,jpeg,png|max:8192',
                                'photo' => (($this->photo == null) ? 'required|'  : '') . 'mimes:jpg,jpeg,png|max:2192',
                            ]);
                        }
                    } else {
                        if ($this->transferee) {
                            $this->validateOnly($propertyName, [
                                'psa' => (($this->psa == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'form_137' => (($this->form_137 == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'good_moral' => (($this->good_moral == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'photo' => (($this->photo == null) ? 'required|'  : '') . 'mimes:jpg,jpeg,png|max:2192',
                            ]);
                        } else {
                            $this->validateOnly($propertyName, [
                                'psa' => (($this->psa == null) ? 'required|'  : '') . 'mimes:pdf,jpg,jpeg,png|max:8192',
                                'photo' => (($this->photo == null) ? 'required|'  : '') . 'mimes:jpg,jpeg,png|max:2192',
                            ]);
                        }
                    }
                    break;
            }
        } */
        public function downloadEForm()
        {
            try {
                $title = 'enrollment';
                if ($this->new) {
                    $st = 1;
                } elseif ($this->transferee) {
                    $st = 3;
                }
                // if yung value ng grade level id ay between 1 - 3 pre school yun
                if ($this->grade_level_id >= 1 && $this->grade_level_id <= 4) {
                    $gt = 1;
                }
                // if yung value ng grade level id ay between 4 - 9  thats Elementary
                if ($this->grade_level_id >= 5 && $this->grade_level_id <= 10) {
                    $gt = 2;
                }
                // and if yung value ng grade level id ay between 10 - 13  Junior High School
                if ($this->grade_level_id >= 11 && $this->grade_level_id <= 14) {
                    $gt = 3;
                }
                $student = [
                    'id' => $this->sdbId,
                    'lrn' => $this->student_lrn,
                    'student_id' => $this->student_id,
                    'last_name' => $this->last_name,
                    'first_name' =>  $this->first_name,
                    'mi' => Str::ucfirst(Str::substr($this->middle_name, 0, 1)),
                    'address' => $this->address,
                    'birth_date' => $this->birth_date,
                    'birthplace' => $this->birthplace,
                    'grade_level' => GradeLevel::where('id', '=', $this->grade_level_id)->first()->name,
                ];
                $guardian = [
                    'name' => $this->guardian_name,
                    'address' => $this->guardian_address,
                    'contact' => $this->guardian_contact,
                    'email' => $this->guardian_email,
                    'relation' => $this->guardian_relationship,
                ];
                $sy = SchoolYear::where('is_active', '=', 1)->first();
                $PDF = ExportController::forms($title, $this->eCopies, $this->payment_method, $st, $gt, $student, $guardian, $this->getStudentName());
                $this->isEFormDownloaded  = true;
                return response()->streamDownload(
                    fn () => print($PDF),
                    $title . '_form_' . $sy->name . '.pdf'
                );
            } catch (\Throwable $th) {
                dd($th);
            }
        }
        public function downloadPForm()
        {

            $title = 'payment';
            if ($this->new) {
                $st = 1;
            } elseif ($this->transferee) {
                $st = 3;
            }
            // if yung value ng grade level id ay between 1 - 3 pre school yun
            if ($this->grade_level_id >= 1 && $this->grade_level_id <= 4) {
                $gt = 1;
            }
            // if yung value ng grade level id ay between 4 - 9  thats Elementary
            if ($this->grade_level_id >= 5 && $this->grade_level_id <= 10) {
                $gt = 2;
            }
            // and if yung value ng grade level id ay between 10 - 13  Junior High School
            if ($this->grade_level_id >= 11 && $this->grade_level_id <= 14) {
                $gt = 3;
            }
            $student = [
                'id' => $this->sdbId,
                'lrn' => $this->student_lrn,
                'student_id' => $this->student_id,
                'last_name' => $this->last_name,
                'first_name' =>  $this->first_name,
                'mi' => Str::ucfirst(Str::substr($this->middle_name, 0, 1)),
                'address' => $this->address,
                'birth_date' => $this->birth_date,
                'birthplace' => $this->birthplace,
                'grade_level' => GradeLevel::where('id', '=', $this->grade_level_id)->first()->name,
            ];
            $guardian = [
                'name' => $this->guardian_name,
                'address' => $this->guardian_address,
                'contact' => $this->guardian_contact,
                'email' => $this->guardian_email,
                'relation' => $this->guardian_relationship,
            ];
            $sy = SchoolYear::where('is_active', '=', 1)->first();
            $PDF = ExportController::forms($title, $this->pCopies, $this->payment_method, $st, $gt, $student, $guardian, $this->getStudentName());
            $this->isFormDownloaded = true;
            return response()->streamDownload(
                fn () => print($PDF),
                $title . '_form_' . $sy->name . '.pdf'
            );
        }
        public function new()
        {
            $this->new = true;
            $this->isDoneSelectingStudentType = true;
            $this->increaseStep();
        }
        public function transferee()
        {
            $this->transferee = true;
            $this->isDoneSelectingStudentType = true;
            $this->increaseStep();
        }
        public function getAge()
        {
            return $this->age = Carbon::parse($this->birth_date)->diff(Carbon::now())->y;
        }
        public function getStudentId()
        {
            $student_count = Student::count();
            $this->student_id =  Carbon::now()->format('Y') . "-" . str_pad($student_count, 5, '0', STR_PAD_LEFT) . "-BCA-0";
            $variable = Student::all();
            foreach ($variable as $item) {
                if ($item->student_id == $this->student_id) {
                    $this->student_id =  Carbon::now()->format('Y') . "-" . str_pad($student_count + 1, 5, '0', STR_PAD_LEFT) . "-BCA-0";
                }
            }
        }
        public function getStudentType()
        {
            $type = "";
            if ($this->new) {
                $type = 'New Student';
            }
            if ($this->transferee) {
                $type = 'Transferee';
            }
            return $type;
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
        public function getPn()
        {
            if ($this->new) {
                if ($this->promissory_note == 1) {
                    return ($this->psa != null && $this->photo != null) ? 0 : (($this->photo != null) ? 1 : 0);
                } else {
                    return ($this->psa != null && $this->photo != null) ? 0 : 1;
                }
            }
            if ($this->transferee) {
                if ($this->promissory_note == 1) {
                    return ($this->psa != null && $this->form_137 != null && $this->good_moral != null && $this->photo != null) ? 0 : (($this->form_137 != null && $this->good_moral != null) ? 1 : 0);
                } else {
                    return ($this->psa != null && $this->form_137 != null && $this->good_moral != null && $this->photo != null) ? 0 : 1;
                }
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
        public function getStudentName()
        {
            return Str::ucfirst($this->first_name) . ' ' . Str::ucfirst(Str::substr($this->middle_name, 0, 1)) . ' ' . Str::ucfirst($this->last_name);
        }

        public function payment($path, $student_id)
        {
            $level_id = $this->getLevel($this->grade_level_id);
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

            $bal = Balance::create([
                'student_id' => $student_id,
                'amount' => $balance,
                'reminder_at' => $reminder_at,
                'created_at' => now(),
            ]);
            $payment = Payment::create([
                'student_id' => $student_id,
                'sy_id' => $current_sy->id,
                'grade_level_id' => $this->grade_level_id,
                'mop' => $this->conPayment,
                'payment_method' => $payment_method,
            ])->id;
            $paymentLog = PaymentLog::create([
                'student_id' => $student_id,
                'payment_id' => $payment,
                'created_by' => 'Created by Student upon enrollment',
                'created_at' => now(),
            ])->id;
            if ($this->conPayment == 'Bank Deposit') {
                if ($this->payment_proof != null) {
                    FileController::pop($path, $payment,  $this->payment_proof, $current_sy->name);
                }
            }
        }
        private function getTotalPayment()
        {
            $level_id = $this->getLevel($this->grade_level_id);
            $current_sy = SchoolYear::where('is_active', '=', 1)->first();
            $annuals = Annual::where('sy_id', '=', $current_sy->id)->where('level_id', '=', $level_id)->get();
            foreach ($annuals as $annual) {
                $this->total_payment += $annual->amount;
            }
        }
        public function registerStudent()
        {
            $this->validateData();
            $this->resetErrorBag();
            $name = $this->getStudentName();
            $pn = $this->getPn();
            //Get student Type
            $student_type = $this->getStudentType();
            //Get Student ID
            $this->getStudentId();
            //Get Age
            $this->getAge();
            $path = 'uploads/requirements/' . $name;

            $code = sha1(time() . $this->student_id);
            $recipient = $this->email;
            $sy = SchoolYear::where('is_active', '=', 1)->first();

            try {
                /* MailController::sendVerificationCodeMail($this->first_name, $recipient, $code); */
                $studentID = Student::create([
                    'student_id' => $this->student_id,
                    'student_lrn' => ($this->student_lrn == "") ? null : $this->student_lrn,
                    'first_name' => $this->first_name,
                    'middle_name' => $this->middle_name,
                    'last_name' => $this->last_name,
                    'ext_name' => $this->ext_name,
                    'gender' => $this->gender,
                    'age' =>  $this->age,
                    'email' => $this->email,
                    'birth_date' => $this->birth_date,
                    'birthplace' => $this->birthplace,
                    'address' => $this->address,
                    'grade_level_id' => $this->grade_level_id,
                    'student_type' => $student_type,
                    'department' => $this->getDepartment($this->grade_level_id),
                    'hasPromissoryNote' => $pn,
                    'enrollmentCompleted' => 1,
                    'sy_id' => $sy->id,
                    'status' => 'enrollee',
                    'created_at' => now(),
                ])->id;
                $this->sdbId = $studentID;
                FileController::requirements($path, $studentID, $this->psa, $this->form_137, $this->good_moral, $this->photo, $this->student_type, $this->promissory_note);
                VerificationCode::create([
                    'student_id' => $studentID,
                    'verification_code' => $code,
                    'date_sent' => now(),
                    'expiration_date' => now()->addDay(3),
                ]);
                EnrollmentLog::create([
                    'student_id' => $studentID,
                    'grade_level_id' => $this->grade_level_id,
                    'department' => $this->getDepartment($this->grade_level_id),
                    'sy_id' => $sy->id,
                    'student_type' => $student_type,
                    'created_at' => now(),
                ]);
                $this->payment($path, $studentID);
                $families = [
                    [
                        'student_id' => $studentID,
                        'name' => $this->father_name,
                        'birth_date' => $this->father_birthdate,
                        'email' => $this->father_email,
                        'landline' => $this->father_landline,
                        'contact_no' => $this->father_contact_no,
                        'occupation' => $this->father_occupation,
                        'office_address' => $this->father_office_address,
                        'office_contact_no' => $this->father_office_contact,
                        'relationship' => 'Father',
                        'relationship_type' => 'father',
                    ], [
                        'student_id' => $studentID,
                        'name' => $this->mother_name,
                        'birth_date' => $this->mother_birthdate,
                        'email' => $this->mother_email,
                        'landline' => $this->mother_landline,
                        'contact_no' => $this->mother_contact_no,
                        'occupation' => $this->mother_occupation,
                        'office_address' => $this->mother_office_address,
                        'office_contact_no' => $this->mother_office_contact,
                        'relationship' => 'Mother',
                        'relationship_type' => 'mother',
                    ], [
                        'student_id' => $studentID,
                        'name' => $this->guardian_name,
                        'contact_no' => $this->guardian_contact,
                        'address' => $this->guardian_address,
                        'email' => $this->guardian_email,
                        'relationship' => $this->guardian_relationship,
                        'relationship_type' => 'guardian',
                    ]
                ];

                foreach ($families as $family) {
                    FamilyMember::create($family);
                }


                $this->isDoneFillUp = true;
            } catch (\Throwable $th) {
                dd($th->getMessage(), 'Error T_T' . $this->sdbId);
                return back();
            }
        }
        public function render()
        {
            if (!$this->isDoneFillUp) {
                switch ($this->currentStep) {
                    case 1:
                        $this->currentTitle = "Student Information";
                        break;
                    case 2:
                        $this->currentTitle = "Parents Information";
                        break;
                    case 3:
                        $this->currentTitle = "Guardian Information";
                        break;
                    case 4:
                        $this->currentTitle = "Requirements";
                        break;
                    case 5:
                        $this->currentTitle = "Payment";
                        break;
                    default:

                        break;
                }
            }


             return view('livewire.frontend.enrollment-form');
        }
    }

