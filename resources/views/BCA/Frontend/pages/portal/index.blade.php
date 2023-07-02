<!DOCTYPE html>
<html lang="en">

@include('BCA.Frontend.layouts._head')
<style>
    .form-bg {
        background-image: url("{{ asset('assets/img/form-bg.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100%;
    }

    .form-bg-overlay {
        background-color: rgb(45, 74, 246, 0.5);
        height: 100vh;
        width: 100%;
    }

    .of-hidden {
        overflow: hidden;
    }

    .form-logo {
        height: 100px;
        width: 100px;
    }

    .glass {
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.45);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(6.1px);
        -webkit-backdrop-filter: blur(6.1px);
    }
</style>

<body class="form-bg of-hidden">
    <div class="form-bg-overlay">
        @hasSection('forms')
            @yield('forms')
        @else
            {{ 'no forms' }}
        @endif
    </div>
    @include('sweetalert::alert')

</body>

</html>
