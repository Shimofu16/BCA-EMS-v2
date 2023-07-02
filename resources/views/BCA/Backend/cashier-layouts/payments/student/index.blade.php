@extends('BCA.Backend.cashier-layouts.index')

@section('page-title')
    Balances
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3 ">
        <div class="col-12">
            <div class="table-responsive">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <a class="btn mr-1  btn-outline-danger" href="{{ route('cashier.payment.balance.index') }}">
                        <i class="fa-solid fa-rotate-right"></i> Reset
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-filter mx-2" aria-hidden="true"></i>
                            Grade Level
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($gradeLevels as $level)
                                <a class="dropdown-item {{ request()->level_id == $level->id ? 'active' : '' }}"
                                    href="{{ route('cashier.payment.balance.index', ['level_id' => $level->id]) }}">{{ $level->grade_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="balances-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Student Id</th>
                            <th scope="col">Student</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Reminder at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>
                                    <div class="d-flex flex-column px-2 py-1">
                                        <h5 class="mb-0 text-sm">
                                            {{ Str::ucfirst($student->first_name) }}
                                            {{ Str::upper(Str::substr($student->middle_name, 0, 1)) }}.
                                            {{ Str::ucfirst($student->last_name) }}
                                            </h6>
                                            <p class="text-sm text-secondary mb-0">
                                                {{ $student->email }}
                                            </p>
                                    </div>
                                </td>
                                <td>₱ {{ number_format($student->balance->amount, 2, '.', ',') }}</td>
                                <td>{{ date('F d, Y', strtotime($student->balance->reminder_at)) }}
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
            $('#balances-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
