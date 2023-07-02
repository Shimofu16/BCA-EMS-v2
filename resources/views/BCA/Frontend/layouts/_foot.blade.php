@if (Request::routeIs(['home.index', 'about.*', 'academic.*', 'gallery.*', 'announcement.*', 'calendar.*']))
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0"
        nonce="FMMpwHAt"></script>
    <script src="/assets/packages/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{ asset('assets/packages/jQuery-3.6.0/jquery-3.6.0.min.js') }}"></script>
    <script src="/assets/js/home/app.js"></script>
    @yield('js')
    @if (Request::routeIs(['about.*', 'academic.*', 'gallery.*', 'announcement.*', 'calendar.*']))
        <script>
              $(document).ready(function() {
                  $(".navbar-toggler-icon").css("color", "black");
                  $(".navbar-toggler").css("color", "black");
                  $(".navbar-toggler").css("border-color", "black");
              });
        </script>
    @endif

@endif
@if (Request::routeIs('enroll.index'))
    {{-- Livewire JS --}}
    @include('sweetalert::alert')
    @livewireScripts
    @stack('scripts')
@endif
