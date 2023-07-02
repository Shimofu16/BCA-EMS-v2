@extends('BCA.Backend.student-layouts.index')
@section('page-title')
    Dashboard
@endsection
@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Student Dashboard</h1>
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card  border-primary shadow">
                <div class="card-body">
                    <h1 class="h3 text-gray-800">Class Schedule</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-3" id="schedule-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Section</th>
                                    <th>Adviser</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{ $section != null ? $section->section_name : '' }}
                                    </td>
                                    <td>
                                        {{ $section != null ? ($section->teacher != null ? $section->teacher->name : 'No Adviser.') : '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-3" id="schedule-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Subject</th>
                                    <th colspan="2">Schedule</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $sched)
                                    <tr>
                                        <td>{{ $sched->subject->subject }}</td>
                                        <td colspan="2">
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
                                    {{-- how to create a table row that display no data  --}}
                                    <tr>
                                        <td colspan="4" class="text-center">No Schedule Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($schedules !== null)
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align: end;">
                                            <a href="{{ route('export.class.schedule', ['id' => Auth::user()->student->id, 'isStudent' => 1]) }}"
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
