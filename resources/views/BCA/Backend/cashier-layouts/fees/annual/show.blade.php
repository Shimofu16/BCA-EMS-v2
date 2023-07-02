@extends('BCA.Backend.cashier-layouts.index')

@section('page-title')
    {{ $level->display_name }}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="float-right">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Add Annual Fee
                </button>
            </div>
            @include('BCA.Backend.cashier-layouts.fees.annual.modal._add')
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3 ">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="fees-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fees as $fee)
                            <tr>
                                <td>{{ $fee->title }}</td>
                                <td>₱{{ number_format($fee->amount, 2, '.', ',') }}</td>
                                <td>{{ $fee->fee_type }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm mr-1"
                                            data-toggle="modal" data-target="#edit{{ $fee->id }}">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm " data-toggle="modal"
                                            data-target="#delete{{ $fee->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Delete
                                        </button>

                                    </div>
                                    @include('BCA.Backend.cashier-layouts.fees.annual.modal._edit')
                                    @include('BCA.Backend.cashier-layouts.fees.annual.modal._delete')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h5 class="text-secondary">No fees found</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>

        </div>

    </div>
@endsection
@section('dashboard-javascript')
    {{-- datatables --}}
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#fees-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
