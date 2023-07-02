<!-- Modal -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Import From System files</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-start">Are you sure you want to import the backup file?
                </h5>
                <h6 class="text-danger text-sm"><i class="fa fa-warning" aria-hidden="true"></i> This action cannot
                    be undone.</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{ route('admin.manage.backups.import.storage') }}" class="btn btn-outline-info">Yes</a>
            </div>

        </div>
    </div>
</div>
