@extends('BCA.Frontend.pages.portal.index')

@section('title')
    @if (Request::is('portals/*'))
        {{ Str::ucfirst($role) }} Portal
    @elseif (Request::routeIs('tracker.index'))
        Enrollment Tracker
    @else
        Gateway Hub
    @endif
@endsection
@section('forms')
    @if (Request::routeIs('portals.index'))
        <div class="row justify-content-center align-items-center mt-5 p-5">
            <div class="col-md-10">
                <div class="card p-3 rounded-5 glass">
                    <div
                        class="card-header bg-transparent border-bottom-0 d-flex align-items-center justify-content-center  flex-column">
                        <img src="{{ asset('assets/img/BCA-Logo.png') }}" alt="LOGO" class="form-logo mb-2">
                        <h3>
                            Gateway Hub
                        </h3>
                        <h5 class="fw-medium text-center">A Centralized Portals for Admin, Cashier, Registrar,
                            Students, and
                            Teachers</h5>
                    </div>
                    <div class="card-body pb-2">
                        {{-- generate a cards for Admin, Cashier, Registrar,
                                Students, and
                                Teachers in one row --}}
                        <div class="row justify-content-center align-items-center gap-2">
                            @foreach ($roles as $role)
                                @if ($role->name !== 'Parent')
                                    <div class="col-md-3">
                                        <a href="{{ route('portals.show', ['role' => $role->name]) }}"
                                            class="text-decoration-none text-dark">
                                            <div class="card p-3 rounded-5 glass ctm-hvr-sweep-to-right">
                                                <div
                                                    class="card-header bg-transparent border-bottom-0 d-flex align-items-center justify-content-center  flex-column">
                                                    <h1>{{ Str::ucfirst(Str::substr($role->name, 0, 1)) }}</h1>
                                                    <h5 class="fw-light text-center fw-800">{{ Str::ucfirst($role->name) }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div
                        class="card-footer bg-transparent border-top-0 d-flex align-items-center justify-content-center flex-column mb-5">


                    </div>
                </div>
            </div>
        </div>
    @elseif (Request::routeIs('tracker.index'))
        <div class="row justify-content-end align-items-center mt-5 p-5">
            <div class="col-md-4">
                <form action="{{ route('tracker.track') }}" method="POST">
                    @csrf
                    <div class="card p-3 rounded-5">
                        <div
                            class="card-header bg-transparent border-bottom-0 d-flex align-items-center justify-content-center  flex-column">
                            <img src="{{ asset('assets/img/BCA-Logo.png') }}" alt="LOGO" class="form-logo mb-2">
                            <h3>
                                @yield('title')
                            </h3>
                            <h5 class="fw-light">Track your Enrollment here.</h5>
                        </div>
                        <div class="card-body pb-1">
                            <div class="form-floating mb-2">
                                <input type="email"
                                    class="form-control  @error('email') is-invalid @enderror"
                                    id="email" placeholder="name@example.com" name="email">
                                <label for="email">
                                    Email address
                                </label>
                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div
                            class="card-footer bg-transparent border-top-0 d-flex align-items-center justify-content-center flex-column mb-5">
                            <button class="btn btn-bca w-100 mb-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row justify-content-end align-items-center mt-5 p-5">
            <div class="col-md-4">
                <form action="{{ route('portals.auth.login', ['role' => $role]) }}" method="POST">
                    @csrf
                    <div class="card p-3 rounded-5">
                        <div
                            class="card-header bg-transparent border-bottom-0 d-flex align-items-center justify-content-center  flex-column">
                            <img src="{{ asset('assets/img/BCA-Logo.png') }}" alt="LOGO" class="form-logo mb-2">
                            <h3>
                                @yield('title')
                            </h3>
                            <h5 class="fw-light">Sign in to start your session</h5>
                        </div>
                        <div class="card-body pb-1">
                            <div class="form-floating mb-2">
                                <input type="email"
                                    class="form-control  @error('email')
                                is-invalid
                                @enderror"
                                    id="email" placeholder="name@example.com" name="email">
                                <label for="email">
                                    Email address
                                </label>
                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control  @error('password')
                                is-invalid
                            @enderror"
                                    id="floatingPassword" placeholder="Password" name="password">
                                <label for="floatingPassword">
                                    Password
                                </label>
                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div
                            class="card-footer bg-transparent border-top-0 d-flex align-items-center justify-content-center flex-column mb-5">
                            <button class="btn btn-bca w-100 mb-2">Sign In</button>
                            <a href="#" class="text-decoration-none">Forgot Password?</a>
                            @if (session()->has('active_user'))
                                <a href="#" class="text-decoration-none">Send OTP?</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

@endsection
