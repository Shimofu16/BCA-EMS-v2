<div class="modal fade" id="edit{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('registrar.subject.update', $subject->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="Subject">Subject <span
                                class="text-danger">*</span></label>
                        <input class="form-control w-50" type="text" name="subject" id="Subject"
                            placeholder="Subject" value="{{ $subject->subject }}">
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
