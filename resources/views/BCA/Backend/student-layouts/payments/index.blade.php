@extends('BCA.Backend.student-layouts.index')

@section('page-title')
    Payment History
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">

        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Balance</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">₱
                                    {{ number_format($balance->amount, 2, '.', ',') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-peso-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Due Date</div>
                                <div class="h5 mb-0 font-weight-bold text-info-800">
                                    {{ date('F d, Y', strtotime($balance->reminder_at)) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-calendar fa-2x text-gray-300" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="payment-table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Payment No.</th>
                        <th scope="col">Mode of Payment</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Amount</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentLogs as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->mop }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td>₱ {{ number_format($item->amount, 2, '.', ',') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    @if ($item->status == 1)
                                        <button class="btn btn-sm btn-success rounded pointer-event-none">Paid</button>
                                    @else
                                        <button class="btn btn-sm btn-secondary rounded pointer-event-none">Pending</button>
                                    @endif
                                </div>
                            </td>
                            <td>{{ date('F d, Y', strtotime($item->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('dashboard-javascript')
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#payment-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
