@extends('BCA.Backend.registrar-layouts.index')

@section('page-title')
    Dashboard
@endsection
@section('dashboard-css')
    <link rel="stylesheet" href="{{ asset('assets/packages/apexcharts-bundle/dist/apexcharts.css') }}">
@endsection
@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="{{ route('registrar.enrolled.index') }}" class="card-body link-primary text-decoration-none">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Enrolled Student</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enrolledCount }}</div>
                        </div>
                        <div class="col-auto ">

                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
                {{-- <div class="card-body">

            </div> --}}
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <a href="{{ route('registrar.enrollees.index') }}" class="card-body link-primary text-decoration-none">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Enrollee Students
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $enrolleeCount }}
                                    </div>
                                </div>
                                <div class="col">
                                    {{--   <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="{{ route('registrar.section.index') }}"
                    class="card-body link-primary text-decoration-none d-hover-primary">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Sections</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sectionCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-object-ungroup fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <a href="{{ route('registrar.teachers.index') }}" class="card-body link-primary text-decoration-none">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Teachers
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $teacherCount }}</div>
                                </div>
                                {{-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-5 col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    @php
                        $id = session()->get(Auth::id() . '_current_sy');
                        $currentSy = App\Models\SchoolYear::find($id)->school_year;
                    @endphp
                    <h6 class="m-0 font-weight-bold text-primary">Enrollees Sy: {{ $currentSy }}</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div style="height: 32rem;">
                        @if ($studentTypesBySchoolYear)
                            <livewire:livewire-pie-chart key="{{ $studentTypesBySchoolYear->reactiveKey() }}" :pie-chart-model="$studentTypesBySchoolYear" />
                        @else
                            <div class="alert alert-danger" role="alert">
                                No data available!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Unverified Emails</h6>
                    {{-- a a tag button for sending emails --}}
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                            <div class="dropdown-header">Actions:</div>
                            <a class="dropdown-item {{ count($unverifiedStudents) == 0 ? 'disabled' : '' }}" href="#">Send Verification Code</a>
                            <a class="dropdown-item" href="{{ route('registrar.accept.all.unverified.email') }}">Accept All Unverified Email</a>
                            {{-- <div class="dropdown-divider"></div> --}}
                            {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
                        </div>
                    </div>
                    {{-- <a href="{{ route('registrar.sendEmail') }}"
                        class="btn btn-outline-primary btn-sm ">Send
                        Verification Code</a> --}}
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="enrolled-table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Student LRN</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($unverifiedStudents as $student)
                                <tr>
                                    <td class="text-center">{{ $student->student_lrn }}</td>
                                    <td class="text-center">{{ ucfirst($student->first_name) }}
                                        {{ substr(ucfirst($student->middle_name), 0, 1) }},
                                        {{ ucfirst($student->last_name) }}</td>
                                    <td class="text-center">{{ $student->email }}</td>

                                </tr>
                            @empty
                                <tr class="odd ">
                                    <td valign="top" colspan="9" class="text-center dataTables_empty">No data
                                        available
                                        in table</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Enrollment by School Year</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div style="height: 32rem;">
                        @if ($enrollmentBySchoolYear)
                            <livewire:livewire-column-chart key="{{ $enrollmentBySchoolYear->reactiveKey() }}"
                                :column-chart-model="$enrollmentBySchoolYear" />
                        @else
                            <div class="alert alert-danger" role="alert">
                                No data available!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('dashboard-javascript')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <script src="{{ asset('assets/packages/apexcharts-bundle/dist/apexcharts.min.js') }}"></script>
    @livewireChartsScripts
@endsection
