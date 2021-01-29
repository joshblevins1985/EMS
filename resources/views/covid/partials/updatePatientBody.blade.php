<form action="updatePatientExposure/{{$patient->id}}" method="POST">
@csrf


<div class="form-group row">
    <label class="col-lg-4 col-form-label">Date of Transport</label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="datepicker-default" name="transport_date" placeholder="Select Date" value=" @if($patient->transport_date == '0000-00-00')   @else {{\Carbon\Carbon::parse($patient->transport_date)->format('m-d-Y')}} @endif" data-parsley-required="true" />
    </div>
</div>

<div class="form-group row m-b-15">
    <label class="col-md-4 col-sm-4 col-form-label" for="fullname">Patient Name</label>
    <div class="col-md-8 col-sm-8">
        <input class="form-control" type="text" id="fullname" name="patient_name" value="{{$patient->patient_name}}" placeholder="Required" data-parsley-required="true" />
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Date of Birth</label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="datepicker-default2" value="{{Carbon\Carbon::parse($patient->date_of_birth)->format('m-d-Y') }}" name="dob" placeholder="Select Date"  />
    </div>
</div>

<div class="form-group row m-b-15">
    <label class="col-md-4 col-sm-4 col-form-label" for="pick_up">Pick Up Location</label>
    <div class="col-md-8 col-sm-8">
        <input class="form-control" type="text" id="pick_up" name="pick_up" value="{{$patient->pick_up}}" placeholder="Required" data-parsley-required="true" />
    </div>
</div>

<div class="form-group row m-b-15">
    <label class="col-md-4 col-sm-4 col-form-label" for="drop_off">Drop Off Location</label>
    <div class="col-md-8 col-sm-8">
        <input class="form-control" type="text" id="drop_off" name="drop_off" value="{{$patient->drop_off}}" placeholder="Required" data-parsley-required="true" />
    </div>
</div>

<div class="form-group row m-b-15">
    <label class="col-md-4 col-sm-4 col-form-label" for="drop_off">Patient Status</label>
    <div class="col-md-8 col-sm-8">
        <select select class="select2 form-control"  name="status" data-parsley-required="true">

            <option value="0" @if($patient->patient_status == 0) selected @endif>Pending</option>
            <option value="1" @if($patient->patient_status == 1) selected @endif>Negetive</option>
            <option value="2" @if($patient->patient_status == 2) selected @endif>Possible</option>
            <option value="3" @if($patient->patient_status == 3) selected @endif>Not Applicable</option>
            <option value="4" @if($patient->patient_status == 4) selected @endif>Positive Exposure</option>
        </select>
    </div>
</div>

<div class="form-group row m-b-15">
    <label class="col-md-4 col-sm-4 col-form-label" for="pick_up">Patient Follow Up Note</label>
    <div class="col-md-8 col-sm-8">
        <input class="form-control" type="text" id="pick_up" name="follow_up" value="{{$patient->follow_up_info}}"  />
    </div>
</div>

    <button type="submit" class="btn btn-primary" >Save Information</button>
</form>
    <script>

        var handleSelect2 = function() {
            $(".default-select1").select2();
            $(".default-select2").select2();
            $(".default-select3").select2();
            $(".default-select4").select2();
            $(".default-select5").select2();
            $('#datepicker-default').datepicker({
                todayHighlight: true
            });
            $('#datepicker-default2').datepicker({
                todayHighlight: true
            });

        };



        var FormPlugins = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleSelect2();
                }
            };
        }();

        $(document).ready(function() {
            FormPlugins.init();
        });

    </script>

