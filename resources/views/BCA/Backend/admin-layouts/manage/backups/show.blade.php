@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    Backups
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                {{-- create a dropdown for import where selects is import from file and import from database --}}
                <div class="dropdown mr-1">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-cloud-arrow-up"></i> &#160; Import
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('admin.manage.backups.import.index') }}">Import from local
                            files</a>
                        {{-- open modal --}}
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#import">Import from System files</a>
                    </div>
                    @include('BCA.Backend.admin-layouts.manage.backups.modal._import')
                </div>
                <a class="btn btn-outline-primary" href="{{ route('admin.manage.backups.backup') }}">
                    <span class="d-flex align-items-center"><i class="fas fa-database"></i> &#160; Backup</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="row align-items-center mb-3">
                {{-- create a dropdown of date justified end --}}
                <div class="d-flex justify-content-end">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-calendar"></i> &#160; {{ date('F d, Y', strtotime($date)) }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($dates as $date)
                                <a class="dropdown-item"
                                    href="{{ route('admin.manage.backups.show', ['date' => $date->created_at]) }}">
                                    {{ date('F d, Y', strtotime($date->created_at)) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="backups-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backups as $backup)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $backup->name }}</td>
                                <td>{{ date('F d, Y - h:i A', strtotime($backup->updated_at)) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('admin.manage.backups.download', ['id' => $backup->id]) }}"
                                            class="btn btn-outline-primary btn-sm mr-1">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            Download
                                        </a>
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
            $('#backups-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
