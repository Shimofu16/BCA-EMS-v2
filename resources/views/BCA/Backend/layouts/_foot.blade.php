    {{-- Package Scripts --}}
    <script src="{{ asset('assets/packages/jQuery-3.6.0/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('/assets/packages/sb-admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}"></script>
    <script src="{{ asset('/assets/packages/DataTables\DataTables-1.13.4\css\dataTables.bootstrap4.css') }}"></script>

    <script src="{{ asset('assets/packages/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/packages/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/packages/chart.js/chart.umd.js') }}"></script>
    <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>
    @include('sweetalert::alert')
    @livewireScripts
    {{-- Custom scripts --}}
    @stack('scripts')
    @yield('dashboard-javascript')
