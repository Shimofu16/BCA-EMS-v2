<div class="modal fade" id="edit{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="{{ route('registrar.enrolled.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-row mb-2">
                        <div class="col-md-4">
                            <label for="student_lrn" class="text-dark text-black font-weight-bold">Student
                                LRN <span class="text-danger">*</span></label>
                            <input class="form-control " type="text" name="student_lrn" id="student_lrn"
                                value="{{ $student->student_lrn }}">
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-md-4">
                            <label for="first_name" class="text-dark text-black font-weight-bold">First name <span
                                    class="text-danger">*</span></label>
                            <input class="form-control " type="text" name="first_name" id="first_name"
                                value="{{ $student->first_name }}">
                        </div>
                        <div class="col-md-4">
                            <label for="middle_name" class="text-dark text-black font-weight-bold">Middle name <span
                                    class="text-danger">*</span></label>
                            <input class="form-control " type="text" name="middle_name" id="middle_name"
                                value="{{ $student->middle_name }}">
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="text-dark text-black font-weight-bold">Last name <span
                                    class="text-danger">*</span></label>
                            <input class="form-control " type="text" name="last_name" id="last_name"
                                value="{{ $student->last_name }}">
                        </div>
                        @if ($student->ext_name !== null)
                            <div class="col-md-4">
                                <label for="ext_name" class="text-dark text-black font-weight-bold">Ext. name <span
                                        class="text-danger">*</span></label>
                                <input class="form-control " type="text" name="ext_name" id="ext_name"
                                    value="{{ $student->ext_name }}">
                            </div>
                        @endif
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-md-4">
                            <label for="gender" class="text-dark text-black font-weight-bold">Gender <span
                                    class="text-danger">*</span></label>
                            <select class="form-control form-select-lg" name="gender" id="gender">
                                @if ($student->gender == 'Male')
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female</option>
                                @elseif ($student->gender == 'Female')
                                    <option selected value="Female">Female</option>
                                    <option value="Male">Male</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-md-4">
                            <label for="email" class="text-dark text-black font-weight-bold">Email <span
                                    class="text-danger">*</span></label>
                            <input class="form-control " type="text" name="email" id="email"
                                value="{{ $student->email }}">
                        </div>
                        <div class="col-md-3">
                            <label for="birth_date" class="text-dark text-black font-weight-bold">Birthdate <span
                                    class="text-danger">*</span></label>
                            <input class="form-control " type="date" name="birth_date" id="birth_date"
                                value="{{ $student->birth_date }}">
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-md-4">
                            <label for="birthplace" class="text-dark text-black font-weight-bold">Birthplace <span
                                    class="text-danger">*</span></label>
                            <input class="form-control " type="text" name="birthplace" id="birthplace"
                                value="{{ $student->birthplace }}">
                        </div>
                        <div class="col-md-4">
                            <label for="address" class="text-dark text-black font-weight-bold">Address <span
                                    class="text-danger">*</span></label>
                            <input class="form-control " type="text" name="address" id="address"
                                value="{{ $student->address }}">
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-md-4">
                            <label for="section_id" class="text-dark text-black font-weight-bold">Section <span
                                    class="text-danger">*</span></label>
                            <select name="section_id" id="section_id" class="form-control">
                                <option selected value="{{ $student->section_id }}">
                                    {{ $student->section->section_name }}</option>
                                @php
                                    $sections = DB::table('sections')
                                        ->where('grade_level_id', $student->grade_level_id)
                                        ->get();
                                @endphp
                                @forelse ($sections as $section)
                                    @if ($student->section->section_name != $section->section_name)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endif
                                @empty
                                    <option disabled> No section available</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="grade_level" class="text-dark text-black font-weight-bold">Grade
                                level <span class="text-danger">*</span></label>
                            <select name="grade_level_id" id="grade_level_id" class="form-control">
                                <option selected value="{{ $student->grade_level_id }}">
                                    {{ $student->gradeLevel->name }}</option>
                                @foreach ($gradeLevels as $level)
                                    @if ($student->gradeLevel->name != $level->display_name)
                                        <option value="{{ $level->id }}">{{ $level->display_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-primary" type="submit">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
