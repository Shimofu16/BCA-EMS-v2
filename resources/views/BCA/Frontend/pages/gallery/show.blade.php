@extends('BCA.Frontend.index')
@section('title')
    <span class="text-bca">{{ $gallery->title }}</span>
@endsection
@section('page-title')
    <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Gallery</a></li>
@endsection
@section('page-sub-title')
    <li class="breadcrumb-item" aria-current="page">{{ $gallery->title }}</li>
@endsection
@section('contents')
    <section class="py-3 c-mt-nv">
        <div class="container mb-5">
            @include('BCA.Frontend.layouts._page-titles')
            <div class="row gx-3 py-3 bg-light rounded animate__animated animate__fadeInUp">
                @foreach ($gallery->photos as $photo)
                    <div class="col-sm-5 col-md-5 col-lg-4">
                        <div class="card shadow-sm">
                            <img class="rounded-3 card-img-200" src="{{ asset($photo->path) }}" alt="{{ $photo->photo }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
