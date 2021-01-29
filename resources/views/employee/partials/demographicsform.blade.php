<!-- Central Modal Small -->
<div class="modal fade" id="demographicsForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-sm" role="document">


      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'employee.store', 'id' => 'employee-form']) !!}
                 <div class=row style="padding:10px">
                <div class="col-6 ">
                    <div class=row>
                        <div class="col ">
                            <p class="font-weight-bold">Employee ID</p>
                        </div>
                        <div class="col">
                            <input type="text" id="employee-id" class="form-control mb-4" placeholder="Employee Id">
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col">
                            <p class="font-weight-bold">Full Name</p>
                        </div>
                        <div class="col">
                            {{$employees->first_name}} {{$employees->middle_name}} {{$employees->last_name}}
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col">
                            <p class="font-weight-bold">Preferred Name</p>
                        </div>
                        <div class="col">
                            {{$employees->preferred_name}}
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col">
                            <p class="font-weight-bold">Date of Birth</p>
                        </div>
                        <div class="col">
                            {{$employees->dob}}
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col">
                            <p class="font-weight-bold">Social Security Number</p>
                        </div>
                        <div class="col">
                            {{$employees->ssn}}
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col">
                            <p class="font-weight-bold">Ethnicity</p>
                        </div>
                        <div class="col">
                            {{$employees->ethnicity}}
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col">
                            <p class="font-weight-bold">Personal Email Address</p>
                        </div>
                        <div class="col">
                            
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col">
                            <p class="font-weight-bold">Work Email</p>
                        </div>
                        <div class="col">
                            {{$employees->email}}
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <div class=row>
                            <div class="col">
                                <p class="font-weight-bold">Phone Number</p>
                            </div>
                            <div class="col">
                                {{$employees->phone}}
                            </div>
                            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                        </div>
                        <div class=row>
                            <div class="col">
                                <p class="font-weight-bold">Mobile Number</p>
                            </div>
                            <div class="col">
                                {{$employees->phone_mobile}}
                            </div>
                            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                        </div>
                        <div class=row>
                            <div class="col">
                                <p class="font-weight-bold">Mobile Carrier</p>
                            </div>
                            <div class="col">
                                {{$employees->phone_carrier}}
                            </div>
                            
                        </div>
                        <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
                    </div>
                    
                    <div class="d-flex flex-column">
                        <div class=row>
                            <div class="col">
                                <p class="font-weight-bold">Address</p>
                            </div>
                            <div class="col">
                                <address>{{$employees->street_number}} {{$employees->route}} </address>
                            </div>
                            
                        </div>
                        <div class=row>
                            <div class="col">
                                <p class="font-weight-bold">City / State / Zip Code</p>
                            </div>
                            <div class="col">
                                <address> {{$employees->locality}}, {{$employees->state}} {{$employees->postal_code}}</address>
                            </div>
                            
                        </div>
                        
                        <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
                    </div>
                    
                    <div class="d-flex flex-column">
                        <div class=row>
                            <div class="col">
                                <p class="font-weight-bold">Primary Position</p>
                            </div>
                            <div class="col">
                                {{$employees->primary_position}}
                            </div>
                            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                        </div>
                        <div class=row>
                            <div class="col">
                                <p class="font-weight-bold">Additional Positions</p>
                            </div>
                            <div class="col">
                                
                            </div>
                            
                        </div>
                        
                        <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
                    </div>
                    <div class="d-flex flex-column">
                        <div class=row>
                            <div class="col">
                                <p class="font-weight-bold">Employee Status</p>
                            </div>
                            <div class="col">
                                {{$employees->status}}
                            </div>
                            
                        </div>
                        
                        
                        <hr>
                    </div>
                </div>
                
            </div>

            {!! Form::close() !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-sm">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Central Modal Small -->