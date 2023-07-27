<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Grades</title>
    <!-- custom css -->
    {{-- <link href="{{ asset('assets/css/pdf.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="./assets/css/pdf.css" rel="stylesheet" type="text/css" /> 
    <style>
        html {
            margin: 30px;
        }
    </style>
</head>

<body>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="fw-bold text-center" style="position: relative; width: 100%">
                         <img src="./assets/img/BCA-Logo.png" alt="bca logo"
                            style="height: 70px; width:70px; position: absolute; left: 135px;">
                        <h3 class="mb-0">BREAKTHROUGH CHRISTIAN ACADEMY, INC</h3>
                        <small>Quezon City</small>
                    </th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bold text-nowrap">
                        LRN:
                    </td>
                    <td colspan="5" class="border-bottom">
                        <span class="fw-normal">{{ $student->student_lrn }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-nowrap">
                        Last Name:
                    </td>
                    <td colspan="5" class="border-bottom">
                        <span class="fw-normal text-uppercase">{{ $student->last_name }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-nowrap">
                        First Name:
                    </td>
                    <td colspan="5" class="border-bottom">
                        <span class="fw-normal text-uppercase">{{ $student->first_name }}</span>
                    </td>
                </tr>
                <tr class="m-0 p-0">
                    <td class="fw-bold text-nowrap">
                        Middle Name:
                    </td>
                    <td colspan="5" class="border-bottom">
                        <span class="fw-normal text-uppercase">{{ $student->middle_name }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-nowrap">
                        Grade:
                    </td>
                    <td colspan="5" class="border-bottom">
                        <span class="fw-normal text-uppercase">{{ $student->gradeLevel->name }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold text-nowrap">
                        Section:
                    </td>
                    <td colspan="5" class="border-bottom">
                        <span class="fw-normal text-uppercase">{{ $student->section->name }}</span>
                    </td>
                </tr>
            </tbody>
            @if (!$isStudent)
            @endif
        </table>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="6" class="text-center" style="width: 100%">
                        <span class="text-center fw-bold">QUARTERLY PROGRESS REPORT</span>
                    </th>
                </tr>
                <tr class="border-top border-end border-start">
                    <th></th>
                    <th colspan="4" class="text-center box">Rating Period
                    </th>
                    <th></th>
                </tr>
                <tr class="border-bottom border-end border-start">
                    <th class="text-center" style="position:relative; width: 100px">
                        <div style="position: absolute; top: -10px; left: 30%">
                            <span>
                                Subjects
                            </span>
                        </div>
                    </th>
                    <th class="text-center box ratings">1</th>
                    <th class="text-center box ratings">2</th>
                    <th class="text-center box ratings">3</th>
                    <th class="text-center box ratings">4</th>
                    <th class="text-center" style="position:relative; width: 100px">
                        <div style="position: absolute; top: -10px; left: 30%">
                            <span>
                                Average
                            </span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <td class="box text-capitalize">{{ $grade->class->subject->subject }}</td>
                        <td class="text-center box">{{ $grade->first_grading }}</td>
                        <td class="text-center box">{{ $grade->second_grading }}</td>
                        <td class="text-center box">{{ $grade->third_grading }}</td>
                        <td class="text-center box">{{ $grade->fourth_grading }}</td>
                        <td class="text-center box">{{ $grade->final_grade }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        @if (!$isStudent)
            {{-- another table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Grade Scale</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Advanced</td>
                        <td>90% and above</td>
                        <td>Passed</td>
                    </tr>
                    <tr>
                        <td>Proficient</td>
                        <td>85%-89%</td>
                        <td>Passed</td>
                    </tr>
                    <tr>
                        <td>Approaching Proficiency</td>
                        <td>80%-84%</td>
                        <td>Passed</td>
                    </tr>
                    <tr>
                        <td>Developing</td>
                        <td>75%-79%</td>
                        <td>Passed</td>
                    </tr>
                    <tr>
                        <td>Beginning</td>
                        <td>74% and below</td>
                        <td>Failed</td>
                    </tr>

                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr class="mt-3">
                        <th>Remarks:</th>
                    </tr>
                    <tr>
                        <th class="text-nowrap" style="width: 50px">First Grading</th>
                        <th colspan="5" class="border-bottom"></th>
                    </tr>
                    <tr>
                        <th colspan="6" class="border-bottom"></th>
                    </tr>
                    <tr>
                        <th class="text-nowrap" style="width: 50px">Second Grading</th>
                        <th colspan="5" class="border-bottom"></th>
                    </tr>
                    <tr>
                        <th colspan="6" class="border-bottom"></th>
                    </tr>
                    <tr>
                        <th class="text-nowrap" style="width: 50px">Third Grading</th>
                        <th colspan="5" class="border-bottom"></th>
                    </tr>
                    <tr>
                        <th colspan="6" class="border-bottom"></th>
                    </tr>
                    <tr>
                        <th class="text-nowrap" style="width: 50px">Fourth Grading</th>
                        <th colspan="5" class="border-bottom"></th>
                    </tr>
                    <tr>
                        <th colspan="6" class="border-bottom"></th>
                    </tr>
                </thead>
            </table>
        @endif
    </div>

</body>

</html>
