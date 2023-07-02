@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    {{ $gallery->title }}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded  align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">Album - @yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.manage.gallery.index') }}" class="btn btn-secondary mr-1">
                    <i class="fas fa-chevron-circle-left"></i>&#160;
                    Back
                </a>

            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        @foreach ($gallery->photos as $photo)
            <div class="col-sm-5 col-md-5 col-lg-4">
                <div class="card shadow-sm">
                    <img class="rounded-3 card-img-200" style="height: 300px;" src="{{  asset($photo->path)   }}" alt="{{ $photo->photo }}">
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('dashboard-javascript')
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#photos-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
