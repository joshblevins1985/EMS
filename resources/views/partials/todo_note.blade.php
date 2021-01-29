<!--Attandance Model-->
<div class="modal fade right" id="newTodoNoteModal" tabindex="-1" role="dialog" aria-labelledby="newTodoNoteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fluid modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTodoNoteModalLabel">Add Note To Todo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'task.note', 'id' => 'badrunsheets-form']) !!}

                <!--Textarea with icon prefix-->
                <div class="md-form">
                    <i class="fas fa-pencil-alt prefix"></i>
                    <textarea id="task" name="note" class="md-textarea form-control" rows="3"></textarea>
                    <label for="task">Note to be added</label>
                </div>

                <input type="hidden" name="tid" id="tid" value="">

                <button class="btn btn-info btn-block my-4" type="submit">Add Report</button>

                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>