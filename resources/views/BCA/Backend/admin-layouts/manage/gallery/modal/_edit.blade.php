<!-- Modal -->

@if (Request::routeIs('admin.manage.gallery.album.index'))
    <div class="modal fade" id="edit{{ $album->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.manage.gallery.album.update', ['id' => $album->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Title <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $album->title }}">
                        </div>

                        <div class="form-group">
                            <label for="photo" class="font-weight-bold">Photo <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="photo" id="photo" class="form-control">
                            <small id="helpId" class="text-muted">Please take note that the photo must be in
                                landscape orientation.</small>

                        </div>
                        <div class="form-group">
                            <label for="date" class="font-weight-bold">Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="date" id="date" class="form-control"
                                value="{{ $album->date }}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="announcement_id" class="font-weight-bold">Announcement</label>
                            <select class="form-control" name="announcement_id" id="announcement_id">
                                <option value="Selected Value" selected disabled>
                                    {{ $album->announcement->title != null ? $album->announcement->title : 'Select Announcement' }}
                                </option>
                                @forelse ($announcements as $announcement)
                                    @if ($album->announcement_id != $announcement->id)
                                        <option value="{{ $announcement->id }}">{{ $announcement->title }}</option>
                                    @endif
                                @empty
                                    <option>No Data Available</option>
                                @endforelse
                                <option value="remove">Remove</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gl" class="font-weight-bold">Grade Level</label>
                            <select class="form-control" name="gl" id="gl">
                                <option value="Selected Value" selected disabled>
                                    {{ $album->gradeLevel->name != null ? $album->gradeLevel->name : 'Select Grade Level' }}
                                </option>
                                @forelse ($levels as $level)
                                    @if ($album->grade_level_id != $level->id)
                                        <option value="{{ $level->id }}">{{ $level->display_name }}</option>
                                    @endif
                                @empty
                                    <option>No Data Available</option>
                                @endforelse
                                <option value="remove">Remove</option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
@if (Request::routeIs('admin.manage.gallery.album.show'))
    <div class="modal fade" id="edit{{ $photo->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>

                <form
                    action="{{ route('admin.manage.gallery.photos.update', ['id' => $album->id, 'photo_id' => $photo->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="photo" class="font-weight-bold">Photo <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="photo" id="photo" class="form-control">
                            <small id="helpId" class="text-muted">Please take note that the photo must be in
                                landscape orientation.</small>
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
@endif
