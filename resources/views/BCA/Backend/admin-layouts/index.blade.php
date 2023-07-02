@extends('BCA.Backend.layouts.main-layout')
@section('role')
    Admin
@endsection
@section('sidebar')
    <ul class="navbar-nav bg-bca sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center flex-column"
            href="{{ route('admin.dashboard.index') }}">
            <div class="sidebar-brand-icon rotate-n-15">

            </div>
            <div class="sidebar-brand-text mx-3">Admin dashboard</div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="{{ Request::routeIs('admin.dashboard.index') ? 'active' : '' }} nav-item ">
            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        @if (Auth::user()->isFirstRole('Registrar') && Auth::user()->second->name !== null)
            <li class="nav-item ">
                <a class="nav-link" href="{{ route(Str::lower(Auth::user()->second->name) . '.dashboard.index') }}">
                    <i class="fa-solid fa-repeat"></i>
                    <span>{{ Auth::user()->second->name }} Dashboard</span></a>
            </li>
        @elseif (Auth::user()->isSecondRole('Registrar'))
            <li class="nav-item ">
                <a class="nav-link" href="{{ route(Str::lower(Auth::user()->first->name) . '.dashboard.index') }}">
                    <i class="fa-solid fa-repeat"></i>
                    <span>{{ Auth::user()->first->name }} Dashboard</span></a>
            </li>
        @endif
        <!-- Heading -->
        <div class="sidebar-heading">
            Manage Users
        </div>


        <!-- Nav Item - Users Collapse Menu -->
        <li class="nav-item {{ Request::routeIs('admin.manage.user.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Users</span></a>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item mb-1 {{ Request::routeIs('admin.manage.user.index') ? 'active-collapse-item' : '' }}"
                        href="{{ route('admin.manage.user.index', ['type' => 'faculty']) }}">Faculty</a>
                    <a class="collapse-item mb-1 {{ Request::routeIs('admin.manage.user.index') ? 'active-collapse-item' : '' }}"
                        href="{{ route('admin.manage.user.index', ['type' => 'student']) }}">Students</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <!-- Heading -->

        <div class="sidebar-heading">
            Manage Website
        </div>

        <li class="nav-item {{ Request::routeIs('admin.manage.announcement.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.manage.announcement.index') }}">
                <i class="fa-solid fa-newspaper"></i>
                <span>Announcements</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.manage.events.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.manage.events.index') }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Events</span></a>
        </li>

        <li class="nav-item {{ Request::routeIs('admin.manage.gallery.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.manage.gallery.index') }}">
                <i class="fa-solid fa-images"></i>
                <span>Photo Gallery</span>
            </a>
        </li>

        <!-- Nav Item - Teachers Collapse Me -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Manage Database
        </div>
        <li class="nav-item {{ Request::routeIs('admin.manage.backups.show') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.manage.backups.show', ['date' => now()]) }}">
                <i class="fa-solid fa-database"></i>
                <span>Backups</span></a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.account.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.account.index') }}">
                <i class="fa fa-bank" aria-hidden="true"></i>
                <span>Bank Accounts</span></a>
        </li>

        <li class="nav-item {{ Request::routeIs('admin.manage.grades.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.manage.grades.index') }}">
                <i class="fa-solid fa-address-card"></i>
                <span>Grades</span>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.manage.sy.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.manage.sy.index') }}">
                <i class="fa-solid fa-school"></i>
                <span>School Year</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Profile Settings
        </div>
        <li class="nav-item {{ Request::routeIs('admin.settings.profile.changePassword.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.settings.profile.changePassword.index') }}">
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
