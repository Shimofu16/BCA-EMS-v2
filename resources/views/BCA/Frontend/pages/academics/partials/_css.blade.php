@section('css')
    <style>
        .card-h {
            height: 500px !important;
            width: 100%;
        }

        .academics-bg {
            position: relative;
            /* add this */
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
    @yield('academics-css')
@endsection
