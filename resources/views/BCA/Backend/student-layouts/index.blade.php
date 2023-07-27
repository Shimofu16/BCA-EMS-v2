@extends('BCA.Backend.layouts.main-layout')
@section('role')
    Student
@endsection
@section('sidebar')
    <ul class="navbar-nav bg-bca sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
            href="{{ route('student.dashboard.index') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Student dashboard</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="{{ Request::is('student/dashboard') ? 'active' : '' }} nav-item ">
            <a class="nav-link" href="{{ route('student.dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>
        <li class="nav-item {{ Request::routeIs('student.enrolment.index') ? 'active' : '' }}">
            <a class="nav-link " href="{{ route('student.enrolment.index') }}">
                <i class="fas fa-fw fa-address-card"></i>
                <span>Enrollment</span>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('student.payment.index') ? 'active' : '' }}">
            <a class="nav-link " href="{{ route('student.payment.index') }}">
                <i class="fa-solid fa-receipt"></i>
                <span>Payments</span>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('student.grades.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-address-card"></i>
                <span>Grades</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @php
                        $levels = Auth::user()
                            ->student->enrollmentLogs()
                            ->orderBy('sy_id', 'asc')
                            ->get();
                    @endphp
                    @forelse ($levels as $level)
                        <a class="collapse-item mb-1 {{ Request::is('student/sy/' . $level->sy_id) ? 'active-collapse-item' : '' }}"
                            href="{{ route('student.grades.show', ['sy_id' => $level->sy_id]) }}">{{ $level->gradeLevel->name }}</a>
                        </a>
                    @empty
                        <a class="collapse-item mb-1 " href="#">No Grades Available</a>
                    @endforelse

                </div>
            </div>
        </li>
        <div class="sidebar-heading">
            Profile Settings
        </div>
        <li class="nav-item {{ Request::routeIs('student.settings.profile.changePassword.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('student.settings.profile.changePassword.index') }}">
                <i class="fa-solid fa-lock"></i>
                <span>Change Password</span></a>
        </li>
        <hr class="sidebar-divider mb-0">
        <li class="nav-item ">
            <a class="nav-link pe-auto" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
@endsection
