<!-- Modal -->
<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="addStudent"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudent">Add New Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="{{ route('enroll.store') }}" method="POST" >
                        {{csrf_field()}}
                        
                        <input type="hidden" name="class_id" value="{{$class->id}}">
                        
                        <div class="row">
                          <div class="col-md-12">
                        
                            <select class="mdb-select colorful-select dropdown-primary md-form" id="user_id" name="user_id[]" multiple searchable="Search here..">
                              @foreach($employee as $row)
                                    <option value="{{$row->user_id}}" >{{$row->last_name}}, {{$row->first_name}} - {{$row->employeepositions->label or ''}}</option>
                                @endforeach
                            </select>
                            <label class="mdb-main-label">Select Employee</label>
                            <button class="btn-save btn btn-primary btn-sm">Save</button>
                        
                          </div>
                        </div>
                    
                            


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Add New Student to Course</button>

                    </form>
    </div>
  </div>
</div>
</div>