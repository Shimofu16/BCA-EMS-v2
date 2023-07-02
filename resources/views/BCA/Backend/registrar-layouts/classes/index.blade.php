@extends('BCA.Backend.registrar-layouts.index')

@section('page-title')
    Classes
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <a type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#add">
                    <span class="d-flex align-items-center"><i class="fas fa-plus-circle"></i>&#160; Add Class</span>
                </a>
                @include('BCA.Backend.registrar-layouts.classes.modal._add')
            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="subject-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Class Code</th>
                            <th scope="col">Section</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Day & Time</th>
                            <th scope="col">Teacher</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            <tr>
                                <td> {{ $class->class_code }}</td>
                                <td> {{ $class->section->section_name }}</td>
                                <td> {{ $class->subject->subject }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>
                                            @foreach ($class->days as $day)
                                                {{ $day->day }}{{ $class->days->count() > 1 && !$loop->last ? ',' : '' }}
                                                {{ $class->days->count() > 1 && $loop->remaining == 1 ? 'and' : '' }}
                                            @endforeach
                                        </span>
                                        <span>
                                            At {{ date('h:i A', strtotime($class->start_time)) }} -
                                            {{ date('h:i A', strtotime($class->end_time)) }}
                                        </span>
                                    </div>
                                </td>

                                <td> {{ $class->teacher->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-sm btn-outline-primary mr-2" data-toggle="modal"
                                            data-target="#edit{{ $class->id }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                        </a>
                                        <a class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                            data-target="#delete{{ $class->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </a>
                                        @include('BCA.Backend.registrar-layouts.classes.modal._edit')
                                        @include('BCA.Backend.registrar-layouts.classes.modal._delete')
                                    </div>
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
            $('#subject-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
