@extends('BCA.Backend.student-layouts.index')

@section('page-title')
    Grades
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center justify-content-between mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 py-3 mb-0">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                {{-- download button fir grades --}}
               <a href="{{ route('export.grade', ['id' => Auth::user()->student->id, 'sy_id' => $sy_id, 'isStudent' => 1]) }}"
                    class="btn btn-outline-primary {{ $isPaid ? '' : 'disabled' }}">
                    <i class="fa-solid fa-download"></i>
                    Download
                </a>
            </div>
        </div>
    </div>
    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover pb-0">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th scope="rowgroup" colspan="4" class="text-center">Quarterly
                                Progress Report</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th scope="rowgroup" colspan="4" class="text-center">Rating Period
                            </th>
                            <th></th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center">Subject</th>
                            <th scope="rowgroup" class="text-center">1</th>
                            <th scope="rowgroup" class="text-center">2</th>
                            <th scope="rowgroup" class="text-center">3</th>
                            <th scope="rowgroup" class="text-center">4</th>
                            <th scope="col" class="text-center">Final Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grades as $grade)
                            @if ($grade->class->sy_id == $sy_id)
                                <tr>
                                    <td>
                                        {{ $grade->class->subject->subject }}
                                    </td>
                                    <td class="text-center">
                                        {{ $grade->first_grading }}
                                    </td>
                                    <td class="text-center">
                                        {{ $grade->second_grading }}
                                    </td>
                                    <td class="text-center">
                                        {{ $grade->third_grading }}
                                    </td>
                                    <td class="text-center">
                                        {{ $grade->fourth_grading }}
                                    </td>
                                    <td class="text-center">
                                        @if (round($grade->final_grade) != 0)
                                            {{ round($grade->final_grade) }}
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No grades yet
                                    </td>
                                </tr>
                                @break
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No grades yet
                                </td>
                            </tr>
                        @endforelse

                        <tr>
                            <td colspan="6">
                                <div class="row">
                                    <h5 class="text-right pr-5">General
                                        Average:{{ round($average) != 0 ? round($average) : '' }}</h5>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
