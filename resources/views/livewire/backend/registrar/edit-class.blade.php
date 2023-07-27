<form wire:submit.prevent="update">
    <div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-md-5">
                    <label class="font-weight-bold" for="schedule">Schedule <span class="text-danger">*</span></label>
                    <select class="form-control @error(' schedule') is-invalid @enderror" id="schedule" name="schedule"
                        wire:model='schedule'>
                        <option selected value="">-- Select Schedule --</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="All">All</option>
                        @error('schedule')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </select>
                </div>
                <div class="col-md-7">
                    <div class="p-2">
                        @forelse ($days as $key => $day)
                            <button class="badge badge-pill badge-primary border-0" type="button"
                                wire:click='removeDay({{ $key }})'>{{ $day }}</button>
                        @empty
                            <div class="d-flex justify-content-center align-items-center">
                                <span>Select Schedule.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold" for="start_time">Start <span
                                class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="start_time" name="start_time"
                            wire:model='start'>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-weight-bold" for="end_time">End <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="end_time" name="end_time"
                            wire:model="end">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="teacher_id">Teacher <span class="text-danger">*</span></label>
                    <select class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id"
                        name="teacher_id" wire:model='teacher_id'>
                        <option selected value="{{ $class->teacher_id }}">{{ $class->teacher->name }}</option>
                        @foreach ($teachers as $teacher)
                            @if ($teacher->id != $class->teacher->id)
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
            <button class="btn btn-outline-primary" type="submit" wire:loading.attr='disabled' wire:submit>Save
                changes</button>
        </div>

    </div>
</form>
