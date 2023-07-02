@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    Announcements
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add">
                    <span class="d-flex align-items-center"><i class="fas fa-plus-circle"></i>&#160; Add
                        Announcement</span>
                </button>
                @include('BCA.Backend.admin-layouts.manage.announcements.modal._add')
            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="Announcements-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Desciption</th>
                            <th scope="col">Photo</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $announcement->title }}</td>
                                <td>
                                    <div class="text-overflow-ellipsis">
                                        {{ $announcement->description }}
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info mr-1" data-toggle="modal"
                                        data-target="#view{{ $announcement->id }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Preview
                                    </button>
                                    @include('BCA.Backend.admin-layouts.manage.announcements.modal._view')
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal" data-target="#edit{{ $announcement->id }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                        </button>
                                        @include('BCA.Backend.admin-layouts.manage.announcements.modal._edit')
                                        <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete{{ $announcement->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </button>
                                        @include('BCA.Backend.admin-layouts.manage.announcements.modal._delete')
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
            $('#Announcements-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
