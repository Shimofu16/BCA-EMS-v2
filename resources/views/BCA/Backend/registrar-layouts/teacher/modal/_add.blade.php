<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title  text-white" id="exampleModalLongTitle">Add Teacher</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('registrar.teachers.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="email">Email address <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="Age">Age <span class="text-danger">*</span></label>
                        <input class="form-control w-25" type="number" name="age" id="Age" placeholder="Age"
                            value="{{ old('age') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="gender">Gender <span class="text-danger">*</span></label>
                        <select class="form-control" id="gender" name="gender" required>
                            @switch(old('gender'))
                                @case('Male')
                                    <option value="Male"selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                @break

                                @case('Female')
                                    <option value="Female"selected>Female</option>
                                    <option value="Male">Male</option>
                                    <option value="Other">Other</option>
                                @break

                                @case('Other')
                                    <option value="Other"selected>Other</option>
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
                        <label class="font-weight-bold" for="contact">Phone No <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="tel" name="contact" id="contact"
                            placeholder="Phone Number" value="{{ old('contact') }}" maxlength="11" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
