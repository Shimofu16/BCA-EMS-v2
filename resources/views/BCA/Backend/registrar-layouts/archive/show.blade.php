@extends('BCA.Backend.registrar-layouts.index')

@section('page-title')
    Archive - {{ $isStudent == 1 ? 'Students' : 'Teachers' }}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end align-items-center">

            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="archive-table">
                    @if ($isStudent == 1)
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Student Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Age</th>
                                <th scope="col">Grade Level & Section</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
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
                                    <td>
                                        <div class="d-flex flex-column px-2 py-1">
                                            <h5 class="mb-0">
                                                {{ $student->gradeLevel->grade_name }}
                                            </h5>
                                            <p class="text-sm text-secondary mb-0">
                                                {{ $student->section->section_name }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-outline-primary btn-sm mr-1"
                                                data-toggle="modal" data-target="#edit{{ $student->id }}">
                                                <i class="fa fa-window-restore" aria-hidden="true"></i>
                                                Restore
                                            </button>
                                            @include('BCA.Backend.registrar-layouts.archive.modal._edit')

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Age</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col" class="text-center">Action</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column px-2 py-1">
                                            <h5 class="mb-0 text-sm">{{ $teacher->name }}
                                            </h5>
                                            <p class="text-sm text-secondary mb-0">
                                                {{ $teacher->email }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>{{ $teacher->gender }}</td>
                                    <td>{{ $teacher->age }}</td>
                                    <td>{{ $teacher->contact }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                data-target="#edit{{ $teacher->id }}">
                                                <i class="fa fa-window-restore" aria-hidden="true"></i>
                                                Restore
                                            </a>
                                            @include('BCA.Backend.registrar-layouts.archive.modal._edit')
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
@section('dashboard-javascript')
    {{-- bakit wala to pota --}}
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#archive-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
