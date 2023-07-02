@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    Photo Gallery
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded  align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add">
                    <span class="d-flex align-items-center"><i class="fas fa-plus-circle"></i>&#160; Add Photo</span>
                </button>
                @include('BCA.Backend.admin-layouts.manage.gallery.modal._add')
            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="gallery-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Date</th>
                            <th scope="col">Photos</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $gallery->title }}</td>
                                <td>{{ date('F d, Y', strtotime($gallery->date)) }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-info"
                                        href="{{ route('admin.manage.gallery.show', ['id' => $gallery->id]) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Preview
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">

                                        {{-- <button class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal"
                                            data-target="#edit{{ $gallery->id }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                        </button>
                                        @include('BCA.Backend.admin-layouts.manage.gallery.modal._edit') --}}
                                        <button class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                            data-target="#delete{{ $gallery->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </button>
                                        @include('BCA.Backend.admin-layouts.manage.gallery.modal._delete')

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
            $('#gallery-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
