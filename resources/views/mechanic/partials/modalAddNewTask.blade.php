<!-- Modal -->
<div class="modal fade" id="modalAddNewTask" tabindex="-1" role="dialog" aria-labelledby="AddNewTaskLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddNewTaskLabel">Add New Task to Service Ticket </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                
                <form class="form-horizontal" data-parsley-validate="true" name="demo-form" action="/serviceNewTask" method="POST">
                    
                    @csrf
                    <input type="hidden" id="service_id" name="rid">
                    <input type="hidden" id="unit_id" name="unit_id">

                    <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Task Type</label>
                            
							<div class="col-lg-8">
								<select class="default-select2 form-control" name="task">
                                    <option selected disabled> Select Task </option>
                                    @foreach($malfunctions as $row)
                                    <option value="{{ $row->id }}" > {{ $row->label }} </option>
                                    @endforeach
								</select>
							</div>
						</div>
						

                    <div class="form-group row m-b-15">
                        <label class="col-md-4 col-sm-4 col-form-label" for="comments">Comment :</label>
                        <div class="col-md-8 col-sm-8">
                            <input class="form-control" type="text" id="comments" name="comments" placeholder="Describe the problem or task." />
                        </div>
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