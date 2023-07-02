<header>
    <nav id="navigation"
        class="navbar navbar-expand-md  {{ !Request::routeIs('home.index') ? 'navbar-white' : 'navbar-transparent' }} fixed-top ">
        <div class="container d-flex justify-content-md-center justify-content-sm-between align-items-center">
            <a class="navbar-brand" href="{{ route('home.index') }}"><img src="{{ asset('assets/img/BCA-Logo.png') }}"
                    alt="BCA LOGO" class="nav-logo" />
            </a>
             <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation" style="color: white; border-color: white;">
                <h3 class="mb-0">
                    <i class="fa-solid fa-bars"></i>
                </h3>
            </button>
            <div class="navbar-collapse collapse flex-grow-0" id="navbarCollapse">
                <ul class="navbar-nav nav-line mb-2 mb-md-0">
                    <li class="nav-item px-4">
                        <a class="nav-link {{ Request::routeIs('home.index') ? 'active' : '' }}"
                            {{ Request::routeIs('home.index') ? 'aria-current="page"' : '' }}
                            href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown px-4" id="about">
                        <a class="nav-link {{ Request::routeIs('about.history.index', 'about.cv.index') ? 'active' : '' }}"
                            href="#">
                            About Us
                            <button class="dropdown-btn d-md-none" id="aboutbtn" type="button">
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </a>
                        <ul class="dropdown-menu animate__fadeIn" id="aboutdd">
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('about.history.index') ? 'active-dd' : '' }}"
                                    href="{{ route('about.history.index') }}">History</a></li>
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('about.cv.index') ? 'active-dd' : '' }}"
                                    href="{{ route('about.cv.index') }}">Core Values and
                                    Principles</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown px-4" id="academics">
                        <a class="nav-link {{ Request::routeIs('academic.primary.index', 'academic.elementary.index','academic.juniorHighSchool.index','calendar.index') ? 'active' : '' }}" href="#">
                            Academics
                            <button class="dropdown-btn d-md-none" id="academicsbtn" type="button">
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </a>
                        <ul class="dropdown-menu animate__fadeIn" id="academicsdd">
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('academic.primary.index')
                                ? 'active-dd
                                                        active-dd'
                                : '' }}"
                                    href="{{ route('academic.primary.index') }}">Preschool</a></li>
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('academic.elementary.index')
                                ? 'active-dd
                                                        active-dd'
                                : '' }}"
                                    href="{{ route('academic.elementary.index') }}">Elementary</a></li>
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('academic.juniorHighSchool.index')
                                ? 'active-dd
                                                        active-dd'
                                : '' }}"
                                    href="{{ route('academic.juniorHighSchool.index') }}">Junior Highschool</a></li>
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('calendar.index')
                                ? 'active-dd
                                                        active-dd'
                                : '' }}"
                                    href="{{ route('calendar.index') }}">Calendar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown px-4" id="services">
                        <a class="nav-link" href="#">Online Services
                            <button class="dropdown-btn d-md-none" id="servicesbtn" type="button">
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </a>
                        <ul class="dropdown-menu" id="servicesdd">
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('enroll.index')
                                ? 'active-dd
                            active-dd'
                                : '' }}"
                                    href="{{ route('enroll.index') }}">Online Enrollment </a></li>
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('tracker.index')
                                ? 'active-dd
                            active-dd'
                                : '' }}"
                                    href="{{ route('tracker.index') }}">Online Enrollment Tracker</a></li>
                            <li><a class="dropdown-item mb-1 {{ Request::routeIs('portals.index')
                                ? 'active-dd
                            active-dd'
                                : '' }}"
                                    href="{{ route('portals.index') }}">Online Portal</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
