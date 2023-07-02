@extends('BCA.Frontend.index')

@section('title')
    {{ $announcement->title }}
@endsection
@section('page-title')
    <li class="breadcrumb-item"><a href="{{ route('announcement.index') }}">Announcements</a></li>
@endsection
@section('page-sub-title')
    <li class="breadcrumb-item" aria-current="page">{{ $announcement->title }}</li>
@endsection
@section('contents')
    <section class="py-3 c-mt-nv">
        <div class="container mb-4">
            @include('BCA.Frontend.layouts._page-titles')

            <div class="row py-3 animate__animated animate__fadeInUp">
                <div class="col-md-8">
                    <div class="card bg-light border-0">
                        <div class="card-header bg-transparent border-0">
                            <img class="card-img-top card-img-400 mb-3 mt-2" src="{{ asset($announcement->path) }}"
                                alt="{{ $announcement->photo }}">
                        </div>
                        <div class="card-body pt-0">
                            <div class="title mb-3">
                            <h3 class="card-title text-blue">{{ $announcement->title }}</h3>
                            <small class="text-muted"><i class="fa-solid fa-clock"></i> &nbsp; Date:
                                {{ date('F d, Y', strtotime($announcement->created_at)) }}</small>
                            </div>
                            <div class="text">
                                <p class="card-text">{{ $announcement->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 c-d-sm-none">
                    @include('BCA.Frontend.layouts._side-nav')
                </div>
            </div>
        </div>
    </section>
@endsection
