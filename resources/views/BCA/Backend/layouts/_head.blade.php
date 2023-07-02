<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> @yield('role') | @yield('page-title') </title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Package Styles-->
    <link href="/assets/packages/fontawesome-free-6.2.0-web/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/packages/hover-css/hover.css" />
    <link href="/assets/packages/Datatables/datatables.min.css" rel="stylesheet">
    <link href="/assets/packages/sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
    @livewireStyles
    <!-- Custom styles-->
    <link href="/assets/css/sb-admin/custom.css" rel="stylesheet">
    <style>
        .dropdown-item-active {
            background-color: #4e73df;
            color: white;
        }

        .dropdown-item-active:hover {
            background-color: #4e73df;
            color: white;
        }
    </style>
    @yield('dashboard-css')
    {{-- school logo --}}
    <link rel="icon" href="/assets/img/BCA-Logo.png">
</head>
