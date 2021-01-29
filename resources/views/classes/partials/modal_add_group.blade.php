<!-- Modal -->
<div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="addStudent"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGroup">Add New Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="{{ route('enrolled.group') }}" method="POST" >
                        {{csrf_field()}}
                        
                        <input type="hidden" name="class_id" value="{{$class->id}}">
                        
                        <div class="row">
                          <div class="col-md-12">
                        
                            <select class="mdb-select colorful-select dropdown-primary md-form" id="station" name="station[]" multiple searchable="Search here..">
                              @foreach($stations as $row)
                                    <option value="{{$row->id}}" >{{$row->station}}</option>
                                @endforeach
                            </select>
                            <label class="mdb-main-label">Select Station</label>
                            
                        
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-12">
                        
                            <select class="mdb-select colorful-select dropdown-primary md-form" id="level" name="level[]" multiple searchable="Search here..">
                              @foreach($levels as $row)
                                    <option value="{{$row->id}}" >{{$row->label}}</option>
                                @endforeach
                            </select>
                            <label class="mdb-main-label">Select Level</label>
                            
                        
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