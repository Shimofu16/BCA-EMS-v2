@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    {{ $section->name }}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.manage.grades.index', ['level_id' => $section->grade_level_id]) }}"
                    class="btn btn-outline-primary">
                    <span class="d-flex align-items-center"><i class="fa-solid fa-circle-arrow-left"></i>&#160;
                        Back
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="students-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Student ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Grades</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td> {{ $student->student_id }}</td>
                                <td>
                                    <div class="d-flex flex-column px-2 py-1">
                                        <h5 class="mb-0">{{ $student->first_name }}
                                            {{ substr(ucfirst($student->middle_name), 0, 1) }}, {{ $student->last_name }}
                                        </h5>
                                    </div>
                                </td>
                                <td> {{ $student->gender }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                        data-target="#show{{ $student->id }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Show
                                    </button>
                                    @include('BCA.Backend.admin-layouts.grades.modal._show')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('dashboard-javascript')
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#students-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
