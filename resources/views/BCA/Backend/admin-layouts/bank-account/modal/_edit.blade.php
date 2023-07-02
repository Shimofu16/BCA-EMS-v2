<!-- Modal -->
<div class="modal fade" id="edit{{ $account->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.account.update', ['id' => $account->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="bank_name" class="font-weight-bold">Bank Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name"
                            name="bank_name" value="{{ $account->bank_name }}">
                        @error('bank_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="account_name" class="font-weight-bold">Account Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="account_name"
                            name="account_name" value="{{ $account->account_name }}">
                        @error('account_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="account_number" class="font-weight-bold">Account number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number"
                            name="account_number" value="{{ $account->account_number }}">
                        @error('account_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
