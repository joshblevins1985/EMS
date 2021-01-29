

<!-- Modal -->
<div class="modal fade" id="draModal" tabindex="-1" role="dialog" aria-labelledby="draLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="draLabel">Driver Demographics</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 500px">
        {!! Form::open(['route' => 'demographic.store', 'id' => 'driverincident-form']) !!}  
        
            <input type="hidden" id="employee_id3" name="employee_id" value="">
            
            <select class="mdb-select md-form" name="sex">
              <option value="" disabled selected>Choose your option</option>
             
              <option value="8">Male</option>
              <option value="1" >Female</option>
              
            </select>
            
            <div class="md-form">
              <input placeholder="Date Licensed" type="text" id="date_of_license" name="date_of_license" data-value="@if($employees->dra) {{$employees->dra->date_license}} @endif" class="form-control datepicker">
              <label for="date-picker-example">Select Date Licensed</label>
            </div>
            
            <select class="mdb-select md-form" name="license_status">
              <option value="" disabled selected>Choose your option</option>
             
              <option value="1">Valid</option>
              
              <option value="30">Suspended</option>
              
            </select>
            
            <select class="mdb-select md-form" name="corrective_lenses">
              <option value="" disabled selected>Choose your option</option>
             
              <option value="1">Not Required</option>
              <option value="4">Required</option>
              
              
            </select>
            
            <div class="md-form">
              <input type="text" id="shift_hours" name="shift_hours" class="form-control" value="{{$employees->dra->shift_hours or ''}}">
              <label for="shift_hours">Average Shift Hours</label>
            </div>
            
            <select class="mdb-select md-form" name="non_driver">
              <option value="" disabled selected>Choose your option</option>
             
              <option value="0">Insurable</option>
              <option value="1">Not Insurable</option>
              
              
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