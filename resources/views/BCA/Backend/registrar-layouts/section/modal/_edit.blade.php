<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('registrar.section.update', $section->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="section">Section name <span
                                class="text-danger">*</span></label>
                        <input class="form-control w-50" type="text" name="name" id="section"
                            placeholder="Section name" value="{{ $section->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" for="teacher_id">Adviser <span
                                class="text-danger">*</span></label>
                        <select name="teacher_id" class="custom-select" id="teacher_id">
                            <option selected value="{{ $section->teacher_id }}">
                                {{ $section->teacher_id == null ? '-- Select Adviser --' : $section->teacher->name }}
                            </option>
                            @foreach ($teachers as $teacher)
                                @if (!$teacher->hasAdvisory())
                                    <option value="{{ $teacher->id }}">
                                        {{ $teacher->name }}</option>
                                @endif
                            @endforeach
                            @if ($section->teacher_id != null)
                                <option value="delete">Delete Adviser</option>
                            @endif
                        </select>
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
