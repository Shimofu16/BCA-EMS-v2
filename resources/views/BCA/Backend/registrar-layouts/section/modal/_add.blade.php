<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Add Section</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('registrar.section.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Section name <span
                                class="text-danger">*</span></label>
                        <input class="form-control w-50 @error('name') is-invalid @enderror" type="text" name="name" id="name"
                            placeholder="Section name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="adviser" class="font-weight-bold">Grade Level <span
                                class="text-danger">*</span></label>
                        <select class="custom-select @error('grade_level_id') is-invalid @enderror" id="inputGroupSelect01" name="grade_level_id" required>
                            <option selected value="">-- Select Grade Level --</option>
                            @foreach ($gradeLevels as $gradeLevel)
                                <option value="{{ $gradeLevel->id }}">{{ $gradeLevel->display_name }}</option>
                            @endforeach
                        </select>
                        @error('grade_level_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="teacher_id" class="font-weight-bold">Adviser <span
                                class="text-danger">*</span></label>
                        <select class="custom-select @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id">
                            <option selected value="">-- Select Adviser --</option>
                            @foreach ($teachers as $teacher)
                                @if (!$teacher->hasAdvisory())
                                    <option value="{{ $teacher->id }}">
                                        {{ $teacher->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-primary" type="submit">Add Section</button>
                </div>
            </form>
        </div>
    </div>
</div>
