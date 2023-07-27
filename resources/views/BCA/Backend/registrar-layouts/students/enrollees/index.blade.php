@extends('BCA.Backend.registrar-layouts.index')


@section('page-title')
    Enrollee Students
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3 ">
        <div class="col-12">
            <div class="table-responsive">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <a class="btn mr-1 btn-outline-danger" href="{{ route('registrar.enrollees.index') }}">
                        <i class="fa-solid fa-rotate-right"></i> Reset
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                            Grade Level
                        </button>
                        <div class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton">
                            @foreach ($gradeLevels as $level)
                                <a class="dropdown-item {{ request()->level_id == $level->id ? 'active' : '' }}"
                                    href="{{ route('registrar.enrollees.index', ['level_id' => $level->id]) }}">{{ $level->display_name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-hover" id="enrollee-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Student Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Grade Level</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>
                                    <div class="d-flex flex-column px-2 py-1">
                                        <h5 class="mb-0">
                                            {{ ucfirst($student->last_name) }},
                                            {{ ucfirst($student->first_name) }}
                                            {{ ucfirst($student->middle_name) }}
                                        </h5>
                                        <p class="text-sm text-secondary mb-0">
                                            {{ $student->email }}
                                        </p>
                                    </div>
                                </td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->age }}</td>
                                <td>{{ $student->gradeLevel->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-success btn-sm mr-1"
                                            data-toggle="modal" data-target="#add{{ $student->id }}">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                            Accept
                                        </button>
                                        @include('BCA.Backend.registrar-layouts.students.enrollees.modal._create')
                                        <a href="{{ route('registrar.enrollees.show', $student->id) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            view
                                        </a>

                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h5 class="text-secondary">No Student found</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('dashboard-javascript')
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#enrollee-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
