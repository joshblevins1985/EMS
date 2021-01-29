<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalScheduleDate" tabindex="-1" role="dialog" aria-labelledby="exampleScheduleDate"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Add Scheduled Shift</p>
            </div>

            <!--Body-->
            <div class="modal-body">
               {!! Form::open(['route' => 'employeeschedule.store', 'id' => 'badrunsheets-form']) !!}    
               
               <input type="hidden" name="user_id" value="{{$employees->user_id}}"/>
                <div class="md-form">
                  <input placeholder="Selected date" type="text" id="date-picker-example" class="form-control datepicker" name="start_date">
                  <label for="date-picker-example">Shift Start Date</label>
                </div>
                
                <div class="md-form">
                  <input placeholder="Selected time" type="text" id="input_starttime" class="form-control timepicker" name="start_time">
                  <label for="input_starttime">Shift Start Time</label>
                </div>
                
                <!-- Material input -->
                <div class="md-form">
                  <input type="text" id="thours" name="thours" class="form-control">
                  <label for="thours">Total Hours</label>
                </div>
                
                <select name="unit" class="mdb-select md-form" searchable="Search here...">
                  <option value="" disabled selected>Choose your option</option>
                   @foreach($units as $row)
                  <option value="{{$row->id}}">{{$row->unit_number}}</option>
                    @endforeach 
                </select>
            
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="repeatCheckBox" name="repeat">
                    <label class="form-check-label" for="repeatCheckBox">This schedule will repeat.</label>
                </div>
                
                <div id="repeatinfo" style="display:none">
                     <!-- Material input -->
                <div class="md-form">
                  <input type="text" id="tdays" name="tdays" class="form-control">
                  <label for="tdays">Repeats every how many days?</label>
                </div>
                    
                     <div class="md-form">
                  <input placeholder="Selected date" type="text" id="date-picker-example" class="form-control datepicker" name="end_date">
                  <label for="date-picker-example">Shift Start Date</label>
                </div>
                </div>
                
                

            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">

                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
                
                <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Add Scheduled Date</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->