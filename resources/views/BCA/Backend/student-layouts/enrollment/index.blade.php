@extends('BCA.Backend.student-layouts.index')

@section('page-title')
    Enrolment Form
@endsection
@section('dashboard-css')
    @livewireStyles()
@endsection
@section('contents')
    <div class="row">
        <div class="col-md-7">
            <div class="card bg-transparent border-0 shadow-none">
                <div class="card-header text-center bg-bca text-white p-3 mb-3 shadow">
                    <h2 class="py-3 text-capitalize">BCA Online Enrolment Form</h2>
                </div>
                @livewire('backend.student.enrollment-form', ['student' => $student, 'guardian' => $guardian, 'isEnrollment' => $isEnrollment])
            </div>

        </div>
    </div>
@endsection
@section('dashboard-javascript')
    @livewireScripts()
    @stack('scripts')
@endsection
