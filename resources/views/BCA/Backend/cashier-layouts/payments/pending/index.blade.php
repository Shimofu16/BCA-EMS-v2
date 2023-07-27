@extends('BCA.Backend.cashier-layouts.index')

@section('page-title')
    Pending Payments
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">Pending Payments</h1>
        </div>
        <div class="col">
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3 ">
        <div class="col-12">
            <div class="table-responsive">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <a class="btn mr-1 btn-outline-danger" href="{{ route('cashier.payment.pending.index') }}">
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
                                    href="{{ route('cashier.payment.pending.index', ['level_id' => $level->id]) }}">{{ $level->display_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="pending-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Student Id</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Mode of
                                Payment
                            </th>
                            <th scope="col">Payment Method
                            </th>
                            <th scope="col">Date</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->student->student_id }}</td>
                                <td>
                                    <div class="d-flex flex-column px-2 py-1">
                                        <h5 class="mb-0 text-sm">{{ $payment->student->first_name }}
                                            {{ $payment->student->middle_name }},
                                            {{ $payment->student->last_name }}
                                        </h5>
                                        <p class="text-sm text-secondary mb-0">
                                            {{ $payment->student->email }}
                                        </p>
                                    </div>
                                </td>
                                <td>{{ $payment->mop }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                                        data-target="#view{{ $payment->id }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        {{ $payment->payment_method }}
                                    </button>
                                </td>
                                <td>{{ date('F d, Y', strtotime($payment->created_at)) }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                                            data-target="#show{{ $payment->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                            View
                                        </button>
                                    </div>
                                    @include('BCA.Backend.cashier-layouts.payments.pending.modal._show')
                                    @include('BCA.Backend.cashier-layouts.payments.pending.modal._view')
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
            $('#pending-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
