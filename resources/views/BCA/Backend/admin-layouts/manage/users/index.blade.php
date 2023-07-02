@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    {{ $title }}
@endsection

@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            @if ($type == 'faculty')
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#add">
                        <span class="d-flex align-items-center"><i class="fas fa-plus-circle"></i>&#160; Add User</span>
                    </button>
                    @include('BCA.Backend.admin-layouts.manage.users.modal._add')
                </div>
            @endif
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="users-table">
                    <thead class="thead-light">
                        <tr>
                            @if ($type == 'student')
                                <th scope="col">Student ID</th>
                            @endif
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            @if ($type == 'faculty')
                                <th scope="col">Roles</th>
                            @endif
                            <th scope="col" class="text-center">Status (Online/Offline)</th>
                            <th scope="col" class="text-center">Logs</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @if ($type == 'student')
                                    <td>{{ $user->student->student_id }}</td>
                                @endif
                                <td>
                                    <div class="d-flex flex-column px-2 py-1">
                                        <h5 class="mb-0 text-sm"> {{ $user->getName() }}
                                        </h5>
                                        <p class="text-sm text-secondary mb-0">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </td>
                                <td>{{ $user->getGender() }}</td>
                                @if ($type == 'faculty')
                                    <td>
                                        <div class="d-flex flex-column px-2 py-1">
                                            <p class="text-sm text-secondary mb-0">
                                                {{ $user->first->name }} {{ $user->second->name ? '/' : '' }}
                                                {{ $user->second->name }}
                                            </p>
                                        </div>
                                    </td>
                                @endif
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        @if ($user->status == 'online')
                                            <a
                                                class="btn btn-sm btn-success rounded pointer-event-none">&nbsp;Online&nbsp</a>
                                        @elseif ($user->status == 'offline')
                                            <a
                                                class="btn btn-sm btn-secondary rounded pointer-event-none">&nbsp;Offline&nbsp</a>
                                        @elseif ($user->status == 'deactivated')
                                            <a
                                                class="btn btn-sm btn-danger rounded pointer-event-none">&nbsp;Deactivated&nbsp</a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('admin.manage.user.show', ['id' => $user->id,'type' => $type]) }}"
                                            class="btn btn-sm btn-outline-info mr-1">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            View
                                        </a>

                                    </div>
                                </td>
                                <td>

                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-outline-primary btn-sm mr-1"
                                                data-toggle="modal" data-target="#edit{{ $user->id }}"><i
                                                    class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                            @include('BCA.Backend.admin-layouts.manage.users.modal._edit')
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger {{ $user->status == 'online' ? '' : 'disabled pointer-event-none' }}"
                                                data-toggle="modal" data-target="#logout{{ $user->id }}">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
                                            @include('BCA.Backend.admin-layouts.manage.users.modal._logoutUser')
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
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#users-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
