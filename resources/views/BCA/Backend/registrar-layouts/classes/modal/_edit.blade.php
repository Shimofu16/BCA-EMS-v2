<div class="modal fade" id="edit{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title  text-white" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @livewire('registrar.class.update', ['class' => $class,'section'=>$class->section,'sections'=>$sections,'teachers'=>$teachers,'subjects'=>$subjects], key($class->id))


        </div>
    </div>
</div>
