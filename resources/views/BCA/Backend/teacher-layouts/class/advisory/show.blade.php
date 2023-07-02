@extends('BCA.Backend.teacher-layouts.index')
@section('page-title')
    Advisory Class
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">{{ $section->section_name }}</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <a href="{{ route('export.class.list', ['id' => $section->id]) }}" class="btn btn-outline-primary">
                    <span class="d-flex align-items-center">
                        <i class="fa-solid fa-file-pdf"></i>
                        &#160; Class list</span>
                </a>

            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="subject-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Student ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Grades</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
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
                                    @include('BCA.Backend.teacher-layouts.class.advisory.modal._show')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No students</td>
                            </tr>
                        @endforelse
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
            $('#subject-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
