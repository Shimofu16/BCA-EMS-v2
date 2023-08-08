<div class="card shadow-none p-0 border-0 ">
    <div class="card-header d-flex justify-content-between align-items-center">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <button type="button" class="nav-link {{ $currentGrading == 1 ? 'active' : ' bg-transparent' }}"
                    wire:click='first'>1st
                    Grading</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link  {{ $currentGrading == 2 ? 'active' : ' bg-transparent' }}"
                    {{ $isDoneFirstGrading ? '' : 'disabled' }} wire:click='second'>2nd Grading</a>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link {{ $currentGrading == 3 ? 'active' : ' bg-transparent' }}"
                    {{ $isDoneSecondGrading ? '' : 'disabled' }} wire:click='third'>3rd Grading</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link  {{ $currentGrading == 4 ? 'active' : ' bg-transparent' }}"
                    {{ $isDoneThirdGrading ? '' : 'disabled' }} wire:click='fourth'>4th Grading</button>
            </li>
        </ul>
        {{-- summary button --}}
        <div>
            <button type="button" class="btn btn-sm  btn-outline-primary" wire:click="summary()">
                <i class="fas fa-chart-line"></i> Summary
            </button>
        </div>
    </div>
    <div class="card-body bg-transparent">
        <div class="row">
            <div class="col-12">
                @if ($summary_mode)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="text-center">First Grading</th>
                                    <th scope="col" class="text-center">Second Grading</th>
                                    <th scope="col" class="text-center">Third Grading</th>
                                    <th scope="col" class="text-center">Fourth Grading</th>
                                    <th scope="col" class="text-center">Final Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->student->student_id }}</td>
                                        <td>
                                            <div class="d-flex flex-column px-2 py-1">
                                                <h5 class="mb-0">
                                                    {{ ucfirst($student->student->last_name) }},
                                                    {{ ucfirst($student->student->first_name) }}
                                                    {{ ucfirst($student->student->middle_name) }}
                                                </h5>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ $student->first_grading }}
                                        </td>
                                        <td class="text-center">
                                            {{ $student->second_grading }}
                                        </td>
                                        <td class="text-center">
                                            {{ $student->third_grading }}
                                        </td>
                                        <td class="text-center">
                                            {{ $student->fourth_grading }}
                                        </td>
                                        <td class="text-center">
                                            {{ round($student->final_grade) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Grade</th>
                                </tr>
                            </thead>
                            @switch($currentGrading)
                                @case(1)
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    {{ $student->student->student_id }}
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column px-2 py-1">
                                                        <h5 class="mb-0">
                                                            {{ ucfirst($student->student->last_name) }},
                                                            {{ ucfirst($student->student->first_name) }}
                                                            {{ ucfirst($student->student->middle_name) }}
                                                        </h5>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if (empty($student->first_grading))
                                                            <input type="text"
                                                                class="form-control w-25  @error('grades.' . $student->id . '.grade') is-invalid @enderror"
                                                                wire:model="grades.{{ $student->id }}.grade" required>
                                                            @if ($preview_mode)
                                                                <span class="ml-3">
                                                                    Current Grade: {{ $currentGrades[$student->id]['grade'] }}
                                                                </span>
                                                            @endif
                                                            @error('grades.' . $student->id . '.grade')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        @else
                                                            <span class="mr-3">
                                                                {{ $student->first_grading }}
                                                            </span>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @break

                                @case(2)
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    {{ $student->student->student_id }}
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column px-2 py-1">
                                                        <h5 class="mb-0">
                                                            {{ ucfirst($student->student->last_name) }},
                                                            {{ ucfirst($student->student->first_name) }}
                                                            {{ ucfirst($student->student->middle_name) }}
                                                        </h5>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if (empty($student->second_grading))
                                                            <input type="text"
                                                                class="form-control w-25  @error('grades.' . $student->id . '.grade') is-invalid @enderror"
                                                                wire:model="grades.{{ $student->id }}.grade" required>
                                                            @if ($preview_mode)
                                                                <span class="ml-3">
                                                                    Current Grade: {{ $currentGrades[$student->id]['grade'] }}
                                                                </span>
                                                            @endif
                                                            @error('grades.' . $student->id . '.grade')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        @else
                                                            <span class="mr-3">{{ $student->second_grading }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @break

                                @case(3)
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    {{ $student->student->student_id }}
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column px-2 py-1">
                                                        <h5 class="mb-0">
                                                            {{ ucfirst($student->student->last_name) }},
                                                            {{ ucfirst($student->student->first_name) }}
                                                            {{ ucfirst($student->student->middle_name) }}
                                                        </h5>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if (empty($student->third_grading))
                                                            <input type="text"
                                                                class="form-control w-25  @error('grades.' . $student->id . '.grade') is-invalid @enderror"
                                                                wire:model="grades.{{ $student->id }}.grade" required>
                                                            @if ($preview_mode)
                                                                <span class="ml-3">
                                                                    Current Grade: {{ $currentGrades[$student->id]['grade'] }}
                                                                </span>
                                                            @endif
                                                            @error('grades.' . $student->id . '.grade')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        @else
                                                            <span class="mr-3">{{ $student->third_grading }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @break

                                @case(4)
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    {{ $student->student->student_id }}
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column px-2 py-1">
                                                        <h5 class="mb-0">
                                                            {{ ucfirst($student->student->last_name) }},
                                                            {{ ucfirst($student->student->first_name) }}
                                                            {{ ucfirst($student->student->middle_name) }}
                                                        </h5>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if (empty($student->fourth_grading))
                                                            <input type="text"
                                                                class="form-control w-25  @error('grades.' . $student->id . '.grade') is-invalid @enderror"
                                                                wire:model="grades.{{ $student->id }}.grade" required>
                                                            @if ($preview_mode)
                                                                <span class="ml-3">
                                                                    Current Grade: {{ $currentGrades[$student->id]['grade'] }}
                                                                </span>
                                                            @endif
                                                            @error('grades.' . $student->id . '.grade')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        @else
                                                            <span class="mr-3"
                                                                wire:click=>{{ $student->fourth_grading }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @break

                                @default
                            @endswitch
                            <tfoot>
                                @if ($errors->any())
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            @foreach ($errors->getMessages() as $errorsArray)
                                                @foreach ($errorsArray as $error)
                                                    <span class="text-white bg-danger p-2 rounded mt-3 mb-3">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        {{ $error }}
                                                    </span>
                                                @endforeach
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                            </tfoot>
                        </table>
                        @if ($currentGrading == 1 && $firstGrading == false)
                            <div class="buttons d-flex justify-content-end align-items-center">
                                @if ($preview_mode)
                                    <span class="text-gray-500 mr-3">You are currently in preview mode. The grades can
                                        be
                                        reviewed and changed.</span>
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='save'>Save</button>
                                @else
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='preview'>Preview</button>
                                @endif
                            </div>
                        @endif
                        @if ($currentGrading == 2 && $secondGrading == false)
                            <div class="buttons d-flex justify-content-end align-items-center">
                                @if ($preview_mode)
                                    <span class="text-gray-500 mr-3">You are currently in preview mode. The grades can
                                        be
                                        reviewed and changed.</span>
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='save'>Save</button>
                                @else
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='preview'>Preview</button>
                                @endif
                            </div>
                        @endif
                        @if ($currentGrading == 3 && $thirdGrading == false)
                            <div class="buttons d-flex justify-content-end align-items-center">
                                @if ($preview_mode)
                                    <span class="text-gray-500 mr-3">You are currently in preview mode. The grades can
                                        be
                                        reviewed and changed.</span>
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='save'>Save</button>
                                @else
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='preview'>Preview</button>
                                @endif
                            </div>
                        @endif
                        @if ($currentGrading == 4 && $fourthGrading == false)
                            <div class="buttons d-flex justify-content-end align-items-center">
                                @if ($preview_mode)
                                    <span class="text-gray-500 mr-3">You are currently in preview mode. The grades can
                                        be
                                        reviewed and changed.</span>
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='save'>Save</button>
                                @else
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='preview'>Preview</button>
                                @endif
                            </div>
                            {{--    @elseif ($currentGrading == 4 && $fourthGrading && $currentSy->current_grading == $fourth)
                            <div class="buttons d-flex justify-content-end align-items-center">
                                @if ($preview_mode)
                                    <span class="text-gray-500 mr-3">You are currently in preview mode. The grades can
                                        be
                                        reviewed and changed.</span>
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='save'>Save</button>
                                @else
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click='preview'>Edit</button>
                                @endif
                            </div> --}}
                        @endif
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>

@push('scripts')
    <!-- Optional: Place to the bottom of scripts -->
    <script type="text/javascript">
        window.livewire.on('open', () => {
            $('#modalId').modal('show');
        });
        window.livewire.on('close', () => {
            $('#modalId').modal('hide');
        });
    </script>
@endpush
