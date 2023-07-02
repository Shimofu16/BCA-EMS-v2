@extends('BCA.Frontend.index')

@section('css')
    <style>
        .card-h {
            height: 500px !important;
            width: 100%;
        }

        .academics-bg {
            position: relative;
            /* add this */
            background-image: url("/assets/img/students/junior highschool.jpg");
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* place this at the bottom of acadamics-bg */
        .academics-bg-overlay {
            position: absolute;
            /* add this */
            bottom: 0;
            left: 0;
            /* add this */
            width: 100%;
            max-height: 400px;
            background-color: rgba(9, 39, 214, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: bottom;
            padding: 30px;
        }
    </style>
@endsection
@section('title')
    Junior Highschool
@endsection
@section('page-title')
<li class="breadcrumb-item">Academics</li>
@endsection
@section('page-sub-title')
    <li class="breadcrumb-item" aria-current="page">@yield('title')</li>
@endsection
@section('contents')
    <section class="py-3 c-mt-nv">
        <div class="container mb-5">
            @include('BCA.Frontend.layouts._page-titles')
            <div class="row animate__animated animate__fadeInUp">
                <div class="col-md-8">
                    <div class="card bg-light rounded border-0 p-3">
                        <div class="card card-h mb-3">
                            <div class="card-body academics-bg card-img">
                                <div class="academics-bg-overlay card-img">
                                    <h2 class="text-white">Junior Highschool</h2>
                                    <p class="text-white text-center">Junior high school, also known as middle school, is
                                        typically a three-year educational program for students in grades 7, 8, and 9.
                                        During
                                        this time, students typically transition from elementary school to high school and
                                        begin
                                        to take more advanced coursework.
                                    </p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('enroll.index') }}" class="btn btn-outline-light">
                                            Enroll now
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @include('BCA.Frontend.pages.academics.partials._announcements')
                    </div>
                </div>
                <div class="col-md-4 c-d-sm-none">
                    @include('BCA.Frontend.layouts._side-nav')
                </div>
            </div>
        </div>
    </section>
@endsection
