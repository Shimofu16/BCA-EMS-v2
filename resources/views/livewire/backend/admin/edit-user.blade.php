<div>
    <form wire:submit.prevent='edit()'>
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label class="font-weight-bold" for="first_role">Main Role<span class="text-danger">*</span></label>
                <select class="form-control @error('first_role') is-invalid @enderror" id="first_role" name="first_role"
                    wire:model='first_role'>
                    <option value="" selected>--- Select Main Role---</option>
                    @foreach ($roles as $role)
                        @if ($role->id != $user->first_role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('first_role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="second_role">Second Role</label>
                <select class="form-control @error('second_role') is-invalid @enderror "
                    {{ $first_role == null ? 'disabled' : '' }} id="second_role" name="second_role"
                    wire:model='second_role'>
                    <option value="" selected>--- Select Second Role---</option>
                    @foreach ($roles as $role)
                        @if ($role->id != $user->second_role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('second_role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="name">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" wire:model='name'>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="email">Email address <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" wire:model='email'>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="gender">Gender <span class="text-danger">*</span></label>
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender"
                    wire:model='gender'>
                    <option selected>--- Select Gender---</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" wire:submit class="btn btn-outline-primary">Save Changes</button>
        </div>
    </form>
</div>
