<div class="modal fade" id="edit{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('registrar.teachers.update', ['id'=>$teacher->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="text-dark text-black font-weight-bold">Name <span
                                class="text-danger">*</span></label>
                        <input class="form-control w-75" type="text" name="name" id="name" placeholder="Name"
                            value="{{ $teacher->name }}">
                    </div>

                    <div class="form-group">
                        <label for="Age" class="text-dark text-black font-weight-bold">Age <span
                                class="text-danger">*</span></label>
                        <input class="form-control w-25" type="number" name="age" id="Age" placeholder="Age"
                            value="{{ $teacher->age }}">
                    </div>
                    <div class="form-group">
                        <label for="Gender" class="text-dark text-black font-weight-bold">Gender <span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="gender" name="gender">
                            @switch($teacher->gender)
                                @case('Male')
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                @break

                                @case('Female')
                                    <option value="Female" selected>Female</option>
                                    <option value="Male">Male</option>
                                    <option value="Other">Other</option>
                                @break

                                @case('Other')
                                    <option value="Other" selected>Other</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                @break

                                @default
                                    <option selected>--- Select Gender---</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                            @endswitch
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="text-dark text-black font-weight-bold">Phone No <span
                                class="text-danger">*</span></label>
                        <input class="form-control w-50" type="tel" name="contact" id="contact"
                            placeholder="Phone Number" value="{{ $teacher->contact }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-dark text-black font-weight-bold">Email <span
                                class="text-danger">*</span></label>
                        <input class="form-control w-75" type="text" name="email" id="email"
                            placeholder="Email" value="{{ $teacher->email }}" maxlength="11">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
