<!DOCTYPE html>
<html lang="en">
@include('BCA.Frontend.layouts._head')

<body class="bg-contents">
    @include('BCA.Frontend.layouts._header')
    <main id="contents">
        @yield('contents')
    </main>
    @include('BCA.Frontend.layouts._footer')

    @include('BCA.Frontend.layouts._foot')
</body>

</html>
