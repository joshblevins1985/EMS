<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalStateCertForm" tabindex="-1" role="dialog" aria-labelledby="exampleStateCertForm"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Add State Certification for {{$employees->first_name}} {{$employees->last_name}}</p>
            </div>

            <!--Body-->
            <div class="modal-body">
               {!! Form::open(['route' => 'statecerts.store', 'id' => 'state_certs']) !!} 
               
               <input type="hidden" id="employee_id" name="employee" value="">
               
                <select class="mdb-select md-form" name="state">
                  <option value="" disabled selected>Choose the certifying state.</option>
                  <option value="1">Ohio</option>
                  <option value="2">Kentucky</option>
                  <option value="3">West Virgina</option>
                </select>
                
                <select class="mdb-select md-form" name="cert_level">
                  <option value="" disabled selected>Choose the certification type.</option>
                  @foreach($sc as $row)
                  <option value="{{$row->id}}">{{$row->label}}</option>
                  @endforeach
                </select>
               
               <!-- Material input -->
                <div class="md-form">
                  <input type="text" id="cert_num" name="cert_num" class="form-control">
                  <label for="cert_num">Certification Number</label>
                </div>
               
                <div class="md-form">
                  <input placeholder="Selected date" type="text" id="date-picker-example" class="form-control datepicker" name="expiration">
                  <label for="date-picker-example">Expiration Date</label>
                </div>
                
                
                
                

            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">

                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
                
                <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Add New State Certification</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->