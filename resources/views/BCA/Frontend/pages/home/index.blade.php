@extends('BCA.Frontend.index')
@section('css')
<style>
    /* generate media query for tablet and pc above */
    @media (min-width: 768px) {
        .blue-arrow-bg{

        }
    }
</style>
@endsection
@section('contents')
    <section class="bca-background">
        <div class="bca-background-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-3">
                        <h1 class="home-title text-white">
                            Breakthrough Christian Academy
                        </h1>
                        <h1 class="home-sub-title text-white">
                            "...knowledge through diligent study, wisdom through faith in
                            God..."
                        </h1>
                        <a href="{{ route('enroll.index') }}" class="btn btn-outline-light">
                            <h4 class="mb-0">Enroll Now</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-blue">
        <div class="container">
            <div class="row p-5">
                <div class="col-auto ms-auto">
                    <iframe
                        src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FBreakthroughChristianAcademy%2Fvideos%2F1179801739398768%2F&show_text=false&width=560&t=0"style="border:none;" scrolling="no" frameborder="5" allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                        allowFullScreen="true" class="w-100 mh-100 overflow-hidden"></iframe>
                </div>
                <div class="col-auto me-auto">
                    <div class="d-flex flex-column text-center text-white py-3" style="max-width: 560px;">
                        <h4>Welcome to BCA!</h4>
                        <span>Breakthrough Christian Academy, Inc. is a private educational institution in Quezon City,
                            dedicated to providing quality education and breaking the cycle of poverty through
                            faith-based learning.</span>
                        <a href="{{ route('about.history.index') }}" class="btn btn-sm btn-outline-light mx-auto mt-2">Read more.</a>
                    </div>
                </div>


            </div>

        </div>
    </section>
    <section class="py-3">
        <div class="container mt-5">
            <div class="row my-3 justify-content-between align-items-center">
                <div class="col-auto">
                    <h1>Announcements</h1>
                </div>

                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('announcement.index') }}" class="btn btn-outline-bca">More Announcements</a>
                    </div>
                </div>
            </div>
            <div class="row g-3" id="annoincement">
                @foreach ($announcements as $announcement)
                    <div class="col-md-6 col-sm-4 col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent border-0 p-2">
                                <img src="{{ asset($announcement->path) }}" alt="{{ $announcement->photo }}"
                                    class="card-img-top card-img-full" />
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column mb-2">
                                    <h5 class="card-title">{{ $announcement->title }}</h5>
                                    <small
                                        class="text-muted">{{ date('M d, Y', strtotime($announcement->created_at)) }}</small>
                                </div>
                                <div class="text-container">
                                    <p class="card-text text-overflow-ellipsis">
                                        {{ $announcement->description }}
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('announcement.show', ['id' => $announcement->id]) }}"
                                        class="btn btn-link ps-0">More Info.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <hr />
        </div>
    </section>

    <section>
        <div class="container">
            <hr />
        </div>
    </section>
    <section class="py-3">
        <div class="container my-3 ">
            <div class="row my-3 justify-content-between align-items-center">
                <div class="col-auto">
                    <h1>Photo Gallery</h1>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('gallery.index') }}" class="btn btn-outline-bca">More Photos</a>
                    </div>
                </div>
            </div>
            <div class="row g-3" id="photos">
                @foreach ($albums as $album)
                    <div class="col-md-4 col-sm-4 ">
                        <a href="{{ route('gallery.show', ['id' => $album->id]) }}" class="text-decoration-none text-dark">
                            <div class="card shadow-sm">
                                <img class="card-img-top card-img-full-2" src="{{ asset($album->path) }}"
                                    alt="{{ $album->photo }}" />
                                <div class="card-body">
                                    <h4 class="card-title">{{ $album->title }}</h4>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">{{ date('M d, Y', strtotime($album->date)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            /* get the scroll function? */
            $(window).scroll(function() {
                /* check if user scroll to the top or not */
                if ($(window).scrollTop()) {
                    /* yex, change the backgraound of navigation bar to transparent */
                    $("#navigation").removeClass("navbar-transparent");
                    $("#navigation").addClass("navbar-white");
                    /* change the style text color and border color*/
                    $(".navbar-toggler-icon").css("color", "black");
                    $(".navbar-toggler").css("color", "black");
                    $(".navbar-toggler").css("border-color", "black");
                } else {
                    /* not, change the backgraound of navigation bar to white */
                    $("#navigation").removeClass("navbar-white");
                    $("#navigation").addClass("navbar-transparent");
                    /* change the style text color and border color*/
                    $(".navbar-toggler-icon").css("color", "white");
                    $(".navbar-toggler").css("color", "white");
                    $(".navbar-toggler").css("border-color", "white");
                }
            });
        });
    </script>
    <script>
        // When the document is ready, create an IntersectionObserver instance.
        $(document).ready(function() {
            var observer = new IntersectionObserver(function(entries) {
                // The callback function will be called every time an element is observed.
                // This callback function is passed an array of IntersectionObserverEntry objects.
                // Each object represents an element that has been observed.
                entries.forEach(function(entry) {
                    // If the element is visible, add the animated class to it.
                    if (entry.isIntersecting) {
                        if (entry.target.id === 'annoincement') {
                            entry.target.classList.add('animate__animated',
                                'animate__fadeInLeft');
                        } else if (entry.target.id === 'featured-videos') {
                            entry.target.classList.add('animate__animated',
                                'animate__fadeInRight');
                        } else if (entry.target.id === 'photos') {
                            entry.target.classList.add('animate__animated',
                                'animate__fadeInLeft');
                        }
                    }
                });
            }, {
                // When the element is 0% visible, the callback function will be called.
                threshold: [0]
            });

            // Observe the elements with the ids 'annoincement', 'featured-videos', and 'photos'.
            observer.observe(document.getElementById('annoincement'));
            observer.observe(document.getElementById('featured-videos'));
            observer.observe(document.getElementById('photos'));
        });
    </script>
@endsection
