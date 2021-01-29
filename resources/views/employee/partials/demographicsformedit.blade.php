{!! Form::open(['route' => ['employees.update', $employees->id], 'id' => 'employees-form']) !!}

@method('PUT')

<div class=row >
    <div class="col-6 ">
        <div class=row>
            <div class="md-form">
                <input type="hidden" id="cid"  value="{{$user->companies_id}}"  class="form-control">

            </div>
            <div class="col-3 ">
                <p class="font-weight-bold">Employee ID</p>
            </div>
            <div class="col-9">

                <div class="md-form">
                    <i class="fa fa-id-card prefix"></i>
                    <input type="text" id="eid" name='eid' class="form-control validate" placeholder="Employee ID" value="{{$employees->eid}}" required>

                </div>
            </div>
            <div class="col-3 ">
                <p class="font-weight-bold">RFID</p>
            </div>
            <div class="col-9">



                <div class="md-form">
                    <i class="fa fa-id-card prefix"></i>
                    <input type="text" id="rfid" name="rfid" class="form-control validate" value="{{$employees->rfid}}" placeholder="Employee RFID" required>

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Full Name</p>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col">
                        <div class="md-form">
                            <i class="fa fa-user prefix"></i>
                            <input type="text" id="first_name" name="first_name" class="form-control validate" placeholder="First Name" value="{{$employees->first_name}}" required>

                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form">

                            <input type="text" id="middle_name" name="middle_name" class="form-control validate" placeholder="Middle Name" value="{{$employees->middle_name}}"  >

                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form">

                            <input type="text" id="last_name" name="last_name" class="form-control validate" placeholder="Last Name" value="{{$employees->last_name}}"  required>

                        </div>
                    </div>
                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Prefered Name</p>
            </div>
            <div class="col-9">

                <div class="md-form">

                    <input type="text" id="prefered_name" class="form-control validate" placeholder="Prefered Name" value="{{$employees->prefered_name}}"  >

                </div>

            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Date of Birth</p>
            </div>
            <div class="col-9">
                <div class="md-form">
                    
                    <input  type="text" id="dob" name="dob" class="form-control datepicker" data-value="{{$employees->dob}}" value=""  >

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Social Security Number</p>
            </div>
            <div class="col-9">
                <div class="md-form">

                    <input type="tel" id="ssn" name="ssn" class="form-control validate" placeholder="Social Security Number" value="{{$ssn}}" >

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Ethnicity</p>
            </div>
            <div class="col-9">
                <select class="mdb-select" id="ethnicity" value="{{$employees->ethnicity}}" >
                    <option value="" disabled selected>Choose Employees Ethnicity</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Personal Email Address</p>
            </div>
            <div class="col-9">
                <div class="md-form">
                    <i class="fa fa-envelope prefix"></i>
                    <input type="email" id="personal_email" class="form-control validate" placeholder="Personal Email"  disabled>

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Work Email</p>
            </div>
            <div class="col-9">
                <div class="md-form">
                    <i class="fa fa-envelope prefix"></i>
                    <input type="email" id="email" name="email" class="form-control validate" placeholder="Work Email" value="{{$employees->email}}"  required>

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        
        <div class="d-flex flex-column">
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Phone Number</p>
                </div>
                <div class="col-9">
                    <div class="md-form">
                        <i class="fa fa-phone prefix"></i>
                        <input type="tel" id="phone" name="phone" class="form-control validate" placeholder="Phone Number" value="{{$employees->phone}}" >

                    </div>
                </div>
                <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
            </div>
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Mobile Number</p>
                </div>
                <div class="col-9">
                    <div class="md-form">
                        <i class="fa fa-mobile prefix"></i>
                        <input type="tel" id="phone_mobile" name="phone_mobile" class="form-control validate" placeholder="Mobile Phone" value="{{$employees->phone_mobile}}"  >

                    </div>
                </div>
                <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
            </div>
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Mobile Carrier</p>
                </div>
                <div class="col-9">
                    <select class="mdb-select" id="phone_carrier" name="phone_carrier" value="{{$employees->phone_carrier}}">
                        <option value="" disabled selected>Choose Employees Mobile Carrier</option>

                        @foreach($mobilecarriers as $id => $mcarrier)
                        <option value="{{ $id}}">{{ $mcarrier }}</option>
                        @endforeach

                    </select>
                </div>

            </div>
            <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
        </div>
    </div>
    <div class="col-6">
        

        <div class="d-flex flex-column">
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Address</p>
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-9">
                            <div class="md-form">

                                <input type="text" id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()"  class="form-control validate" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="md-form">
                                <i class="fa fa-home prefix"></i>
                                <input type="tel" id="street_number" name="street_number" class="form-control validate" placeholder="House #" value="{{$employees->street_number}}"  >

                            </div>
                        </div>
                        <div class="col-9">
                            <div class="md-form">
                                <i class="fa fa-road prefix"></i>
                                <input type="text" id="route" name="route" class="form-control validate" placeholder="Street Name" value="{{$employees->route}}"  >

                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-12">
                            <div class="md-form">
                                <i class="fa fa-road prefix"></i>
                                <input type="text" id="route" name="address_2" class="form-control validate" placeholder="Address P.O Box or add Info" value="{{$employees->address_2}}" >

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">City / State / Zip Code</p>
                </div>
                <div class="col-9">


                    <div class="row">
                        <div class="col-4">
                            <div class="md-form">

                                <input type="tel" id="locality" name="locality" class="form-control validate" placeholder="City" value="{{$employees->locality}}"  >

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="md-form">

                                <input type="text" id="administrative_area_level_1" name="state" class="form-control validate" placeholder="State" value="{{$employees->state}}"  >

                            </div>
                        </div>
                        <div class="col-2">
                            <div class="md-form">

                                <input type="text" id="postal_code" name="postal_code" class="form-control validate" placeholder="Zip Code" value="{{$employees->postal_code}}"  >

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
        </div>

        <div class="d-flex flex-column">
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Primary Company</p>
                </div>
                <div class="col-9">
                    <select class="mdb-select" id="company_id" name="company_id" value="{{$employees->primary_position}}">

                        @foreach($companies as $row)

                        <option value="{{$row->id}}" @if($employees->company_id == $row->id) selected @endif>{{$row->name}}</option>

                        @endforeach
                    </select>
                </div>
                <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
            </div>
            
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Primary Station</p>
                </div>
                <div class="col-9">
                    <select class="mdb-select colorful-select dropdown-primary" id="primary_station" name="primary_station" >
                        <option value="" disabled selected>Primary Station</option>
                        @foreach($station as $id => $station)
                        <option value="{{$id}}" @if($employees->primary_station == $id) selected @endif>{{$station}}</option>
                        @endforeach
                    </select>

                </div>

            </div>
            
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Primary Position</p>
                </div>
                <div class="col-9">
                    <select class="mdb-select" id="primary_position" name="primary_position" value="{{$employees->primary_position}}">

                        @foreach($employeepositions as $id => $eposition)

                        <option value="{{$id}}" @if($employees->primary_position == $id) selected @endif>{{$eposition}}</option>

                        @endforeach
                    </select>
                </div>
                <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
            </div>
            <div class=row>
                <div class="col">
                    <p class="font-weight-bold">Additional Positions</p>
                </div>
                <div class="col">
                    <select class="mdb-select colorful-select dropdown-primary" id="additional_postions" name="additional_postions[]"  multiple searchable="Search here.." value="{{$employees->additional_postions}}">
                        <option value="" disabled selected>Add More Positions</option>
                        @foreach($employeepositions as $id => $eposition)


                        <option value="{{$id}}">{{$eposition}}</option>

                        @endforeach
                    </select>

                </div>

            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Date of Hire</p>
            </div> 
            <div class="col-9">
                <div class="md-form">
                    <input placeholder="Date of Hire" type="text" name="doh" id="doh" class="form-control datepicker" data-value="{{$employees->doh}}">

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class="d-flex flex-column">
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Driver Type</p>
                </div>
                <div class="col-9">
                    
                    <!-- Default inline 1-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="dd1" name="driver" value="1" @if($employees->driver == 1) checked  @endif>
          <label class="custom-control-label" for="dd1">Driver</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="dd7" name="driver" value="6" @if($employees->driver == 0) checked  @endif>
          <label class="custom-control-label" for="dd7">W/C Driver</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="dd2" name="driver" value="0" @if($employees->driver == 0) checked  @endif>
          <label class="custom-control-label" for="dd2">Non-Driver</label>
        </div>
        
                </div>
                
                
        
            </div>
            
            
            
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Non-Driver Reason</p>
                </div>
                <div class="col-9">
                    
                    <!-- Default inline 1-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ddd1" name="nd_reason" value="1" @if($employees->nd_reason == 1) checked  @endif>
          <label class="custom-control-label" for="ddd1">Insurance</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ddd2" name="nd_reason" value="2" @if($employees->nd_reason == 2) checked  @endif>
          <label class="custom-control-label" for="ddd2">Accident</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ddd3" name="nd_reason" value="3" @if($employees->nd_reason == 3) checked  @endif>
          <label class="custom-control-label" for="ddd3">Administration</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ddd5" name="nd_reason" value="5" @if($employees->nd_reason == 5) checked  @endif>
          <label class="custom-control-label" for="ddd5">Age</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ddd6" name="nd_reason" value="6" @if($employees->nd_reason == 6) checked  @endif>
          <label class="custom-control-label" for="ddd6">Time Licensed</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ddd4" name="nd_reason" value="4" @if($employees->nd_reason == 4) checked  @endif>
          <label class="custom-control-label" for="ddd4">Not Applicable</label>
        </div>
        
                </div>
                
                
        
            </div>
            <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Driver Note</p>
            </div>
            <div class="col-9">

                <div class="md-form">

                    <input type="text" id="driver_note" class="form-control validate" name="driver_note" placeholder="Driver Note" value="{{$employees->driver_note}}"  >

                </div>

            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
            
            <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Date to Rerun Driving History</p>
            </div> 
            <div class="col-9">
                <div class="md-form">
                    <input placeholder="Date of next MVR" type="text" name="dod" id="dod" class="form-control datepicker" data-value="{{$employees->dod}}">

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Date of Next Drving Step</p>
            </div> 
            <div class="col-9">
                <div class="md-form">
                    <input placeholder="Date of next Driver Step" type="text" name="driver_step" id="driver_step" class="form-control datepicker" data-value="{{$employees->driver_step}}">

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Check this box to hold driving status.</p>
            </div> 
            <div class="col-9">
                <!-- Material unchecked -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="materialUnchecked" name="hold_driver" value="true">
                    <label class="form-check-label" for="materialUnchecked">Hold Drving Status</label>
                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class="d-flex flex-column">
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Employment Status</p>
                </div>
                <div class="col-9">
                    
                    <!-- Default inline 1-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d1" name="status" value="1" @if($employees->status == 1) checked  @endif>
          <label class="custom-control-label" for="d1">App</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d2" name="status" value="2" @if($employees->status == 2) checked  @endif>
          <label class="custom-control-label" for="d2">Pre-Hire</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d5" name="status" value="5" @if($employees->status == 5) checked  @endif>
          <label class="custom-control-label" for="d5">Active</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d6" name="status" value="6" @if($employees->status == 6) checked  @endif>
          <label class="custom-control-label" for="d6">FMLA</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d7" name="status" value="7" @if($employees->status == 7) checked  @endif>
          <label class="custom-control-label" for="d7">COMP</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d8" name="status" value="8" @if($employees->status == 8) checked  @endif>
          <label class="custom-control-label" for="d8">Terminated</label>
        </div>
                </div>
                
                <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Employee Status </p>
                </div>
                <div class="col-9">
                    
                    <!-- Default inline 1-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ds1" name="employee_status" value="1" @if($employees->employee_status == 1) checked  @endif>
          <label class="custom-control-label" for="ds1">Orientation</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ds2" name="employee_status" value="2" @if($employees->employee_status == 2) checked  @endif>
          <label class="custom-control-label" for="ds2">Field Orientation</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ds3" name="employee_status" value="3" @if($employees->employee_status == 3) checked  @endif>
          <label class="custom-control-label" for="ds3">Driver Orientation</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ds4" name="employee_status" value="4" @if($employees->employee_status == 4) checked  @endif>
          <label class="custom-control-label" for="ds4">BTD Program</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ds5" name="employee_status" value="5" @if($employees->employee_status == 4) checked  @endif>
          <label class="custom-control-label" for="ds5">Level Increased</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ds99" name="employee_status" value="99" @if($employees->employee_status == 99) checked  @endif>
          <label class="custom-control-label" for="ds99">Cleared</label>
        </div>
        </div>
                
                
        
            </div>
                
                
        
            </div>

            

            <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
            
            <div class="row">
                <div class="md-form">
                    <input type="file" class="form-control" name="photo[]" multiple />
                </div>
            </div>
            
            <div class="text-center mb-3">
                <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Save Employee's Demographic Info</button>
            </div>
        </div>

    </div>

</div>
{!! Form::close() !!}