@extends('BCA.Backend.layouts.main-layout')
@section('role')
    Teacher
@endsection
@section('sidebar')
    <ul class="navbar-nav bg-bca sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
            href="{{ route('teacher.dashboard.index') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Teacher dashboard</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="{{ Request::is('teacher/dashboard') ? 'active' : '' }} nav-item ">
            <a class="nav-link" href="{{ route('teacher.dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->isFirstRole('Teacher') && Auth::user()->second->name !== null)
            <li class="nav-item ">
                <a class="nav-link" href="{{ route(Str::lower(Auth::user()->second->name) . '.dashboard.index') }}">
                    <i class="fa-solid fa-repeat"></i>
                       <span>{{ Str::ucfirst(Auth::user()->second->name) }} Dashboard</span></a>
            </li>
        @elseif (Auth::user()->isSecondRole('Teacher'))
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
            Menu
        </div>
        <li class="nav-item {{ Request::routeIs(['teacher.subject.*', 'teacher.advisory.show']) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <i class="fa-solid fa-people-roof"></i>
                <span>Classes</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @php
                        $currentSy = Session::get(Auth::id() . '_current_sy');
                        $sections = DB::table('sections')->get();
                        $section = Auth::user()->teacher->section;
                        $subjects = Auth::user()
                            ->teacher->ClassSchedules()
                            ->where('sy_id', '=', $currentSy)
                            ->get();
                        
                    @endphp
                    @forelse ($subjects as $subject)
                        <a class="collapse-item mb-1 {{ Request::is('teacher/subject/' . $subject->section_id) ? 'active-collapse-item' : '' }}"
                            href="{{ route('teacher.subject.show', ['id' => $subject->section_id]) }}">{{ $subject->class_code }}
                        </a>
                    @empty
                        <a class="collapse-item mb-1" href="#">No Subjects
                        </a>
                    @endforelse
                    @if ($section !== null)
                        <a class="collapse-item mb-1 {{ Request::routeIs('teacher.advisory.show') ? 'active-collapse-item' : '' }}"
                            href="{{ route('teacher.advisory.show', $section->id) }}">Advisory Class</a>
                    @endif

                </div>
            </div>
        </li>
        <li class="nav-item {{ Request::routeIs('teacher.grade.*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-address-card"></i>
                <span>Grades</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @forelse($subjects as $subject)
                        <a class="collapse-item mb-1 {{ Request::is('teacher/grade/' . $subject->id) ? 'active-collapse-item' : '' }}"
                            href="{{ route('teacher.grade.show', ['id' => $subject->id]) }}">{{ $subject->class_code }}
                        </a>
                    @empty
                        <a class="collapse-item mb-1" href="#">No Subjects
                        </a>
                    @endforelse

                </div>
            </div>
        </li>
        <!-- Heading -->
        <div class="sidebar-heading">
            Profile Settings
        </div>
        <li class="nav-item {{ Request::routeIs('teacher.settings.profile.changePassword.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('teacher.settings.profile.changePassword.index') }}">
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
