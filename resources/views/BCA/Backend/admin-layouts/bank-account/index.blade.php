@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    Bank Accounts
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add">
                    <span class="d-flex align-items-center"><i class="fas fa-plus-circle"></i>&#160; Add
                        Bank</span>
                </button>
                @include('BCA.Backend.admin-layouts.bank-account.modal._add')
            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="Announcements-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bank name</th>
                            <th scope="col">Account name</th>
                            <th scope="col">Account No.</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $account->bank_name }}</td>
                                <td>{{ $account->account_name }}</td>
                                <td>{{ $account->account_number }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button class="btn btn-sm btn-outline-primary mr-1" data-toggle="modal"
                                                data-target="#edit{{ $account->id }}">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                Edit
                                            </button>
                                            @include('BCA.Backend.admin-layouts.bank-account.modal._edit')
                                            <button class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                                data-target="#delete{{ $account->id }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                Delete
                                            </button>
                                            @include('BCA.Backend.admin-layouts.bank-account.modal._delete')
                                        </div>
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
            $('#Announcements-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
