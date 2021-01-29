

<!-- Modal -->
<div class="modal fade" id="mvrModal" tabindex="-1" role="dialog" aria-labelledby="mvrLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mvrLabel">Add New MVR Incident</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 500px">
        {!! Form::open(['route' => 'mvrincident.store', 'id' => 'badrunsheets-form']) !!}  
        
            <input type="hidden" id="employee_id1" name="employee_id" value="">
            
            <div class="md-form">
              <input placeholder="Date Cited" type="text" id="date" name="date" class="form-control datepicker">
              <label for="date-picker-example">Select Date Cited</label>
            </div>
            
            <select class="mdb-select md-form" name="offense">
              <option value="" disabled selected>Choose your option</option>
              @foreach($mvroffenses as $row)
              <option value="{{$row->id}}">{{$row->offense}}</option>
              @endforeach
            </select>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>