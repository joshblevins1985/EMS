<!-- begin col-8 -->
<div class="col-xl-10">
    <legend class="no-border">Personal info about yourself</legend>
    <!-- begin form-group -->
    <div class="form-group row offset-2">
        <div class="col-xl-3 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="first_name" placeholder="First Name" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-2 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="middle_name" placeholder="Middle Name" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-3 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="last_name" placeholder="Last Name" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-3 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="preffered_name" placeholder="Preferred Name" data-parsley-group="step-1" class="form-control" />
            </div>
        </div>
    </div>
    <!-- end form-group -->

</div>
<!-- end col-8 -->

<!-- begin col-8 -->
<div class="col-xl-10">
    <!-- begin form-group -->
    <div class="form-group row offset-2">
        <div class="col-xl-4 col-sm-12 m-2">
            <div class="input-group date md-form" data-provide="datepicker">
                <input type="text" name="dob" placeholder="Date of Birth" data-parsley-group="step-1" data-parsley-required="true" class="form-control">
                <div class="input-group-addon">
                    <span ><i class="fa fa-birthday-cake"></i></span>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="ssn" placeholder="Social Security Number" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-3 col-sm-12 m-2">
                    <select name="oppurtunity_id" class="selectpicker" data-width="fit" data-style="btn-dark" title="Choose Class you would like to attend">
                        @foreach($oppurtunities as $row)
                        <option value="{{ $row->id }}">{{ $row->school_name }} Start Date: {{ Carbon\Carbon::parse($row->start_date)->format('m-d-Y') }}</option>
                        @endforeach
                    </select>
        </div>
    </div>
    <!-- end form-group -->

</div>
<!-- end col-8 -->

<!-- begin col-8 -->
<div class="col-xl-10">
    <!-- begin form-group -->
    <div class="form-group row offset-2">
        <div class="col-xl-4 col-sm-12 m-2">
            <div class="input-group">
                <div class="input-group-addon">
                   <span><i class="fa fa-envelope prefix"></i></span> 
                </div>
                
                <input type="email" name="email" placeholder="Personal Email Address" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-4 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="phone" placeholder="Mobile Phone Number" data-parsley-group="step-1"  class="form-control" />
            </div>
        </div>
        <div class="col-xl-3 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="phone_mobile" placeholder="Alternate Phone Number" data-parsley-group="step-1"  class="form-control" />
            </div>
        </div>
    </div>
    <!-- end form-group -->

</div>
<!-- end col-8 -->

<!-- begin col-8 -->
<div class="col-xl-10">
    <!-- begin form-group -->
    <div class="form-group row offset-2">
        <div class="col-xl-3 col-sm-12 m-2">
            <div class="input-group">
                <div class="input-group-addon">
                   <span><i class="fa fa-home prefix"></i></span> 
                </div>
                <input type="text" name="street_number" placeholder="House #" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
                
            </div>
        </div>
        <div class="col-xl-7 col-sm-12 m-2">
            <div class="input-group">
                <div class="input-group-addon">
                   <span><i class="fa fa-road prefix"></i></span> 
                </div>
                
                <input type="text" name="route" placeholder="Street Name" data-parsley-group="step-1" data-parsley-required="true"  class="form-control" />
            </div>
        </div>
        
    </div>
    <!-- end form-group -->

</div>
<!-- end col-8 -->

<!-- begin col-8 -->
<div class="col-xl-10">
    <!-- begin form-group -->
    <div class="form-group row offset-2">
        <div class="col-xl-4 col-sm-12 m-2">
            <div class="md-form">
            <input type="text" name="city" id="step-1" placeholder="City" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-4 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="state" placeholder="State" data-parsley-group="step-1"  data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-3 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="postal_code" placeholder="Zip Code" data-parsley-group="step-1"  data-parsley-required="true" class="form-control" />
            </div>
        </div>
    </div>
    <!-- end form-group -->

</div>
<!-- end col-8 -->

<!-- begin col-8 -->
<div class="col-xl-10">
    <!-- begin form-group -->
    <div class="form-group row offset-2">
        <div class="col-xl-4 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="dl_number" placeholder="Driver License Number" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-4 col-sm-12 m-2">
            <div class="md-form">
                <input type="text" name="dl_state" placeholder="Licensing State" data-parsley-group="step-1"  data-parsley-required="true" class="form-control" />
            </div>
        </div>
        <div class="col-xl-3 col-sm-12 m-2">
            <div class="input-group date md-form" data-provide="datepicker">
                <input type="text" name="drivers_license_expiration" placeholder="Expiration" data-parsley-group="step-1" data-parsley-required="true" class="form-control">
                <div class="input-group-addon">
                    <span ><i class="fa fa-calendar-times"></i></span>
                </div>
            </div>
        </div>
    </div>
    <!-- end form-group -->
    
    
</div>
<!-- end col-8 -->
<!-- begin col-8 -->

{{ csrf_field() }}

<!-- end col-8 -->