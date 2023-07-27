@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    School Year
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded  align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add">
                    <span class="d-flex align-items-center"><i class="fas fa-plus-circle"></i>&#160; Add School Year</span>
                </button>
                @include('BCA.Backend.admin-layouts.manage.school-year.modal._add')
            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="sy-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">School Year</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Enrollment Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schoolYears as $sy)
                            <tr>
                                <td>
                                    {{ $sy->name }}
                                </td>
                                <td>
                                    Start at {{ date('F d, Y', strtotime($sy->start_date)) }} end at {{ date('F d, Y', strtotime($sy->end_date)) }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        @if ($sy->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        @if ($sy->enrollment_status == 'open')
                                            <span class="badge badge-success">Open</span>
                                        @else
                                            <span class="badge badge-danger">Closed</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal"
                                            data-target="#edit{{ $sy->id }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                        </button>
                                        @include('BCA.Backend.admin-layouts.manage.school-year.modal._edit')
                                    </div>
                                    {{-- <button class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                            data-target="#delete{{ $sy->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </button>
                                        @include('BCA.Backend.admin-layouts.manage.school-year.modal._delete') --}}
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
            $('#sy-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
