<!-- Modal -->
<div class="modal fade" id="edit{{ $sy->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Photo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.manage.sy.update', ['id' => $sy->id]) }}" method="post">
                @csrf
                @method('PUT')
                @php
                    $currentSy = App\Models\SchoolYear::where('id', session()->get(Auth::id() . '_current_sy'))->first();
                @endphp
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-5">
                            <label class="font-weight-bold" for="start_date">Start Date <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="start_date" id="start_date"
                                value="{{ $sy->start_date }}">
                        </div>
                        <div class="col-5">
                            <label class="font-weight-bold" for="end_date">End Date <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="end_date" id="end_date"
                                value="{{ $sy->end_date }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="is_active" class="font-weight-bold">Status</label>
                            <select class="form-control" name="is_active" id="is_active"
                                {{ date('Y', strtotime($sy->start_date)) < date('Y', strtotime($currentSy->start_date)) ? 'disabled' : '' }}>
                                @if ($sy->is_active)
                                    <option value="1" selected>Active</option>
                                    <option value="0">Close</option>
                                @else
                                    <option value="1">Active</option>
                                    <option value="0" selected>Close</option>
                                @endif
                            </select>
                            <small id="statusInfo" class="form-text text-muted">
                                @if (date('Y', strtotime($sy->start_date)) >= date('Y', strtotime($currentSy->start_date)))
                                    @if ($sy->is_active)
                                        The school year is currently active. Select "Close" to deactivate it.
                                    @else
                                        The school year is currently closed. Select "Active" to activate it.
                                    @endif
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="enrollment_status" class="font-weight-bold">Enrollment Status</label>
                            <select class="form-control" name="enrollment_status" id="enrollment_status"
                                {{ date('Y', strtotime($sy->start_date)) < date('Y', strtotime($currentSy->start_date)) ? 'disabled' : '' }}>
                                @if ($sy->enrollment_status == 'open')
                                    <option value="open" selected>Open</option>
                                    <option value="close">Close</option>
                                @else
                                    <option value="open">Open</option>
                                    <option value="close" selected>Close</option>
                                @endif
                            </select>
                            <small id="enrollmentStatusInfo" class="form-text text-muted">
                                @if (date('Y', strtotime($sy->start_date)) >= date('Y', strtotime($currentSy->start_date)))
                                    @if ($sy->enrollment_status == 'open')
                                        The enrollment is currently open. Select "Close" to close the enrollment.
                                    @else
                                        The enrollment is currently closed. Select "Open" to open the enrollment.
                                    @endif
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
