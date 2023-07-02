@extends('BCA.Frontend.index')

@section('title')
    Announcements
@endsection
@section('page-title')
    <li class="breadcrumb-item" aria-current="page">Announcements</li>
@endsection
@section('contents')
    <section class="py-3 c-mt-nv">
        <div class="container mb-5">
            @include('BCA.Frontend.layouts._page-titles')
            <div class="row py-3 animate__animated animate__fadeInUp">
                <div class="col-md-8">
                    <div class="d-flex flex-column bg-light p-3 rounded">
                        @forelse ($announcements as $announcement)
                            <div class="card">
                                <div class="card-header bg-transparent border-0">
                                    <h3 class="card-title text-blue">{{ $announcement->title }}</h3>
                                    <small class="text-muted"><i class="fa-solid fa-clock"></i> &nbsp; Date:
                                        {{ date('F d, Y', strtotime($announcement->created_at)) }}</small>
                                </div>
                                <div class="card-body pt-0">

                                    <img class="card-img-top card-img-400 mb-3" src="{{ asset($announcement->path) }}"
                                        alt="{{ $announcement->photo }}">
                                    <div class="text">
                                        <p class="card-text">{{ $announcement->description }}</p>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent border-0 d-flex justify-content-end py-3">

                                    <a href="{{ route('announcement.show', ['id' => $announcement->id]) }}"
                                        class="btn btn-outline-bca mb-3">More Info.</a>
                                </div>
                            </div>
                            @if (!$loop->last)
                                <hr class="my-5">
                            @endif
                        @empty
                            <h3 class="p-5 text-center">No Announcment Available</h3>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-4 c-d-sm-none">
                    @include('BCA.Frontend.layouts._side-nav')
                </div>
            </div>
        </div>
    </section>
@endsection
