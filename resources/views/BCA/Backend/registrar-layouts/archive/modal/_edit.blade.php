@if ($isStudent == 1)
    <div class="modal fade" id="edit{{ $student->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Restore</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                    action="{{ route('registrar.archive.update', ['id' => $student->id, 'isStudent' => $isStudent]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <h5 class="text-center fw-bold py-3">
                        Are you sure you want to restore {{ $student->getName($student->id) }}?
                    </h5>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-outline-primary" type="submit">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@else
    <div class="modal fade" id="edit{{ $teacher->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Restore</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                    action="{{ route('registrar.archive.update', ['id' => $teacher->id, 'isStudent' => $isStudent]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <h5 class="text-center fw-bold py-3">
                        Are you sure you want to restore {{ $teacher->name }}?
                    </h5>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-outline-primary" type="submit">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
