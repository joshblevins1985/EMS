<link href="/public/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"
      rel="stylesheet"/>
<link rel="stylesheet" href="/public/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css"/>
<div class="row m-5">
    <div class="col-xl-8">
        @csrf

        <div class="md-form">
            <input type="text" id="number" name="number" class="form-control" value="{{$class->id}}">
            <label for="number">Course Number</label>
        </div>

        <select class="form-control mt-2 mb-2 selectpicker" name="location" data-live-search="true"
                data-style="btn-inverse" data-styleBase="form-control">
            <option value="" disabled selected>Choose Facility</option>
            @foreach($facilities as $id => $facility)
                <option value="{{$id}}" @if($id == $class->location) selected  @endif>{{$facility}}</option>
            @endforeach
        </select>

        <div class="input-group date mb-2 btn-inverse" id="startTime">
            <label for="startTime">Start Time</label>
            <input type="text" name="start" id="start" class="form-control" data-parsley-group="step-3"
                   data-parsley-required="true" value="{{$class->start_date}}"/>
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
        </div>
        <div class="input-group date mb-2" id="endTime">
            <label for="endTime">Start Time</label>
            <input type="text" name="end" id="endTime" class="form-control" data-parsley-group="step-3"
                   data-parsley-required="true" value="{{$class->end_date}}"/>
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
        </div>


        <div class="md-form">
            <i class="fa fa-envelope prefix"></i>
            <input type="text" id="inputIconEx2" name="email" class="form-control" value="{{$class->email}}">
            <label for="inputIconEx2">E-mail address for Certificates</label>
        </div>

        <select class="form-control mt-2 selectpicker" name="instructor" searchable="Search Instructor">
            <option value="" disabled selected>Choose Instructor</option>
            @foreach($instructors as $row)
                <option value="{{$row->id}}" @if($row->id == $class->instructor) selected  @endif>{{$row->last_name}}, {{$row->first_name}}</option>
            @endforeach
        </select>

        <select class="form-control mt-2 selectpicker" name="status">
            <option value="" disabled selected>Choose Facility</option>

            <option value="1" @if($class->status = 1 ) selected @endif>Scheduled</option>
            <option value="2" @if($class->status = 1 ) selected @endif>Instructed</option>
            <option value="3" @if($class->status = 1 ) selected @endif>Invoice Sent</option>
            <option value="4" @if($class->status = 1 ) selected @endif>Paid</option>
            <option value="5" @if($class->status = 1 ) selected @endif>Canceled</option>
            <option value="6" @if($class->status = 1 ) selected @endif>Completed</option>


        </select>
    </div>
    <div class="col-xl-3">
        <div class="col-xl-12 p-5 text-center text-success">
            <i class="fad fa-chalkboard-teacher fa-7x"></i>
        </div>
        <div class="col-xl-12 p-5 text-center text-warning">
            <i class="fad fa-cash-register fa-7x"></i>
        </div>

        <div class="col-xl-12 p-5 text-center text-danger">
            <i class="far fa-window-close fa-7x"></i>
        </div>
    </div>
</div>
<script src="/public/assets/plugins/moment/moment.js"></script>
<script src="/public/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/public/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<script>
    var handleDateTimePicker = function () {
        $('#startTime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#endTime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });

    };

    var FormPlugins = function () {
        "use strict";
        return {
            //main function
            init: function () {
                handleDateTimePicker();
            }
        };
    }();

    $(document).ready(function () {
        Calendar.init();
        FormPlugins.init();
    });
</script>