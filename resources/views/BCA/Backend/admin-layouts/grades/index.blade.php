@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    Sections {{ request()->level_id != null ? 'in ' . $gradeLevels->find(request()->level_id)->grade_name : '' }}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">

        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <a class="btn mr-1 btn-outline-danger" href="{{ route('admin.manage.grades.index') }}">
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
                                    href="{{ route('admin.manage.grades.index', ['level_id' => $level->id]) }}">{{ $level->grade_name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="sections-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Section name</th>
                            @if (request()->level_id == null)
                                <th scope="col">Grade Level</th>
                            @endif
                            <th scope="col">No. of students</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td> {{ $loop->index + 1 }}</td>
                                <td>{{ $section->section_name }}</td>
                                @if (request()->level_id == null)
                                    <td>{{ $section->gradeLevel->grade_name }}</td>
                                @endif
                                @if ($section->students->where('isDropped', '=', 0)->count() == null)
                                    <td>No Student</td>
                                @else
                                    <td>{{ $section->students->where('isDropped', '=', 0)->count() }}</td>
                                @endif
                                <td class="d-flex justify-content-center align-items-center">
                                    <a class="btn btn-sm btn-outline-info mr-1"
                                        href="{{ route('admin.manage.grades.show', $section->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        View
                                    </a>
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
            $('#sections-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
