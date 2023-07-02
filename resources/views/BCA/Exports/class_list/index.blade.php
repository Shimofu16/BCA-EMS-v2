<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Class List</title>

    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/packages/bootstrap/css/bootstrap.min.css') }}" type="text/css" /> --}}

    <!-- custom css -->
    {{-- <link href="{{ asset('assets/css/pdf.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="./assets/css/pdf.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                         <img src="./assets/img/BCA-Logo.png" alt="bca logo"
                            style="height: 60px; width:60px;">
                    </th>
                    <th class="fw-bold text-center">
                        <h3 class="mb-0">BREAKTHROUGH CHRISTIAN ACADEMY</h3>
                        <small>9006 Eagle St., Area 3, Sitio Veterans, Brgy. Bagong Silangan, Quezon City</small>
                    </th>
                    <th>

                    </th>
                </tr>
                <tr>
                    <th colspan="3" class="fw-bold text-center">
                        <h4 class="mb-1 mt-0">CLASS LIST</h4>
                        <small>SY: {{ $sy->name }}</small>
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="header">No.</th>
                    <th scope="col" class="header">Name</th>
                    <th scope="col" class="header">Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td scope="row" class="bordered-body">{{ $loop->index + 1 }}</td>
                        <td class="bordered-body">{{ Str::ucfirst($student->last_name) }}, {{ Str::ucfirst($student->first_name) }}
                            {{ Str::ucfirst($student->middle_name) }}</td>
                        <td class="bordered-body">{{ $student->gender }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
