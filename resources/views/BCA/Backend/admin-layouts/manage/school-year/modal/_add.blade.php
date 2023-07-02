<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add School Year</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.manage.sy.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-5">
                            <label class="font-weight-bold" for="start_date">Start Date <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="start_date" id="start_date"
                                value="{{ old('start_date') }}">
                        </div>
                        <div class="col-5">
                            <label class="font-weight-bold" for="end_date">End Date <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="end_date" id="end_date"
                                value="{{ old('end_date') }}">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
