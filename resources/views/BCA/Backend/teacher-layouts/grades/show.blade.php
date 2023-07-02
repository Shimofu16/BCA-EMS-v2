@extends('BCA.Backend.teacher-layouts.index')

@section('page-title')
    {{ $section}}
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">

            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        @livewire('teacher.grades.input-grades', ['students' => $students])

    </div>
@endsection
@section('dashboard-javascript')
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#subject-table').DataTable({
                "ordering": "name",
            });
        });
    </script>
@endsection
