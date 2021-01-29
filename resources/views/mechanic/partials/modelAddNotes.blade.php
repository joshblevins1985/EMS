<!-- Modal -->
<div class="modal fade" id="modalAddNote" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteModalLabel">Add Note to ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/mechanicTask/addNote" method="POST" class="form-horizontal" data-parsley-validate="true" name="demo-form">
                    @csrf
                    
                    <input type="hidden" id="task_id" name="task_id" value="">
                    
                    <div class="form-group">
                        <input type="text" name="note"  class="form-control" placeholder="Add your note here">
                    </div>
        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>