@extends('BCA.Frontend.index')

@section('title')
    Calendar
@endsection
@section('page-title')
    <li class="breadcrumb-item" aria-current="page">Calendar</li>
@endsection
@section('css')
    <link rel="stylesheet" href="/assets/packages/plain-admin-full-calendar/main.css" />
    <link rel="stylesheet" href="/assets/packages/plain-admin-full-calendar/fullcalendar.css" />
@endsection
@section('contents')
    <section class="py-3 c-mt-nv">
        <div class="container mb-5">
            @include('BCA.Frontend.layouts._page-titles')
            <div class="row animate__animated animate__fadeInUp">
                <div class="col-lg-12">
                    <div class="card-style calendar-card mb-5">
                        <div id="calendar-full" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="/assets/packages/plain-admin-full-calendar/fullcalendar.js"></script>
     <script>
        // ====== calendar activation
        document.addEventListener("DOMContentLoaded", function() {
            var calendarFullEl = document.getElementById("calendar-full");
            var calendarFull = new FullCalendar.Calendar(calendarFullEl, {
                timeZone: 'Asia/Manila',
                initialView: "dayGridMonth",
                themeSystem: 'standard',
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: ""
                },
                events: [
                    @foreach ($events as $event)
                        {
                            title: '{{ $event->title }}',
                            start: '{{ $event->start }}{{ $event->time != null ? 'T' . $event->time : null }}',
                            end: '{{ $event->end }}',
                            url: '',
                            color: '{{ $event->color != null ? $event->color : '#2e45e0' }}',
                        },
                    @endforeach
                ],

            });
            calendarFull.render();

        });
    </script>
@endsection
