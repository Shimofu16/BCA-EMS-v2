<div class="row">
    <div class="col-sm-3 col-md-3 mr-3 px-0">
        <div class="card  border shadow">
            <div class="card-header border-0 px-1 d-flex justify-content-center bg-white">
                @if ($hasFilePhoto)
                    @if ($studentPhoto)
                        <img src="{{ asset($studentPhoto->filepath) }}" alt="Student Photo ID"
                            class="img-student rounded-circle mb-3" />
                    @else
                        @if ($student->gender == 'Male')
                            <img src="{{ asset('assets/img/icons/user-male.png') }}" alt="Student Photo ID"
                                class="img-student rounded-circle mb-3" />
                        @elseif ($student->gender == 'Female')
                            <img src="{{ asset('assets/img/icons/user-female.png') }}" alt="Student Photo ID"
                                class="img-student rounded-circle mb-3" />
                        @endif
                    @endif
                @else
                    @if ($student->gender == 'Male')
                        <img src="{{ asset('assets/img/icons/user-male.png') }}" alt="Student Photo ID"
                            class="img-student rounded-circle mb-3" />
                    @elseif ($student->gender == 'Female')
                        <img src="{{ asset('assets/img/icons/user-female.png') }}" alt="Student Photo ID"
                            class="img-student rounded-circle mb-3" />
                    @endif
                @endif
            </div>
            <div class="card-body bg-transparent mt-0 px-0 pt-0 text-center">
                <h4 class="card-title font-weight-bold text-center">{{ ucfirst($student->first_name) }}
                    {{ substr(ucfirst($student->middle_name), 0, 1) }},
                    {{ ucfirst($student->last_name) }}</h4>
                <p class="card-text">{{ $student->email }}</p>

                <h5 class="card-title text-primary mb-0">Grade Level</h5>
                <p class="card-text ">{{ $student->gradeLevel->grade_name }}</p>
                <h5 class="card-title text-primary mb-0">School Year</h5>
                <p class="card-text ">{{ $student->sy->name }}</p>
                <h5 class="card-title text-primary mb-0">Status</h5>
                @if ($student->status == 1)
                    <p class="card-text ">Enrolled</p>
                @else
                    <p class="card-text ">Not Enrolled</p>
                @endif
            </div>
            <div class="card-footer text-center bg-white">
                <h3 class="text-primary">Action</h3>
                {{-- <button type="button" class="btn btn-primary mb-2 w-100" data-toggle="modal"
                    data-target="#requirements">Requirements</button> --}}
                @if ($student->status == 0)
                    <button type="button" class="btn btn-primary mb-2 w-100" data-toggle="modal"
                        data-target="#add{{ $student->id }}">Accept</button>

                    @include('BCA.Backend.registrar-layouts.students.enrollees.modal._create')
                    <a href="{{ route('registrar.enrollees.index') }}" class="btn btn-primary mb-2 w-100">Back</a>
                @else
                    @include('BCA.Backend.registrar-layouts.students.enrolled.modal._delete')
                    <button type="button" class="btn btn-primary mb-2 w-100" data-toggle="modal"
                        data-target="#delete{{ $student->id }}">Drop</button>
                    <a href="{{ route('registrar.enrolled.index') }}" class="btn btn-primary mb-2 w-100">Back</a>
                @endif
                {{-- @include('BCA.Backend.registrar-layouts.students.enrollees.modal._requirements') --}}
            </div>


        </div>
    </div>
    <div class="col-sm-6 col-md-8 bg-transparent px-0">
        <div class="card border shadow">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <button class="nav-link {{ $left == 1 ? 'active' : 'bg-transparent' }}" wire:click='moveLeft'
                            type="button">Student</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link {{ $center == 1 ? 'active' : 'bg-transparent' }}"
                            wire:click='moveCenter' type="button">Parents</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link {{ $right == 1 ? 'active' : 'bg-transparent' }}" wire:click='moveRight'
                            type="button">Guardian</button>
                    </li>
                    @if ($student->status == 1)
                        <li class="nav-item">
                            <button class="nav-link {{ $gradetable == 1 ? 'active' : 'bg-transparent' }}"
                                wire:click='moveToGrades' type="button">Grades</button>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                @if ($left == 1)
                    <div class="tab-pane row active">
                        <div class="col">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <h4 class="text-primary font-weight-bold text-center">Student Information
                                            </h4>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="font-weight-bold">Student LRN:</h5>
                                        </td>
                                        <td>
                                            <h5 class="">{{ $student->student_lrn }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Student ID:</h5>
                                        </td>
                                        <td>
                                            <h5 class="">{{ $student->student_id }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">First name:</h5>
                                        </td>
                                        <td>
                                            <h5 class="">{{ ucfirst($student->first_name) }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Middle name:</h5>
                                        </td>
                                        <td>
                                            <h5 class="">{{ ucfirst($student->middle_name) }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Last name:</h5>
                                        </td>
                                        <td>
                                            <h5 class="">{{ ucfirst($student->last_name) }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Extra name:</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-text">{{ ucfirst($student->ext_name) }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Age:</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-text">{{ $student->age }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Gender:</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-text">{{ ucfirst($student->gender) }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Birth date:</h5>
                                        </td>
                                        <td>
                                            @if (date('m/d/Y', strtotime($student->birth_date)) == Carbon\Carbon::now()->format('m/d/Y'))
                                                <h5 class="card-text">
                                                    {{ date('F d, Y', strtotime($student->birth_date)) }}
                                                    <i class="fa-solid fa-cake-candles text-primary"></i>
                                                </h5>
                                            @else
                                                <h5 class="card-text">
                                                    {{ date('F d, Y', strtotime($student->birth_date)) }}
                                                </h5>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Email:</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-text">{{ $student->email }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Address:</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-text">{{ $student->address }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class=" font-weight-bold">Birtplace:</h5>
                                        </td>
                                        <td>
                                            <h5 class="card-text">{{ $student->birthplace }}</h5>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            @if ($student->status == 1)
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <h4 class="text-primary font-weight-bold">Other Information
                                                </h4>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5 class=" font-weight-bold">Section:</h5>
                                            </td>
                                            <td>
                                                <h5 class="">{{ $student->section->section_name }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class=" font-weight-bold">Grade Level:</h5>
                                            </td>
                                            <td>
                                                <h5 class="">{{ $student->gradeLevel->grade_name }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class=" font-weight-bold">Department:</h5>
                                            </td>
                                            <td>
                                                <h5 class="">{{ $student->department }}</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                @endif
                @if ($center == 1)
                    <div class="tab-pane active">
                        {{-- father information --}}
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <h4 class="text-primary font-weight-bold">Father Information</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Name:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($father->name) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Birth date:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ date('F d, Y', strtotime($father->birth_date)) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Landline:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $father->landline }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Contact number:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $father->contact_no }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Email:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $father->email }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Address:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($father->address) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Occupation:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($father->occupation) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Office Address:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $father->office_address }}</h5>
                                    </td>
                                </tr>
                        </table>
                        <hr>
                        {{-- mother information --}}
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <h4 class="text-primary font-weight-bold">Mother Information</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Name:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($mother->name) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Birth date:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ date('F d, Y', strtotime($mother->birth_date)) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Landline:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $mother->landline }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Contact number:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $mother->contact_no }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Email:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $mother->email }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Address:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($mother->address) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Occupation:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($mother->occupation) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Office Address:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $mother->office_address }}</h5>
                                    </td>
                                </tr>
                        </table>
                    </div>
                @endif
                @if ($right == 1)
                    <div class="tab-pane  active">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <h4 class="text-primary font-weight-bold">Guardian Information</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Name:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($guardian->name) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Birth date:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ date('F d, Y', strtotime($guardian->birth_date)) }}
                                        </h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Landline:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $guardian->landline }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Contact number:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $guardian->contact_no }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Email:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ $guardian->email }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Address:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($guardian->address) }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="card-text font-weight-bold">Relationship:</h5>
                                    </td>
                                    <td>
                                        <h5 class="card-text">{{ ucfirst($guardian->relationship) }}</h5>
                                    </td>
                                </tr>
                        </table>
                    </div>
                @endif
                @if ($student->status == 1)
                    @if ($gradetable == 1)
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <div class="row mb-3">
                                        <div class="col">

                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('export.grade', ['id' => $student->id, 'sy_id' => $student->sy_id, 'isStudent' => 0]) }}"
                                                    class="btn btn-outline-primary">Download</a>
                                            </div>

                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover pb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th></th>
                                                <th scope="rowgroup" colspan="4" class="text-center">Quarterly
                                                    Progress Report</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th scope="rowgroup" colspan="4" class="text-center">Rating Period
                                                </th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">Subject</th>
                                                <th scope="rowgroup" class="text-center">1</th>
                                                <th scope="rowgroup" class="text-center">2</th>
                                                <th scope="rowgroup" class="text-center">3</th>
                                                <th scope="rowgroup" class="text-center">4</th>
                                                <th scope="col" class="text-center">Final Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($grades as $grade)
                                                <tr>
                                                    <td>
                                                        {{ $grade->class->subject->subject }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $grade->first_grading }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $grade->second_grading }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $grade->third_grading }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $grade->fourth_grading }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if (round($grade->final_grade) != 0)
                                                            {{ round($grade->final_grade) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        No grades yet.
                                                    </td>
                                                </tr>
                                            @endforelse
                                            <tr>
                                                <td colspan="6">
                                                    <div class="row">
                                                        <h5 class="text-right pr-5">General
                                                            Average: {{ round($average) != 0 ? round($average) : '' }}
                                                        </h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
