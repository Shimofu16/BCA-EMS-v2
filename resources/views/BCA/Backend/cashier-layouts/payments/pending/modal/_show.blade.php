<div class="modal fade" id="show{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light font-weight-bold" id="exampleModalLabel">Payment</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                    @if ($payment->mop == 'Bank Deposit')
                    <div class="card-header d-flex justify-content-center border-0 bg-transparent">
                        <img class="card-img-top" src="{{ asset($payment->path) }}" alt="Title">
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('cashier.payment.pending.update', $payment->id) }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="font-weight-bold" for="amount">Payment <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="modal-footer pb-0">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-outline-success" type="submit">Accept</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
