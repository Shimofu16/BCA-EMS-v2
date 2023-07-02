<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light font-weight-bold" id="exampleModalLabel">Add</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('cashier.fees.annual.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label font-weight-bold">Title <span
                                class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label font-weight-bold">Amount <span
                                class="text-danger">*</span></label>
                        <input type="number" name="amount" id="amount" class="form-control"
                            value="{{ old('amount') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="Type" class="form-label font-weight-bold">Type <span
                                class="text-danger">*</span></label>
                        <select class="form-control form-select-lg" name="fee_type" id="Type" required>
                            <option selected disabled> Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type['title'] }}">{{ $type['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label font-weight-bold">Grade Level <span
                                class="text-danger">*</span></label>
                        <input type="text" name="level" id="level" class="form-control"
                            value="{{ $level->id }}" required hidden>
                        <input type="text"  class="form-control"
                            value="{{ $level->title }}" required disabled>

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
