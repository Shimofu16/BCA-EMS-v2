<div>
    <form wire:submit.prevent='save()' enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="title" class="font-weight-bold">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" wire:model='title'>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="date" class="font-weight-bold">Date <span class="text-danger">*</span></label>
                <input type="date" name="date" id="date"
                    class="form-control @error('date') is-invalid @enderror" wire:model='date'>
                @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="photos" class="font-weight-bold">Photo <span class="text-danger">*</span></label>
                <input type="file" name="photos" id="photos"
                    class="form-control @error('photos.*') is-invalid @enderror" multiple wire:model='photos'>
                    @error('photos.*')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <small id="helpId" class="text-muted">Please take note that the photo must be in
                    landscape orientation.</small>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="d-none" wire:loading.class='d-block' wire:target="photos">
                <i class="fa fa-exclamation-triangle text-info" aria-hidden="true"></i> Uploading Photos please wait.
            </div>
            <div wire:loading wire:target="save()">
                {{-- create spinner --}}
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                {{-- end spinner --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary" wire:loading.attr='disabled'>Add</button>
            </div>
        </div>
    </form>
</div>
