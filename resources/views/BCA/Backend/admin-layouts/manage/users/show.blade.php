@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
        {{ $user->getFullName() }}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.manage.user.index',['type' => $type]) }}" class="btn btn-outline-primary">
                        <span class="d-flex align-items-center"><i class="fa-solid fa-circle-arrow-left"></i>&#160;
                            Back</span>
                    </a>
            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="log-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Log #</th>
                            <th scope="col">Time in / Time out</th>
                            <th scope="col">Logged out by</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->logs as $log)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <div class="d-flex flex-column px-2 py-1">
                                        <p class="text-sm text-secondary mb-0">
                                            {{ date('F d, Y', strtotime($log->created_at)) }} at
                                            {{ date('h:i:s A', strtotime($log->time_in)) }} /
                                            @if ($log->time_out == null)
                                                <span class="text-danger">Not logged out yet</span>
                                            @else
                                                {{ date('F d, Y', strtotime($log->updated_at)) }} at
                                                {{ date('h:i:s A', strtotime($log->time_out)) }}
                                            @endif
                                        </p>
                                    </div>
                                </td>
                                <td>{{ $log->updated_by }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    {{-- $log->created_at->diffForHumans() --}}
@endsection
@section('dashboard-javascript')
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#log-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
