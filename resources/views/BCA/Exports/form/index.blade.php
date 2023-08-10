<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- custom css -->
    <link href="/assets/css/pdf.css" rel="stylesheet" type="text/css" />
</head>

<body>
    @foreach ($copies as $copy)
        <table class="table">

            <thead>
                <tr>
                    <th class="text-center" colspan="3">
                        <div style="position: relative;">
                            <img src="{{ asset('assets/img/BCA-Logo.png') }}" alt="bca logo"
                                style="height: 60px; width:60px; position: absolute; top:11px; left: 10px" />
                            <h3 class="fw-bold">BREAKTHROUGH CHRISTIAN ACADEMY</h3>
                            <span class="fw-normal">9006 Eagle St., Area 3, Sitio Veterans, Brgy. Bagong
                                Silangan, Quezon City</span>
                        </div>
                    </th>
                </tr>
                <tr class="bg-gray rounded">
                    <th class="text-center" colspan="3">
                        <h4 class="my-0 text-uppercase">{{ $title }} FORM - {{ $copy }} COPY</h4>
                    </th>
                </tr>
                <tr>
                    <th class="text-center" colspan="3">
                        @if (Str::contains(Str::lower($title), 'payment'))
                            @switch($gt)
                                @case(1)
                                    <span class="fw-bold">Preschool</span>
                                @break

                                @case(2)
                                    <span class="fw-bold">Elementary</span>
                                @break

                                @case(3)
                                    <span class="fw-bold">Junior High School</span>
                                @break
                            @endswitch
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr scope="row" class="text-center border-top border-x">
                    <!-- only show the new lerner if the student`s grade level is in primary -->
                    @if (Str::contains(Str::lower($title), 'payment'))
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $st == 1 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>New Learner</span>
                            </div>
                        </td>
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $st == 2 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Old Learner</span>
                            </div>
                        </td>
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $st == 3 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Transfer Learner</span>
                            </div>
                        </td>
                    @elseif (Str::contains(Str::lower($title), 'enrollment'))
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $gt == 1 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Preschool</span>
                            </div>
                        </td>
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $gt == 2 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Elementary</span>
                            </div>
                        </td>
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $gt == 3 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Junior High School</span>
                            </div>
                        </td>
                    @endif

                </tr>
                <tr scope="row" class="border-x">
                    <td>
                        <div class="no-wrap">
                            <span class="fw-bold">Student No/LRN:</span>
                            <span
                                class="border-bottom">{{ empty($student['lrn']) ? $student['student_id'] : $student['lrn'] }}</span>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="no-wrap">
                            <span class="fw-bold">Incoming Grade Level:</span>
                            <span class="border-bottom">{{ $student['grade_level'] }}</span>
                        </div>
                    </td>
                </tr>
                <tr scope="row" class="border-bottom border-x">
                    <td>
                        <div class="no-wrap">
                            <span class="fw-bold">School Year:</span>
                            <span class="border-bottom">{{ $sy->name }}</span>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr scope="row" class="border-x">
                    <td class="text-start">
                        <div class="no-wrap">
                            <span class="fw-bold">Last Name:</span>
                            <span class="border-bottom">{{ $student['last_name'] }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="no-wrap">
                            <span class="fw-bold">First Name:</span>
                            <span class="border-bottom">{{ $student['first_name'] }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="no-wrap text-center">
                            <span class="fw-bold">MI:</span>
                            <span class="border-bottom">{{ $student['mi'] }}</span>
                        </div>
                    </td>
                </tr>
                <tr scope="row" class="border-x">
                    <td colspan="3">
                        <div class="no-wrap">
                            <span class="fw-bold">Address:</span>
                            <span class="border-bottom">{{ $student['address'] }}</span>
                        </div>
                    </td>
                </tr>
                <tr scope="row" class="border-x">
                    <td colspan="2">
                        <div class="no-wrap">
                            <span class="fw-bold">Birthplace:</span>
                            <span class="border-bottom">{{ $student['birthplace'] }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="no-wrap">
                            <span class="fw-bold">Birthday:</span>
                            <span class="border-bottom">{{ date('F d, Y', strtotime($student['birth_date'])) }}</span>
                        </div>
                    </td>
                </tr>
                <tr scope="row" class="border-x border-top">
                    <td colspan="3">
                        <span class="mb-0 fw-bold">Guardian Details:</span>
                    </td>
                </tr>
                <tr scope="row" class="border-x">
                    <td colspan="2">
                        <div class="no-wrap">
                            <span class="fw-bold">Name:</span>
                            <span class="border-bottom">{{ $guardian['name'] }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="no-wrap">
                            <span class="fw-bold">Contact No.:</span>
                            <span class="border-bottom">{{ $guardian['contact'] }}</span>
                        </div>
                    </td>
                </tr>
                <tr scope="row" class="border-x">
                    <td colspan="2">
                        <div class="no-wrap">
                            <span class="fw-bold">Address:</span>
                            <span class="border-bottom">{{ $guardian['address'] }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="no-wrap">
                            <span class="fw-bold">Email:</span>
                            <span class="border-bottom">{{ $guardian['email'] }}</span>
                        </div>
                    </td>
                </tr>
                @if (Str::contains(Str::lower($title), 'payment'))
                    <tr scope="row" class="border-x border-top">
                        <td colspan="3">
                            <span class="mb-0 fw-bold">Payment method:</span>
                        </td>
                    </tr>
                    <tr scope="row" class="border-x">
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $pm == 1 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Annual</span>
                            </div>
                        </td>
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $pm == 2 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Semi-Annual</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr scope="row" class="border-x">
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $pm == 3 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Quarterly</span>
                            </div>
                        </td>
                        <td>
                            <div class="no-wrap">
                                <span class="box {{ $pm == 4 ? 'shaded' : '' }}"> &nbsp; &nbsp; &nbsp;</span>
                                <span>Monthly</span>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                @endif
                <tr scope="row" class="border-x border-top">
                    <td colspan="3">
                        <span class="mb-0 fw-normal">I certify that the information above are true and
                            correct.</span>
                    </td>
                </tr>
                <tr scope="row" class="border-x box">
                    <td class="text-end py-4 border-end" style="position: relative; height: 70px">
                        <small class="fw-bold" style="position: absolute; bottom: 5px; right: 10px">Date</small>
                    </td>
                    <td class="text-end py-4 border-end" style="position: relative; height: 70px">
                        <small class="fw-bold" style="position: absolute; bottom: 5px; right: 10px">Date</small>
                    </td>
                    <td class="text-end py-4 border-end" style="position: relative; height: 70px">
                        <small class="fw-bold" style="position: absolute; bottom: 5px; right: 10px">Date</small>
                    </td>
                </tr>
                <tr scope="row">
                    <td>
                        <small class="mb-0 fw-normal">Parent / Guardian Signature</small>
                    </td>
                    <td>
                        <small class="mb-0 fw-normal">Head Teacher</small>
                    </td>
                    <td>
                        <small class="mb-0 fw-normal">Admin Officer</small>
                    </td>
                </tr>
                <tr scope="row">
                    <td colspan="3">
                        <span class="fw-bold">NOTE: Reservation fee upon enrolment is non-refundable.
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr class="{{ !$loop->last ? 'page-break' : '' }} border-dashed">
        </hr>
    @endforeach
</body>

</html>
