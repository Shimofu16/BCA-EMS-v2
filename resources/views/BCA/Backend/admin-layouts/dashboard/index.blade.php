@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    Dashboard
@endsection
@section('contents')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{ route('admin.manage.backups.backup') }}" class="d-none d-sm-inline-block btn btn-outline-primary shadow-sm"><i class="fas fa-download fa-sm"></i> Generate Backup</a>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="{{ route('admin.manage.events.index') }}" class="card-body link-primary text-decoration-none">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Events</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $eventsCount }}</div>
                        </div>
                        <div class="col-auto ">
                            <i class="fa-solid fa-calendar-days fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
           
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="#" class="card-body link-primary text-decoration-none">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $studentsCount }}</div>
                        </div>
                        <div class="col-auto ">
                            <i class="fa-solid fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
           
        </div>
    </div>
    <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Recent Announcements</h6>
                <!-- <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Filter By:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div> -->
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($recentAnnouncements as $announcement)
                      <tr>
                        <td>{{ $announcement->title }}</td>
                        <td>{{ Str::limit($announcement->description, 100) }}</td>
                        <td>{{ $announcement->created_at->format('M d, Y') }}</td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="3" class="text-center">No announcements found.</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                  {{ $recentAnnouncements->links() }}
                </div>


            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Active users</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Filter By:</div>
                        <a class="dropdown-item" href="{{ route('admin.dashboard.index', ['selection' => 'Faculty']) }}">Faculty</a>
                        <a class="dropdown-item" href="{{ route('admin.dashboard.index', ['selection' => 'Student']) }}">Student</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.dashboard.index') }}">Reset</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Last Login</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($activeUsers as $user)
                          <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                  @if(Carbon\Carbon::parse($user->activeSession->last_activity)->diffInMinutes() <= 5)
                                    <span class="badge badge-success">Active</span>
                                  @else
                                    {{ Carbon\Carbon::parse($user->activeSession->last_activity)->diffForHumans() }}
                                  @endif
                            </td>
                          </tr>
                          @empty
                          <tr>
                              <td colspan="3">
                                  <span class="text-center">
                                      No Active Users
                                  </span>
                              </td>
                          </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection
