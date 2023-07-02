<div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @livewire('admin.users.edit',['user' => $user])
        </div>
    </div>
</div>
