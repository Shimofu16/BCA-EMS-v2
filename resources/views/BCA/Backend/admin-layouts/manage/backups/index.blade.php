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
                <a class="btn btn-outline-primary" href="{{ route('admin.manage.backups.generate') }}">
                    <span class="d-flex align-items-center"><i class="fas fa-database"></i> &#160; Generate Backup</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="row align-items-center mb-3">
                {{-- create a dropdown of date justified end --}}
                <div class="d-flex justify-content-end">

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
