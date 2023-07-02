<div class="modal fade" id="logout{{ $user->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-danger text-white">
                <h5 class="modal-title">Logout</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to force logout
                    <span class="font-weight-bold">{{ $user->name }}</span>?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{ route('admin.manage.user.logout', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>

            </div>
        </div>
    </div>
</div>
