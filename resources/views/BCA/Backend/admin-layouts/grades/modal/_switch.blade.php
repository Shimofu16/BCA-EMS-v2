<!-- Modal -->
<div class="modal fade" id="switch" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Switch Grading</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.manage.grades.update', ['switchTo' => $switchToNumber]) }}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <h5 class="text-start">Are you sure you want to switch the current grading to {{ $switchTo }}?
                    </h5>
                    <h6 class="text-danger text-sm"><i class="fa fa-warning" aria-hidden="true"></i> This action cannot
                        be undone.</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
