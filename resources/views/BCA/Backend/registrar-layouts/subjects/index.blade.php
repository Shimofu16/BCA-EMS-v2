@extends('BCA.Backend.registrar-layouts.index')
@section('page-title')
Subjects
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3  mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <a class="btn btn-outline-primary" data-toggle="modal" data-target="#add">
                    <span class="d-flex align-items-center"><i class="fas fa-plus-circle"></i>&#160; Add Subject</span>
                </a>
                @include('BCA.Backend.registrar-layouts.subjects.modal._add')
            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="subject-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Subject</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td> {{ $loop->index + 1 }}</td>
                                <td> {{ $subject->subject }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal"
                                            data-target="#edit{{ $subject->id }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                        </a>
                                        <a class="btn btn-sm btn-outline-danger {{ $subject->classes->count() != null ? 'disabled pointer-event-none' : '' }}"
                                            data-toggle="modal" data-target="#delete{{ $subject->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                                @include('BCA.Backend.registrar-layouts.subjects.modal._edit')
                                @include('BCA.Backend.registrar-layouts.subjects.modal._delete')
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
