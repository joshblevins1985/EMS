    @csrf


    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Date of Transport</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="datepicker-default" name="transport_date" placeholder="Select Date" value="{{\Carbon\Carbon::now()->format('m-d-Y')}}" data-parsley-required="true" />
        </div>
    </div>

    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label" for="fullname">Patient Name</label>
        <div class="col-md-8 col-sm-8">
            <input class="form-control" type="text" id="fullname" name="patient_name" placeholder="Required" data-parsley-required="true" />
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Date of Birth</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="datepicker-default2" name="dob" placeholder="Select Date"  />
        </div>
    </div>

    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label" for="pick_up">Pick Up Location</label>
        <div class="col-md-8 col-sm-8">
            <input class="form-control" type="text" id="pick_up" name="pick_up" placeholder="Required" data-parsley-required="true" />
        </div>
    </div>

    <div class="form-group row m-b-15">
        <label class="col-md-4 col-sm-4 col-form-label" for="drop_off">Drop Off Location</label>
        <div class="col-md-8 col-sm-8">
            <input class="form-control" type="text" id="drop_off" name="drop_off" placeholder="Required" data-parsley-required="true" />
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Affected Employees</label>
        <div class="col-lg-8">
            <select select class="multiple-select2 form-control" multiple="multiple" name="employee_id[]" data-parsley-required="true">

                @foreach($employees as $row)
                    <option value="{{$row->user_id}}">{{$row->last_name}}, {{$row->first_name}}</option>
                @endforeach
            </select>
        </div>
    </div>


