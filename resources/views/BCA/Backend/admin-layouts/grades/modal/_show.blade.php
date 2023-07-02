<div class="modal fade" id="show{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Grades of {{ $student->last_name }},
                    {{ $student->first_name }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover pb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="rowgroup" colspan="6" class="text-center">Quarterly
                                    Progress Report</th>
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
                            @php
                                $grades = $student
                                    ->grades()
                                    ->with('class')
                                    ->whereHas('class', function ($query) use ($student) {
                                        $query->where('sy_id', '=', $student->sy_id);
                                    })
                                    ->get();
                                $average = 0;
                                $totalFinalGrade = 0;
                                $subTotalSubjects = 0;
                                $totalSubjects = 0;
                                $hasFinalGrade = false;
                                foreach ($grades as $item) {
                                    $hasFinalGrade = false;
                                    if ($item->final_grade != null) {
                                        $hasFinalGrade = true;
                                        $subTotalSubjects++;
                                        $totalFinalGrade += $item->final_grade;
                                    }
                                    $totalSubjects++;
                                }
                                if ($subTotalSubjects == $totalSubjects && $hasFinalGrade == true) {
                                    $average = $totalFinalGrade / $totalSubjects;
                                }

                            @endphp
                            @forelse ($grades as $grade)
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
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No grades yet.
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
            <div class="modal-footer">
                <a href="{{ route('export.grade', ['id' => $student->id,'sy_id'=>$student->sy_id, 'isStudent' => 0]) }}"
                    class="btn btn-outline-primary">Download</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
