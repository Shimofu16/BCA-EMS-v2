@extends('BCA.Backend.layouts.main-layout')

@section('role')
    Registrar
@endsection
@section('sidebar')
    <ul class="navbar-nav bg-bca sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center flex-column"
            href="{{ route('registrar.dashboard.index') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                {{-- <img src="{{ asset('img/BCA-Logo.png') }}" class="img-fluid" alt=""> --}}
            </div>
            <div class="sidebar-brand-text mx-3">Registrar dashboard</div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="{{ Request::routeIs('registrar.dashboard.index') ? 'active' : '' }} nav-item ">
            <a class="nav-link" href="{{ route('registrar.dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        @if (Auth::user()->isFirstRole('Registrar') && Auth::user()->second->name !== null)
            <li class="nav-item ">
                <a class="nav-link" href="{{ route(Str::lower(Auth::user()->second->name) . '.dashboard.index') }}">
                    <i class="fa-solid fa-repeat"></i>
                       <span>{{ Str::ucfirst(Auth::user()->second->name) }} Dashboard</span></a>
            </li>
        @elseif (Auth::user()->isSecondRole('Registrar'))
            <li class="nav-item ">
                <a class="nav-link" href="{{ route(Str::lower(Auth::user()->first->name) . '.dashboard.index') }}">
                    <i class="fa-solid fa-repeat"></i>
                    <span>{{ Str::ucfirst(Auth::user()->first->name) }} Dashboard</span></a>
            </li>
        @endif
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Manage Enrollment
        </div>
        <!-- Nav Item - Students Collapse Menu -->
        <li class="nav-item {{ Request::routeIs('registrar.enrolled.*', 'registrar.enrollees.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-fw fa-users"></i>
                <span>Students</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    {{-- @if ($isCurrentSy) --}}
                    <a class="collapse-item mb-1 {{ Request::routeIs('registrar.enrolled.*') ? 'active-collapse-item' : '' }}"
                        href="{{ route('registrar.enrolled.index') }}">Enrolled Student</a>
                    {{-- @endif --}}
                    {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                    <a class="collapse-item mb-1 {{ Request::routeIs('registrar.enrollees.*') ? 'active-collapse-item' : '' }}"
                        href="{{ route('registrar.enrollees.index') }}">Enrollees</a>
                    {{-- <a class="collapse-item" href="{{ route('enrollees.create') }}">Add Student</a> --}}
                </div>
            </div>
        </li>
        <!-- Nav Item - Teachers Collapse Me -->
        <li class="nav-item {{ Request::routeIs('registrar.teachers.index') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('registrar.teachers.index') }}">
                <i class="fa-fw fas fa-chalkboard-teacher"></i>
                <span>Teachers</span>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('registrar.class.index') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('registrar.class.index') }}">
                <i class="fas fa-fw fa-solid fa-person-chalkboard"></i>
                <span>Classes</span>
            </a>
        </li>

        <!-- Nav Item - Sections -->
        <li class="nav-item {{ Request::routeIs('registrar.section.index') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('registrar.section.index') }}">
                <i class="fas fa-fw fa-object-ungroup"></i>
                <span>Sections</span>
            </a>
        </li>
        <!-- Nav Item - Subjects -->
        <li class="nav-item {{ Request::routeIs('registrar.subject.index') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('registrar.subject.index') }}">
                <i class="fas fa-fw fa-solid fa-book"></i>
                <span>Subjects</span>
            </a>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
            Manage Archives
        </div>
        <!-- Nav Item - Students Collapse Menu -->
        <li class="nav-item {{ Request::routeIs('registrar.archive.show') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#archives" aria-expanded="true"
                aria-controls="archives">
                <i class="fa-solid fa-box-archive"></i>
                <span>Archives</span>
            </a>
            <div id="archives" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item mb-1 {{ Request::is('registrar/archive/1') ? 'active-collapse-item' : '' }}"
                        href="{{ route('registrar.archive.show', ['isStudent' => 1]) }}">Students</a>
                    <a class="collapse-item mb-1 {{ Request::is('registrar/archive/0') ? 'active-collapse-item' : '' }}"
                        href="{{ route('registrar.archive.show', ['isStudent' => 0]) }}">Teachers</a>
                </div>
            </div>
        </li>
        <!-- Heading -->
        <div class="sidebar-heading">
            Profile Settings
        </div>
        <li class="nav-item {{ Request::routeIs('registrar.settings.profile.changePassword.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('registrar.settings.profile.changePassword.index') }}">
                <i class="fa-solid fa-lock"></i>
                <span>Change Password</span></a>
        </li>
        <!-- Nav Item - Teachers Collapse Me -->
        <hr class="sidebar-divider mb-0">
        <li class="nav-item">
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
