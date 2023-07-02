@extends('BCA.Backend.teacher-layouts.index')
@section('page-title')
    Dashboard
@endsection
@section('contents')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card  border-primary shadow p-3">
                    <h1 class="h3 text-gray-800">Class Schedule</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-3" id="schedule-table">
                            <thead class="trace-line-header">
                                <tr>
                                    <th>Section</th>
                                    <th>Subject</th>
                                    <th>Schedule</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $sched)
                                    <tr>
                                        <td scope="row">{{ $sched->section->section_name }}</td>
                                        <td>{{ $sched->subject->subject }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span>
                                                    @foreach ($sched->days as $day)
                                                        {{ $day->day }}{{ $sched->days->count() > 1 && !$loop->last ? ',' : '' }}
                                                        {{ $sched->days->count() > 1 && $loop->remaining == 1 ? 'and' : '' }}
                                                    @endforeach
                                                </span>
                                                <span>
                                                    At {{ date('h:i A', strtotime($sched->start_time)) }} -
                                                    {{ date('h:i A', strtotime($sched->end_time)) }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No schedule yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if (!empty($schedules->first()))
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align: end;">
                                            <a href="{{ route('export.class.schedule', ['id' => Auth::user()->teacher_id, 'isStudent' => 0]) }}"
                                                class="btn btn-primary btn-sm">Download</a>
                                        </th>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('dashboard-javascript')
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#schedule-table').DataTable({
                "ordering": false,
                "info": false,
                "searching": false,
                "paging": false,
            });
        });
    </script>
@endsection