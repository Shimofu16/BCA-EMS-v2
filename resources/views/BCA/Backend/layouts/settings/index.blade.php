@php
    if (Auth::user()) {
        if (Route::is('admin.*')) {
            $user = 'admin';
        } elseif (Route::is('registrar.*')) {
            $user = 'registrar';
        } elseif (Route::is('cashier.*')) {
            $user = 'cashier';
        } elseif (Route::is('teacher.*')) {
            $user = 'teacher';
        } elseif (Route::is('student.*')) {
            $user = 'student';
        }
    }
@endphp

@extends('BCA.Backend.' . $user . '-layouts.index')

@section('page-title')
    Profile - Change password
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">

        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-5">
            <div class="card">
                <form action="{{ route($user . '.settings.profile.updatePassword.update') }}" method="POST">
                    <div class="card-body">
                        {{-- create a form for change password --}}
                        @csrf
                        @method('PUT')
                        {{-- inputs for old password and new password --}}

                        <div class="form-group mb-3">
                            <label for="current_password" class="font-weight-bold">Current Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" name="current_password" value="{{ old('current_password') }}">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_password" class="font-weight-bold">New Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                id="new_password" name="new_password" value="{{ old('new_password') }}">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm_password" class="font-weight-bold">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}">
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="show-password">
                            <label class="form-check-label" for="show-password">
                                Show Passwords
                            </label>
                        </div>

                    </div>
                    <div class="card-footer border-0 bg-transparent d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('dashboard-javascript')
    <script>
        //show password using jquery
        $(document).ready(function() {
            $('#show-password').click(function() {
                if ($(this).is(':checked')) {
                    $('#current_password').attr('type', 'text');
                    $('#new_password').attr('type', 'text');
                    $('#confirm_password').attr('type', 'text');
                } else {
                    $('#current_password').attr('type', 'password');
                    $('#new_password').attr('type', 'password');
                    $('#confirm_password').attr('type', 'password');
                }
            });
        });
    </script>
@endsection
