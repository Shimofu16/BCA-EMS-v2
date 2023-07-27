@extends('BCA.Backend.registrar-layouts.index')

@section('page-title')
    Sections {{ request()->level_id != null ? 'in ' . $gradeLevels->find(request()->level_id)->name : '' }}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3  mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <a class="btn btn-outline-primary " data-toggle="modal" data-target="#add">
                    <span class="d-flex align-items-center"><i class="fas fa-plus-circle"></i>&#160; Add Section</span>
                </a>
                @include('BCA.Backend.registrar-layouts.section.modal._add')
            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <a class="btn mr-1 btn-outline-danger" href="{{ route('registrar.section.index') }}">
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
                                    href="{{ route('registrar.section.index', ['level_id' => $level->id]) }}">{{ $level->display_name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="section-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Section name</th>
                            @if (request()->level_id == null)
                                <th scope="col">Grade Level</th>
                            @endif
                            <th scope="col">Number of students</th>
                            <th scope="col">Adviser</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td> {{ $loop->index + 1 }}</td>
                                <td>{{ $section->section_name }}</td>
                                @if (request()->level_id == null)
                                    <td>{{ $section->gradeLevel->name }}</td>
                                @endif
                                @if ($section->students->where('isDropped', '=', 0)->count() == null)
                                    <td>No Student</td>
                                @else
                                    <td>{{ $section->students->where('isDropped', '=', 0)->count() }}</td>
                                @endif
                                @if ($section->teacher_id == null)
                                    <td>No Adviser</td>
                                @else
                                    <td>{{ $section->teacher->name }}</td>
                                @endif
                                <td class="d-flex justify-content-center align-items-center">
                                    <a class="btn btn-sm btn-outline-info mr-1"
                                        href="{{ route('registrar.section.show', $section->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        View
                                    </a>
                                    <button type="button" class="btn btn-outline-primary btn-sm mr-1" data-toggle="modal"
                                        data-target="#edit{{ $section->id }}">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        Edit
                                    </button>
                                    <button type="button"
                                        class="btn btn-outline-danger btn-sm {{ $section->students->count() != null ? 'disabled pointer-event-none' : '' }}"
                                        data-toggle="modal" data-target="#delete{{ $section->id }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete
                                    </button>
                                    @include('BCA.Backend.registrar-layouts.section.modal._edit')
                                    @include('BCA.Backend.registrar-layouts.section.modal._delete')
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
            $('#section-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
