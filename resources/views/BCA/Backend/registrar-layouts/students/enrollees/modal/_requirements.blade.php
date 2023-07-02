<div class="modal fade" id="requirements" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Requirements</h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @livewire('registrar.student.requirement.upload', [
                'student' => $student,
                'studentPhoto' => $studentPhoto,
                'goodMoral' => $goodMoral,
                'form138File' => $form138File,
                'psaFile' => $psaFile,
                'hasFilePsa' => $hasFilePsa,
            ])
        </div>
    </div>
</div>
