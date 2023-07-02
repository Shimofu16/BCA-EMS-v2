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
            <form action="{{ route('registrar.subject.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold" for="Subject">Subject <span
                                class="text-danger">*</span></label>
                        <input class="form-control w-50" type="text" name="subject" id="Subject"
                            placeholder="Subject">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <button class="btn btn-outline-primary" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
