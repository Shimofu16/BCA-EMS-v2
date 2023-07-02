@extends('BCA.Backend.teacher-layouts.index')
@section('page-title')
{{ $section->section_name }}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td> {{ $student->student_id }}</td>
                                <td>
                                    <div class="d-flex flex-column px-2 py-1">
                                        <h5 class="mb-0">
                                            {{ $student->last_name }},
                                            {{ $student->first_name }}
                                            {{ substr(ucfirst($student->middle_name), 0, 1) }}.
                                        </h5>
                                    </div>
                                </td>
                                <td> {{ $student->gender }}</td>
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
            $('#subject-table').DataTable({
                "ordering": false
                /* order: [
                    [1, 'asc']
                ] */
            });
        });
    </script>
@endsection
