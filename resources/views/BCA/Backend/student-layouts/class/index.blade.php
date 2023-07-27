@extends('BCA.Backend.student-layouts.index')

@section('page-title')
    {{ $section->name }}
@endsection
@section('contents')
    <div class="row shadow-sm align-items-center justify-content-between px-3 mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                @if ($section->teacher != null)
                    <h1 class="h4 text-gray-800 mb-0">Adviser: {{ $section->teacher->name }}</h1>
                @else
                    <h1 class="h4 text-gray-800 mb-0">Adviser: No Adviser.</h1>
                @endif
            </div>
        </div>
    </div>
    <div class="row shadow-sm p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="subject-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Class Code</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Schedule</th>
                            <th scope="col">Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $sched)
                            <tr>
                                <td> {{ $sched->class_code }}</td>
                                <td> {{ $sched->subject->subject }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span> {{ $sched->day }}</span>
                                        <span>{{ date('h:i A', strtotime($sched->start_time)) }} -
                                            {{ date('h:i A', strtotime($sched->end_time)) }}</span>
                                    </div>
                                </td>
                                <td> {{ $sched->teacher->name }}</td>
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
