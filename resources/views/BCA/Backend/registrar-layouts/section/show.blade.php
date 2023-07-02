@extends('BCA.Backend.registrar-layouts.index')

@section('page-title')
    Sections
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">{{ $title->section_name }}</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary mr-2">
                    <span class="d-flex align-items-center"><i class="fas fa-chevron-circle-left"></i>&#160;Back</span>
                </a>
                <a href="{{ route('export.class.list', ['id' => $title->id]) }}" class="btn btn-outline-primary">
                    <span class="d-flex align-items-center">
                        <i class="fa-solid fa-file-pdf"></i>
                        &#160; Class list</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="section-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td> {{ $loop->index + 1 }}</td>
                                <td> {{ $student->student_id }}</td>
                                <td> {{ $student->first_name }}
                                    {{ $student->middle_name }},
                                    {{ $student->last_name }}
                                    </h5>
                                <td> {{ $student->gender }}</td>
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
    {{-- bakit wala to pota --}}
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#section-table').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection
