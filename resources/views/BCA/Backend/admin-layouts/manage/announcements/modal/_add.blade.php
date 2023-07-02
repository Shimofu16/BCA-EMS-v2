<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add Announcement</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.manage.announcement.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">


                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo" class="font-weight-bold">Photo <span class="text-danger">*</span></label>
                        <input type="file" name="photo" id="photo"
                            class="form-control  @error('photo') is-invalid @enderror" value="{{ old('photo') }}">
                        <small id="helpId" class="text-muted">Please take note that the photo must be in landscape
                            orientation.</small>
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Description <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" id="gradelevel">
                        <label for="gl" class="font-weight-bold">Grade Level</label>
                        <select class="form-control @error('gl') is-invalid @enderror" name="gl" id="gl">
                            <option value="{{ old('gl') }}" selected disabled>------ Select Grade Level -----</option>
                            @forelse ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->grade_name }}</option>
                            @empty
                                <option>No Data Available</option>
                            @endforelse
                            <option value="remove">Remove</option>
                        </select>
                        @error('gl')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group form-check">
                        <input type="checkbox" name="option" id="option" class="form-check-input">
                        <label for="option" class="gender">Other Option</label>
                    </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Add</button>
                </div>
            </form>

        </div>
    </div>
</div>
