<div class="modal fade" id="edit{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light font-weight-bold" id="exampleModalLabel">Update</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{ route('cashier.fees.annual.update', ['id' => $fee->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    {{-- <div class="mb-3">
                        <label for="title" class="form-label font-weight-bold">Title <span
                                class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $fee->title }}" required>
                    </div> --}}
                    <div class="mb-3">
                        <label for="amount" class="form-label font-weight-bold">Amount <span
                                class="text-danger">*</span></label>
                        <input type="number" name="amount" id="amount" class="form-control"
                            value="{{ $fee->amount }}" required>
                    </div>
                    {{--   <div class="mb-3">
                        <label for="type" class="form-label font-weight-bold">Type <span
                                class="text-danger">*</span></label>
                        <input type="text" name="fee_type" id="type" class="form-control"
                            placeholder="Ex: Development Fees, Miscellaneous Fees, Payment Method, Basic Tuition"
                            value="{{ $fee->fee_type }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label font-weight-bold">Grade Level <span
                                class="text-danger">*</span></label>
                        <select class="form-control form-select-lg" name="level" id="level" required>
                            <option selected disabled> {{ ($fee->level->title == null) ? 'Select Grade Level' :
                                $fee->level->title ; }}</option>
                            @foreach ($levels as $level)
                            @if ($level->id !== $fee->level_id)
                            <option value="{{ $level->id }}">{{ $level->title }}</option>

                            @endif
                            @endforeach
                        </select>

                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
