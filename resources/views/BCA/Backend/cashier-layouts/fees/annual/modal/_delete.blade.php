<div class="modal fade" id="delete{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="{{ route('cashier.fees.annual.destroy', ['id' => $fee->id]) }}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <h5 class="text-start">Are you sure you want to delete {{ $fee->title }} ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>