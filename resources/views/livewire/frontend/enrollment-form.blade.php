<div>
    @if ($isEnrollment)
        @if ($isDoneSelectingStudentType)
            @if ($isDoneFillUp)
                @if ($isFormDownloaded)
                    <div class="card-body bg-white shadow rounded py-5">
                        <div class="row  justify-content-center align-items-center p-5">
                            <div class=" d-flex flex-column justify-content-center align-items-center">
                                <div class="success-checkmark">
                                    <div class="check-icon">
                                        <span class="icon-line line-tip"></span>
                                        <span class="icon-line line-long"></span>
                                        <div class="icon-circle"></div>
                                        <div class="icon-fix"></div>
                                    </div>
                                </div>
                                <h4 class="card-title">Thank you for completing the enrollment process!</h4>
                                <p class="card-text text-center text-justify">The next step is to verify your email
                                    address. Please
                                    check your Gmail account for a verification email, and follow the instructions in
                                    the email to complete the verification process.</p>
                                <a href="https://gmail.com/" class="btn btn-bca mb-1" target="__blank">
                                    <i class="fa-solid fa-envelope"></i>
                                    Google Mail
                                </a>
                                <hr class="w-50">
                                <a href="{{ route('home.index') }}" class="btn btn-outline-bca mb-1"
                                    wire:loading.attr="disabled">
                                    <i class="fa-solid fa-house"></i>
                                    Home
                                </a>
                            </div>
                        </div>

                    </div>
                @else
                    {{-- Download Forms --}}
                    <div class="card-body bg-white shadow rounded py-5">
                        <div class="row  justify-content-center align-items-center p-5">
                            <div class="w-50 d-flex flex-column justify-content-center align-items-center">
                                <h3 class="text-center">Download Forms</h3>
                                <button class="btn btn-outline-bca mb-3 " type="button" wire:click='downloadEForm()'
                                    wire:loading.attr="disabled">
                                    <i class="fa-solid fa-download"></i>
                                    Download E-Form
                                </button>
                                <button class="btn btn-outline-bca mb-3 {{ $isEFormDownloaded ? '' : 'disabled' }}"
                                    type="button" wire:click='downloadPForm()' wire:loading.attr="disabled">
                                    <i class="fa-solid fa-download"></i>
                                    Download P-Form
                                </button>
                                <div wire:loading>
                                    <div class="spinner-border text-bca" role="status">
                                        <span class="sr-only">downloading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <form wire:submit.prevent="registerStudent">
                    <div class="card-body bg-light rounded-top rounded-right rounded-left shadow ">
                        <div
                            class="head d-flex justify-content-between align-items-center p-2 mb-2 bg-secondary rounded text-white">
                            <div class="text-left border rounded p-2 "> {{ $currentStep }}/{{ $totalSteps }}
                            </div>
                            <div class="w-100  text-center">
                                <span class="fw-bold">{{ $currentTitle }}</span>
                            </div>
                            <div class="text-left  rounded p-2 text-secondary">
                                {{ $currentStep }}/{{ $totalSteps }}
                            </div>
                        </div>
                        <div class="body">
                            @switch($currentStep)
                                @case(1)
                                    <div class="row">
                                        <div class="col-md-9 col-lg-6 mb-3">
                                            <label for="student_lrn" class="text-dark h5 font-weight-bold">Learner
                                                Reference
                                                Number(LRN)@if ($grade_level_id >= 5)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input class="form-control @error('student_lrn') is-invalid @enderror"
                                                type="number" name="student_lrn" id="student_lrn"
                                                placeholder="Ex. 123456789101" wire:model="student_lrn" max="12">
                                            @error('student_lrn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 mb-3 me-lg-2">
                                            <label for="first_name" class="text-dark h5 font-weight-bold">First name <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('first_name') is-invalid @enderror" type="text"
                                                name="first_name" id="first_name" placeholder="Ex. Juan"
                                                wire:model="first_name">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-9 col-lg-5 mb-3 me-lg-2">
                                            <label for="middle_name" class="text-dark h5 font-weight-bold">Middle name
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control @error('middle_name') is-invalid @enderror"
                                                type="text" name="middle_name" id="middle_name" placeholder="Ex. Santos"
                                                wire:model="middle_name">
                                            @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 mb-3 me-lg-2">
                                            <label for="last_name" class="text-dark h5 font-weight-bold">Last name <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('last_name') is-invalid @enderror" type="text"
                                                name="last_name" id="last_name" placeholder="Ex. Dela Cruz"
                                                wire:model="last_name">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3 me-lg-2">
                                            <label for="ext_name" class="text-dark h5 font-weight-bold">Ext. name</label>
                                            <input class="form-control @error('ext_name') is-invalid @enderror" type="text"
                                                name="ext_name" id="ext_name" placeholder="Ex. Jr." wire:model="ext_name">
                                            @error('ext_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-lg-3 mb-3 me-lg-2">
                                            <label for="Male" class="text-dark h5 font-weight-bold">Gender <span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <label for="male"
                                                    class="radio-inline py-2 mr-1 gender @error('gender') is-invalid @enderror"><input
                                                        type="radio" class="" name="gender" id="male"
                                                        value="Male" wire:model="gender">
                                                    Male</label>
                                                <label for="female"
                                                    class="radio-inline py-2 mr-1 gender @error('gender') is-invalid @enderror"><input
                                                        type="radio" class="" name="gender" id="female"
                                                        value="Female" wire:model="gender">
                                                    Female</label>

                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 mb-3 me-lg-2">
                                            <label for="birth_date" class="text-dark h5 font-weight-bold">Birthdate <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('birth_date') is-invalid @enderror"
                                                type="date" name="birth_date" id="birth_date" placeholder="birth_date"
                                                wire:model="birth_date">
                                            @error('birth_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 mb-3 me-lg-2">
                                            <label for="email" class="text-dark h5 font-weight-bold">Email <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                                name="email" id="email" placeholder="Ex. student@email.com"
                                                wire:model="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 mb-3 me-lg-2">
                                            <label for="birthplace" class="text-dark h5 font-weight-bold">Birthplace <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('birthplace') is-invalid @enderror"
                                                type="text" name="birthplace" id="birthplace"
                                                placeholder="Ex. Quezon City" wire:model="birthplace">
                                            @error('birthplace')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="address" class="text-dark h5 font-weight-bold">Address <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('address') is-invalid @enderror" type="text"
                                                name="address" id="address" placeholder="Ex. Quezon City"
                                                wire:model="address">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7 col-lg-5">
                                            <label for="grade_level_id " class="text-dark h5 font-weight-bold">Grade Level
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="grade_level_id" id="grade_level_id "
                                                class="form-control @error('grade_level_id') is-invalid @enderror"
                                                wire:model="grade_level_id" required>
                                                <option selected value="">--- Select grade level ---
                                                </option>
                                                @foreach ($levels as $level)
                                                    <option value="{{ $level->id }}">
                                                        {{ $level->display_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('grade_level_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @break

                                @case(2)
                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 mb-3 me-lg-2">
                                            <label for="father_name" class="text-dark h5 font-weight-bold">Father Full
                                                name <span class="text-danger">*</span></label>
                                            <input class="form-control @error('father_name') is-invalid @enderror"
                                                type="text" name="father_name" id="father_name"
                                                placeholder="Ex. Juan G. Dela Cruz Sr." wire:model="father_name">
                                            @error('father_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4 me-lg-2 mb-3">
                                            <label for="father_birthdate" class="text-dark h5 font-weight-bold">Birthdate
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control @error('father_birthdate') is-invalid @enderror"
                                                type="date" name="father_birthdate" id="father_birthdate"
                                                wire:model="father_birthdate">
                                            @error('father_birthdate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <p class="form-text text-muted">Fill up your preferred contact
                                        method.
                                    </p>
                                    <div class="row mb-3">
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="father_email" class="text-dark h5 font-weight-bold">Email</label>
                                            <input class="form-control @error('father_email') is-invalid @enderror"
                                                type="text" name="father_email" id="father_email"
                                                placeholder="Ex. jCruz@gmail.com" wire:model="father_email">
                                            @error('father_email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-9 col-lg-5 me-lg-2 ">
                                            <label for="father_landline"
                                                class="text-dark h5 font-weight-bold">Landline</label>
                                            <input class="form-control @error('father_landline') is-invalid @enderror"
                                                type="text" name="father_landline" id="father_landline"
                                                wire:model="father_landline" maxlength="10">
                                            @error('father_landline')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-9 col-lg-5 me-lg-2 ">
                                            <label for="father_contact_no" class="text-dark h5 font-weight-bold">Contact
                                                no. <span class="text-danger">*</span></label>
                                            <input class="form-control @error('father_contact_no') is-invalid @enderror"
                                                type="text" name="father_contact_no" id="father_contact_no"
                                                wire:model="father_contact_no" maxlength="11">
                                            @error('father_contact_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="father_occupation" class="text-dark h5 font-weight-bold">Occupation
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control @error('father_occupation') is-invalid @enderror"
                                                type="text" name="father_occupation" id="father_occupation"
                                                wire:model="father_occupation">
                                            @error('father_occupation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="father_office_address" class="text-dark h5 font-weight-bold">Office
                                                address</label>
                                            <input class="form-control @error('father_office_address') is-invalid @enderror"
                                                type="text" name="father_office_address" id="father_office_address"
                                                wire:model="father_office_address" maxlength="11">
                                            @error('father_office_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="father_office_contact" class="text-dark h5 font-weight-bold">Office
                                                Contact
                                                no.</label>
                                            <input class="form-control @error('father_office_contact') is-invalid @enderror"
                                                type="text" name="father_office_contact" id="father_office_contact"
                                                wire:model="father_office_contact" maxlength="11">
                                            @error('father_office_contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr class="shadow">
                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 mb-3 me-lg-2">
                                            <label for="mother_name" class="text-dark h5 font-weight-bold">Mother Full
                                                name <span class="text-danger">*</span></label>
                                            <input class="form-control @error('mother_name') is-invalid @enderror"
                                                type="text" name="mother_name" id="mother_name"
                                                placeholder="Ex. Juan G. Dela Cruz" wire:model="mother_name">
                                            @error('mother_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4 me-lg-2 mb-3">
                                            <label for="mother_birthdate" class="text-dark h5 font-weight-bold">Birthdate
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control @error('mother_birthdate') is-invalid @enderror"
                                                type="date" name="mother_birthdate" id="mother_birthdate"
                                                wire:model="mother_birthdate">
                                            @error('mother_birthdate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <p class="form-text text-muted">Fill up your preferred contact
                                        method.
                                    </p>
                                    <div class="row mb-3">
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="mother_email" class="text-dark h5 font-weight-bold">Email</label>
                                            <input class="form-control @error('mother_email') is-invalid @enderror"
                                                type="text" name="mother_email" id="mother_email"
                                                wire:model="mother_email">
                                            @error('mother_email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="mother_landline"
                                                class="text-dark h5 font-weight-bold">Landline</label>
                                            <input class="form-control @error('mother_landline') is-invalid @enderror"
                                                type="text" name="mother_landline" id="mother_landline"
                                                wire:model="mother_landline" maxlength="10">
                                            @error('mother_landline')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="mother_contact_no" class="text-dark h5 font-weight-bold">Contact
                                                no. <span class="text-danger">*</span></label>
                                            <input class="form-control @error('mother_contact_no') is-invalid @enderror"
                                                type="text" name="mother_contact_no" id="mother_contact_no"
                                                wire:model="mother_contact_no" maxlength="11">
                                            @error('mother_contact_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="mother_occupation" class="text-dark h5 font-weight-bold">Occupation
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control @error('mother_occupation') is-invalid @enderror"
                                                type="text" name="mother_occupation" id="mother_occupation"
                                                wire:model="mother_occupation">
                                            @error('mother_occupation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="mother_office_address" class="text-dark h5 font-weight-bold">Office
                                                address</label>
                                            <input class="form-control @error('mother_office_address') is-invalid @enderror"
                                                type="text" name="mother_office_address" id="mother_office_address"
                                                wire:model="mother_office_address">
                                            @error('mother_office_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-9 col-lg-5 me-lg-2 mb-3">
                                            <label for="mother_office_contact" class="text-dark h5 font-weight-bold">Office
                                                Contact
                                                no.</label>
                                            <input class="form-control @error('mother_office_contact') is-invalid @enderror"
                                                type="text" name="mother_office_contact" id="mother_office_contact"
                                                wire:model="mother_office_contact" maxlength="11">
                                            @error('mother_office_contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @break

                                @case(3)
                                    <div class="row">
                                        <div class="col-md-5 me-lg-2 mb-3">
                                            <label for="guardian_name" class="text-dark h5 font-weight-bold">Full name
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control @error('guardian_name') is-invalid @enderror"
                                                type="text" name="guardian_name" id="guardian_name"
                                                placeholder="Ex. Maria S. Dela Cruz" wire:model="guardian_name">
                                            @error('guardian_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 me-lg-2 mb-3">
                                            <label for="guardian_contact" class="text-dark h5 font-weight-bold">Contact
                                                No.
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input class="form-control @error('guardian_contact') is-invalid @enderror"
                                                type="text" name="guardian_contact" id="guardian_contact"
                                                wire:model="guardian_contact" maxlength="11">
                                            @error('guardian_contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5 me-lg-2 mb-3">
                                            <label for="guardian_email" class="text-dark h5 font-weight-bold">Email <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('guardian_email') is-invalid @enderror"
                                                type="text" name="guardian_email" id="guardian_email"
                                                wire:model="guardian_email">
                                            @error('guardian_email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7 me-lg-2 mb-3">
                                            <label for="guardian_address" class="text-dark h5 font-weight-bold">Address
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control @error('guardian_address') is-invalid @enderror"
                                                type="text" name="guardian_address" id="guardian_address"
                                                wire:model="guardian_address">
                                            @error('guardian_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 me-lg-2 mb-3">
                                            <label for="guardian_relationship"
                                                class="text-dark h5 font-weight-bold">Relationship
                                                to learner <span class="text-danger">*</span></label>
                                            <input class="form-control @error('guardian_relationship') is-invalid @enderror"
                                                type="text" name="guardian_relationship" id="guardian_relationship"
                                                wire:model="guardian_relationship">
                                            @error('guardian_relationship')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @break

                                @case(4)
                                    <div class="row">
                                        <div class="col-md-6 col-lg-7 me-lg-2 mb-3">
                                            <label for="psa" class="text-dark h5 font-weight-bold">Birth Certificate
                                                @if ($transferee || $new)
                                                    @if ($promissory_note == 0)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                @endif
                                            </label>
                                            <input type="file" id="psa" name="psa" wire:model="psa"
                                                class="form-control @error('psa') is-invalid @enderror" id="psa">

                                            @error('psa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if ($transferee)
                                        <div class="row">
                                            <div class="col-md-6 col-lg-7 me-lg-2 mb-3">
                                                <label for="form_137" class="text-dark h5 font-weight-bold">Form 138
                                                    (previous
                                                    school)<span class="text-danger">*</span>
                                                </label>
                                                <input type="file" id="form_137" name="form_137" wire:model="form_137"
                                                    class="form-control @error('form_137') is-invalid @enderror"
                                                    id="form_137">

                                                @error('form_137')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-7 me-lg-2 mb-3">
                                                <label for="good_moral" class="text-dark h5 font-weight-bold">Good Moral
                                                    Certification <span class="text-danger">*</span>
                                                </label>
                                                <input type="file" id="good_moral" name="good_moral"
                                                    wire:model="good_moral"
                                                    class="form-control @error('good_moral') is-invalid @enderror"
                                                    id="good_moral">

                                                @error('good_moral')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6 col-lg-7 me-lg-2 mb-3">
                                            <label for="photo" class="text-dark h5 font-weight-bold">1x1 Photo ID
                                                @if ($transferee)
                                                    @if ($promissory_note == 0)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                @endif
                                                @if ($new)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <input type="file" id="photo" name="photo" wire:model="photo"
                                                class="form-control @error('photo') is-invalid @enderror" id="photo">
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="promissory_note" class="gender text-dark h6 font-weight-bold"><input
                                                type="checkbox" name="promissory_note" id="promissory_note"
                                                wire:model="promissory_note" value="1"
                                                {{ $promissory_note == 1 ? 'checked' : '' }}> If your document is not yet
                                            available, check this.</label>
                                    </div>
                                @break

                                @case(5)
                                    <div class="row">
                                        <div class="col-md-6 col-lg-8 me-lg-2 mb-3">
                                            <label for="conPayment" class="text-dark h5 font-weight-bold">Payment Options
                                                <span class="text-danger">*</span></label>
                                            <div class="ms-2">
                                                <div class="form-check">
                                                    <input class="form-check-input @error('conPayment') is-invalid @enderror"
                                                        name="conPayment" type="radio" value="Bank Deposit"
                                                        id="bank_deposit" wire:model="conPayment">
                                                    <label class="form-check-label  gender" for="bank_deposit">
                                                        Bank Deposit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input @error('conPayment') is-invalid @enderror"
                                                        name="conPayment" type="radio" value="Cash" id="cash"
                                                        wire:model="conPayment">
                                                    <label class="form-check-label gender" for="cash">
                                                        Cash
                                                    </label>
                                                    @error('conPayment')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-lg-5 me-lg-2 mb-3">
                                            <label for="payment_method" class="text-dark h5 font-weight-bold">Payment
                                                Method <span class="text-danger">*</span>
                                            </label>
                                            <div class="ms-2">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input @error('payment_method') is-invalid @enderror"
                                                        name="payment_method" type="radio" value="1"
                                                        id="annual_payment" wire:model="payment_method">
                                                    <label class="form-check-label  gender" for="annual_payment">
                                                        Annual
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input @error('payment_method') is-invalid @enderror"
                                                        name="payment_method" type="radio" value="2"
                                                        id="semiannual_payment" wire:model="payment_method">
                                                    <label class="form-check-label  gender" for="semiannual_payment">
                                                        Semi-Annual
                                                    </label>
                                                </div>
                                                @if ($grade_level_id > 4)
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input @error('payment_method') is-invalid @enderror"
                                                            name="payment_method" type="radio" value="3"
                                                            id="quarterly" wire:model="payment_method">
                                                        <label class="form-check-label gender" for="quarterly">
                                                            Quarterly
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input @error('payment_method') is-invalid @enderror"
                                                            name="payment_method" type="radio" value="4"
                                                            id="monthly" wire:model="payment_method">
                                                        <label class="form-check-label gender" for="monthly">
                                                            Monthly
                                                        </label>
                                                        @error('payment_method')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($payment_method)
                                            <div class="col-md-5 me-lg-2 mb-3">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Schedule of Payment</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @switch($payment_method)
                                                            @case(1)
                                                                @php
                                                                    $total_fee = 0;
                                                                    $sub_total = 0;
                                                                    $sub_total = $total_payment;
                                                                    $date = now();
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        <span class="font-weight-bold">Annual Payment</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="font-weight-bold">₱
                                                                            {{ number_format($sub_total, 2, '.', ',') }}</span>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    /* compute annualy */
                                                                    $total_fee = $sub_total;
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        Enrollment Fee
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}

                                                                    </td>
                                                                </tr>
                                                            @break

                                                            @case(2)
                                                                @php
                                                                    $total_fee = 0;
                                                                    $sub_total = 0;
                                                                    $sub_total = $total_payment;
                                                                    $date = now();
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        <span class="font-weight-bold">Semi Annual Payment</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="font-weight-bold">₱
                                                                            {{ number_format($sub_total, 2, '.', ',') }}</span>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $total_fee = $sub_total / 2;
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        Enrollment Fee
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 6 months  --}}
                                                                        @php
                                                                            $date->addMonths(6);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                            @break

                                                            @case(3)
                                                                @php
                                                                    $total_fee = 0;
                                                                    $sub_total = 0;
                                                                    $sub_total = $total_payment;
                                                                    $date = now();
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        <span class="font-weight-bold">Quarterly Payment</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="font-weight-bold">₱
                                                                            {{ number_format($sub_total, 2, '.', ',') }}</span>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $ef = 5500;
                                                                    $sub_total = $sub_total - $ef;
                                                                    $total_fee = $sub_total / 4;
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        Enrollment Fee
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($ef, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        {{-- add 4 months  --}}
                                                                        @php
                                                                            $date->addMonth(4);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 4 months  --}}
                                                                        @php
                                                                            $date->addMonth(4);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 4 months  --}}
                                                                        @php
                                                                            $date->addMonth(4);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                            @break

                                                            @case(4)
                                                                @php
                                                                    $total_fee = 0;
                                                                    $sub_total = 0;
                                                                    $sub_total = $total_payment;
                                                                    $date = now();
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        <span class="font-weight-bold">Monthly Payment</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="font-weight-bold">₱
                                                                            {{ number_format($sub_total, 2, '.', ',') }}</span>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $ef = 5500;
                                                                    $sub_total = $sub_total - $ef;
                                                                    $total_fee = $sub_total / 10;
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        Enrollment Fee
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($ef, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{-- add 1 months  --}}
                                                                        @php
                                                                            $date->addMonth(1);
                                                                        @endphp
                                                                        {{ date('F d, Y', strtotime($date)) }}
                                                                    </td>
                                                                    <td>
                                                                        ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                            @break

                                                            @default
                                                        @endswitch
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif

                                    </div>
                                    @if ($conPayment == 'Cash')
                                        <div class="row">
                                            <div class="col-md-10 me-lg-2 mb-3">
                                                <h5 class="card-title font-weight-bold">School Location:</h5>
                                                <span class="card-text">9006 Eagle Street Main Road, Area 3 SItio Veterans,
                                                    Bagong SIlangan 1100 Quezon City, Philippines</span>
                                            </div>
                                        </div>
                                    @elseif ($conPayment == 'Bank Deposit')
                                        <div class="row">
                                            @foreach ($accounts as $account)
                                                <div class="col-md-4 me-lg-2 mb-3">
                                                    <h5 class="card-title font-weight-bold"> Bank Information</h5>
                                                    <span class="card-title">{{ $account->bank_name }}</span> <br>
                                                    <span class="card-title">{{ $account->account_name }}</span> <br>
                                                    <span class="card-text">{{ $account->account_number }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-lg-5 me-lg-2 mb-3">
                                                <label for="payment_proof" class="text-dark h5 font-weight-bold">Proof of
                                                    Payment <span class="text-danger">*</span></label>
                                                <input type="file" id="payment_proof" name="payment_proof"
                                                    wire:model="payment_proof"
                                                    class="form-control @error('payment_proof') is-invalid @enderror"
                                                    id="payment_proof">
                                                @error('payment_proof')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                @break

                                @default
                            @endswitch
                        </div>
                    </div>
                    <div class="card-footer bg-light rounded-bottom shadow border-top">
                        @if ($currentStep !== 0 || $currentStep !== $totalSteps)
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($currentStep == 1)
                                    <div></div>
                                @endif

                                @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4 || $currentStep == 5)
                                    <button type="button" class="btn btn-md  btn-secondary"
                                        wire:click="decreaseStep()" wire:loading.attr="disabled">Back</button>
                                @endif
                                <div wire:loading.delay class="bg-transparent">
                                    <img src="{{ asset('assets/img/icons8-loading-circle.gif') }}" width="20"
                                        height="20">
                                </div>
                                @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3 || $currentStep == 4)
                                    <button type="button" class="btn btn-md btn-bca" wire:click="increaseStep()"
                                        wire:loading.attr="disabled">Next</button>
                                @endif

                                @if ($currentStep == $totalSteps)
                                    <button type="submit" class="btn btn-md btn-bca" wire:submit
                                        wire:loading.attr="disabled">
                                        Submit
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </form>
            @endif
        @else
            <div class="card-body py-5 bg-light rounded shadow">
                <div class="row  justify-content-center align-items-center">
                    <div class=" d-flex flex-column justify-content-center align-items-center">
                        <h4 class="mb-3">
                            <span> Choose student type below.</span>
                            <i class="fa-solid fa-arrow-down"></i>
                        </h4>

                        <button type="button" wire:loading.attr="disabled" wire:click="new()"
                            class="btn btn-bca mb-2 w-50">New
                            Student</button>
                        <button type="button" wire:loading.attr="disabled" wire:click="transferee()"
                            class="btn btn-bca mb-2 w-50">Transferee</button>
                        <a href="{{ route('portals.show', ['role' => 'Student']) }}" wire:loading.attr="disabled"
                            class="btn btn-bca mb-2 w-50">Old
                            Student</a>
                        <hr class="w-50">
                        <a href="{{ route('home.index') }}" wire:loading.attr="disabled"
                            class="btn btn-sm btn-outline-bca">
                            <i class="fa-solid fa-house"></i>
                            Home
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="card-body bg-light rounded shadow h-100">
            <div class="d-flex flex-column align-items-center justify-content-center p-lg-5">
                <h1>
                    <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                </h1>
                <h5>We apologize, but the enrollment for the Sy {{ $currentSy }}
                    is not yet open.</h5>
                <a href="{{ route('home.index') }}" wire:loading.attr="disabled" class="btn btn-bca mt-3"><i
                        class="fa-solid fa-house"></i>
                    Home</a>
            </div>
        </div>
    @endif
</div>
