<div>
    @if ($isEnrollment)
        @if ($isDone)
            <div class="card-body card-body bg-white shadow-sm rounded py-5 text-center">
                {{-- done enroll --}}
                <h5>You have already completed your enrollment; please wait for confirmation of your enrollment.</h5>
            </div>
        @else
            @if ($isDoneFillUp)
                @if ($isFormDownloaded)
                    <div class="card-body bg-white shadow-sm rounded py-5">
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
                            </div>
                        </div>

                    </div>
                @else
                    {{-- Download Forms --}}
                    <div class="card-body bg-white shadow-sm rounded py-5">
                        <div class="row  justify-content-center align-items-center p-5">
                            <div class="w-50 d-flex flex-column justify-content-center align-items-center">
                                <h3 class="text-center">Download Forms</h3>
                                <button class="btn btn-outline-bca mb-3" type="button" wire:loading.attr="disabled"
                                    wire:click='downloadEForm()'>
                                    <i class="fa-solid fa-download"></i>
                                    Download E-Form
                                </button>
                                <button class="btn btn-outline-bca mb-3 {{ $isEFormDownloaded ? '' : 'disabled' }}"
                                    type="button" wire:loading.attr="disabled" wire:click='downloadPForm()'>
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
                    <div class="card-body bg-white rounded-top rounded-right rounded-left shadow-sm">
                        <div
                            class="head d-flex justify-content-between align-items-center p-2 mb-3 bg-secondary rounded text-white">
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
                                    <div class="row mb-3">
                                        <div class="col-md-5 ">
                                            <label for="student_lrn" class="text-dark h5 font-weight-bold">Learner
                                                Reference
                                                Number(LRN)
                                            </label>
                                            <input class="form-control @error('student_lrn') is-invalid @enderror"
                                                type="number" name="student_lrn" id="student_lrn"
                                                placeholder="Ex. 123456789101" wire:model="student_lrn" max="12"
                                                maxlength="12">
                                            @error('student_lrn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-9">
                                            <h5><span class="text-dark font-weight-bold">Name:</span>
                                                {{ $student->first_name }}
                                                {{ $student->middle_name }}, {{ $student->last_name }}
                                                {{ $student->ext_name == null ? '' : $ext_name }}</h5>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <h5><span class="text-dark font-weight-bold">Gender:</span>
                                                {{ $student->gender }}
                                            </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5><span class="text-dark font-weight-bold">Age:</span>
                                                {{ $student->age }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h5><span class="text-dark font-weight-bold">Email:</span>
                                                {{ $student->email }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h5><span class="text-dark font-weight-bold">Birthdate:</span>
                                                {{ date('F d, Y', strtotime($student->birth_date)) }}</h5>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h5><span class="text-dark font-weight-bold">Birthplace:</span>
                                                {{ $student->birthplace }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h5><span class="text-dark font-weight-bold">Address:</span>
                                                {{ $student->address }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-9">
                                            <h5><span class="text-dark font-weight-bold">Grade
                                                    Level:</span>
                                                {{ $student->gradeLevel->grade_name }}</h5>
                                        </div>
                                    </div>
                                @break

                                @case(2)
                                    <div class="row">
                                        <div class="col-md-6 col-lg-7 me-lg-2 mb-3">
                                            <label for="form_138" class="text-dark h5 font-weight-bold">Form 138
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="file" id="form_138" name="form_138" wire:model="form_138"
                                                class="form-control @error('form_138') is-invalid @enderror" id="form_138">

                                            @error('form_138')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @break

                                @case(3)
                                    <div class="row">
                                        <div class="col-md-6 col-lg-8 me-lg-2 mb-3">
                                            <label for="payment_options" class="text-dark h5 font-weight-bold">Payment Options
                                                <span class="text-danger">*</span></label>
                                            <div class="ms-2">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input @error('payment_options') is-invalid @enderror"
                                                        name="payment_options" type="radio" value="Bank Deposit"
                                                        id="bank_deposit" wire:model="payment_options">
                                                    <label class="form-check-label  gender" for="bank_deposit">
                                                        Bank Deposit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input @error('payment_options') is-invalid @enderror"
                                                        name="payment_options" type="radio" value="Cash" id="cash"
                                                        wire:model="payment_options">
                                                    <label class="form-check-label gender" for="cash">
                                                        Cash
                                                    </label>
                                                    @error('payment_options')
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
                                                @if ($student->grade_level_id > 4)
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
                                    @if ($payment_options == 'Cash')
                                        <div class="row">
                                            <div class="col-md-10 me-lg-2 mb-3">
                                                <h5 class="card-title font-weight-bold">School Location:</h5>
                                                <span class="card-text">9006 Eagle Street Main Road, Area 3 SItio
                                                    Veterans,
                                                    Bagong SIlangan 1100 Quezon City, Philippines</span>
                                            </div>
                                        </div>
                                    @elseif ($payment_options == 'Bank Deposit')
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
                    <div class="card-footer bg-white rounded-bottom shadow-sm border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            @if ($currentStep == 1)
                                <div></div>
                            @endif
                            @if ($currentStep != 1 && $currentStep != 4)
                                <button type="button" class="btn btn-md btn-secondary" wire:loading.attr="disabled"
                                    wire:click="decreaseStep()">Back</button>
                            @endif
                            @if ($currentStep != 4)
                                <div wire:loading.delay class="bg-transparent">
                                    <img src="{{ asset('assets/img/icons8-loading-circle.gif') }}" width="20"
                                        height="20" class="m-auto">
                                </div>
                            @endif
                            @if ($currentStep != 3 && $currentStep != 4)
                                <button type="button" wire:loading.attr="disabled" class="btn btn-md btn-bca"
                                    wire:click="increaseStep()">Next</button>
                            @endif

                            @if ($currentStep == 3)
                                <button type="submit" wire:loading.attr="disabled" wire:submit
                                    class="btn btn-md btn-primary">
                                    Submit
                                </button>
                            @endif
                        </div>
                    </div>
                </form>


            @endif
        @endif
    @else
        <div class="container  px-0">
            <div class="card bg-transparent border-0">
                <div class="card-body bg-white shadow-sm h-100">
                    <div class="d-flex flex-column align-items-center justify-content-center p-lg-5">
                        <h1>
                            <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                        </h1>
                        <h5>We apologize, but the enrollment for the Sy {{ $currentSy->name }}
                            is not yet open.</h5>
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>
