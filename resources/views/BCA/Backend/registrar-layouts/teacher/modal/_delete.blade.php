<div class="modal fade" id="delete{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Delete</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('registrar.teachers.delete', ['id' => $teacher->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <h5 class="text-center fw-bold py-3">
                    Are you sure you want to delete {{ $teacher->name }}?
                </h5>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-danger" type="submit">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
