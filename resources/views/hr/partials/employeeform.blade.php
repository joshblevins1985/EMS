<form action="{{ route('application.store') }}" method="post" enctype="multipart/form-data">

<div class=row >
    <div class="col-12 ">

        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Full Name</p>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col">
                        <div class="md-form">
                            <i class="fa fa-user prefix"></i>
                            <input type="text" id="first_name" name="first_name" class="form-control validate" placeholder="First Name" required>

                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form">

                            <input type="text" id="middle_name" name="middle_name" class="form-control validate" placeholder="Middle Name" >

                        </div>
                    </div>
                    <div class="col">
                        <div class="md-form">

                            <input type="text" id="last_name" name="last_name" class="form-control validate" placeholder="Last Name" required>

                        </div>
                    </div>
                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Preferred Name</p>
            </div>
            <div class="col-9">

                <div class="md-form">

                    <input type="text" id="prefered_name" name="prefered_name" class="form-control validate" placeholder="Preferred Name" >

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
                    <input placeholder="Date of Birth" type="text" name="dob" id="dob" class="form-control datepicker">

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

                    <input type="tel" id="ssn" name="ssn" class="form-control validate" placeholder="Social Security Number" >

                </div>
            </div>
            <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
        </div>
        <div class=row>
            <div class="col-3">
                <p class="font-weight-bold">Ethnicity</p>
            </div>
            <div class="col-9">
                <select class="mdb-select" id="ethnicity" name="ethnicity">
                    <option value="" disabled selected>Choose Employees Ethnicity</option>
                    <option value="1">Caucasion</option>
                    <option value="2">African American</option>
                    <option value="3">Native American</option>
                    <option value="4">Hispanic</option>
                    <option value="5">Other</option>
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
                    <input type="email" id="personal_email" name="personal_email" class="form-control validate" placeholder="Personal Email" >

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
                        <input type="tel" id="phone" name="phone" class="form-control validate" placeholder="Phone Number" >

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
                        <input type="tel" id="phone_mobile" name="phone_mobile" class="form-control validate" placeholder="Mobile Phone" >

                    </div>
                </div>

            </div>
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Mobile Carrier</p>
                </div>
                <div class="col-9">

                    <select class="mdb-select" id="phone_carrier" name="phone_carrier">
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
    <div class="col-12">
        

        <div class="d-flex flex-column">
           
                    <div class="row">
                        <div class="col-3">
                            <div class="md-form">
                                <i class="fa fa-home prefix"></i>
                                <input type="tel" id="street_number" name="street_number" class="form-control validate" placeholder="House #" >

                            </div>
                        </div>
                        <div class="col-9">
                            <div class="md-form">
                                <i class="fa fa-road prefix"></i>
                                <input type="text" id="route" name="route" class="form-control validate" placeholder="Street Name" >

                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-12">
                            <div class="md-form">
                                <i class="fa fa-road prefix"></i>
                                <input type="text" id="address_2" name="address_2" class="form-control validate" placeholder="Address P.O Box or add Info">

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

                                <input type="tel" id="locality" name="locality" class="form-control validate" placeholder="City" >

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="md-form">

                                <input type="text" id="administrative_area_level_1" name="state" class="form-control validate" placeholder="State" >

                            </div>
                        </div>
                        <div class="col-2">
                            <div class="md-form">

                                <input type="text" id="postal_code" name="postal_code" class="form-control validate" placeholder="Zip Code" >

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Driver License #/State/Expiration</p>
                </div>
                

                <div class="col-9">


                    <div class="row">
                        <div class="col-4">
                            <div class="md-form">

                                <input type="tel" id="dl" name="drivers_license" class="form-control validate" placeholder="License Number" >

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="md-form">

                                <input type="text" id="dlstate" name="driver_license_state" class="driver_license_state" placeholder="State" >

                            </div>
                        </div>
                        <div class="col-2">
                            <div class="md-form">
                                <input placeholder="Expiration" type="text" name="drivers_license_expiration" id="drivers_license_expiration" class="form-control datepicker">
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
            
            <div class="d-flex flex-column">
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Select all certifications you hold:</p>
                </div>
                <div class="col-9">
                    <select class="mdb-select colorful-select dropdown-primary" id="certifications" name="certifications[]" multiple searchable="Search here.." >
                        <option value="" disabled selected>Select all certifications</option>
                        @foreach($certification as $id => $certification)
                        <option value="{{$id}}" >{{$certification}}</option>
                        @endforeach
                    </select>

                </div>

            </div>
            
        </div>

            <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
        </div>

        <div class="d-flex flex-column">
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Station or Location Applying for:</p>
                </div>
                <div class="col-9">
                    <select class="mdb-select colorful-select dropdown-primary" id="primary_station" name="primary_station" >
                        <option value="" disabled selected>Choose Station or Location</option>
                        @foreach($station as $id => $station)
                        <option value="{{$id}}" >{{$station}}</option>
                        @endforeach
                    </select>

                </div>

            </div>
            <div class=row>
                <div class="col-3">
                    <p class="font-weight-bold">Position Applying for:</p>
                </div>
                <div class="col-9">
                    <select class="mdb-select" id="primary_position" name="primary_position">
                        <option value="" disabled selected>Choose Position</option>
                        @foreach($employeepositions as $id => $eposition)
                        <option value="{{$id}}">{{$eposition}}</option>
                        @endforeach
                    </select>
                </div>
                <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
            </div>
            
        </div>

        


    </div>
    <button type="submit" class="btn primary-color btn-lg btn-block">Next Section</button>

</div>
{{ csrf_field() }}
{!! Form::close() !!}