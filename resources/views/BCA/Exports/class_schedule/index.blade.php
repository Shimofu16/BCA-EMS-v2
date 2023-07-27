<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Class Schedule</title>

    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/packages/bootstrap/css/bootstrap.min.css') }}" type="text/css" /> --}}

    <!-- custom css -->
    {{-- <link href="{{ asset('assets/css/pdf.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="./assets/css/pdf.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="fw-bold text-center mb-3 mt-3">
        <h3 class="mb-1 mt-0">CLASS SCHEDULE</h3>
        <small>SY: {{ $sy->name }}</small>
    </div>
    <div class="fw-bold mb-3 text-center">
        <h3 class="mb-1 mt-0">Home Room</h3>
        <span> Section: {{ $section != null ? $section->name : '' }}</span>
        @if ($isStudent)
            <br>
            <span>Adviser:
                {{ $section != null ? ($section->teacher != null ? $section->teacher->name : 'No Adviser.') : '' }}
            </span>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="header">Subject Code.</th>
                    <th scope="col" class="header">Section</th>
                    <th scope="col" class="header">Subject</th>
                    <th scope="col" class="header">Schedule</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td scope="row" class="bordered-body">{{ $schedule->class_code }}</td>
                        <td scope="row" class="bordered-body">{{ $schedule->section->name }}</td>
                        <td scope="row" class="bordered-body">{{ $schedule->subject->subject }}</td>
                        <td>
                            <div>
                                <span>
                                    @foreach ($schedule->days as $day)
                                        {{ $day->day }}{{ $schedule->days->count() > 1 && !$loop->last ? ',' : '' }}
                                        {{ $schedule->days->count() > 1 && $loop->remaining == 1 ? 'and' : '' }}
                                    @endforeach
                                </span>
                                <br>
                                <span>
                                    At {{ date('h:i A', strtotime($schedule->start_time)) }} -
                                    {{ date('h:i A', strtotime($schedule->end_time)) }}
                                </span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
