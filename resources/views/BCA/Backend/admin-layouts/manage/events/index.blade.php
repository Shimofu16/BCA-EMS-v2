@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    Events
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
                        Event</span>
                </button>
                @include('BCA.Backend.admin-layouts.manage.events.modal._add')
            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="events-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            @php
                                $start = date('M d, Y', strtotime($event->start . ' +1 day'));
                                $end = date('M d, Y', strtotime($event->end . ' -1 day'));
                            @endphp
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $start }} -
                                    {{ $end }}</td>
                                <td>{{ date('h:i:s A', strtotime($event->time)) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal"
                                            data-target="#edit{{ $event->id }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                        </button>
                                        @include('BCA.Backend.admin-layouts.manage.events.modal._edit')
                                        <button class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                            data-target="#delete{{ $event->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </button>
                                        @include('BCA.Backend.admin-layouts.manage.events.modal._delete')
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
            $('#events-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
