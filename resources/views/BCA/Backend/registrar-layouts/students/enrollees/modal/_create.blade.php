<div class="modal fade" id="add{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-light font-weight-bold" id="exampleModalLabel">Assign section</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('registrar.enrollees.store', $student->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="section" class="text-dark text-black font-weight-bold">Section <span
                                class="text-danger">*</span></label>
                        <select id="section" class="form-control w-50" name="section_id" required>
                            <option selected disabled value="">---- Select section ----</option>
                            @php
                                $sections = DB::table('sections')
                                    ->where('grade_level_id', $student->grade_level_id)
                                    ->get();
                            @endphp
                            @forelse  ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @empty
                                <option disabled> No section available</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-success" type="submit">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>
