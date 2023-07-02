<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        {{-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">
                 @if ($unregStudentCount > 10)
                        {{ $unregStudentCount }}+
                    @else
                        {{ $unregStudentCount }}
                    @endif
                </span>
            </a>
        <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notifications
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <span class="font-weight-bold">Donation</span>
                        <hr class="my-0">
                        <span class="font-weight-bold pt-3">Sender: Roy Joseph Latayan</span>
                        <div class="small text-gray-500">December 23, 2021</div>
                    </div>
                </a>

                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li> --}}

        <!-- Nav Item - Messages -->
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @php
                    $user = Auth::user();
                @endphp

                @if ($user)
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->getName() }}</span>
                    <img class="img-profile rounded-circle"
                        src="{{ asset($user->getGender() == 'Male' ? 'assets/img/svg/undraw_profile_2.svg' : 'assets/img/svg/undraw_profile_3.svg') }}">
                    @if ($user->isActive())
                        <span class="badge badge-success badge-counter">o</span>
                    @else
                        <span class="badge badge-danger badge-counter">x</span>
                    @endif
                @endif



            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route(Str::lower(Auth::user()->getRole()).'.settings.profile.changePassword.index') }}">
                    <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>

            </div>
        </li>

    </ul>

</nav>
