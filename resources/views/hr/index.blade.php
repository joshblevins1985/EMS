@extends('layouts.app')

@section('page-title', trans('Human Resources'))
@section('page-heading', trans('Human Resources'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Human Resources')
</li>
@stop

@section('content')

@include('partials.toastr')

<div class="row">
    @include('hr.partials.emptype')
</div>

<div class="row">
    @include('hr.partials.drivercount')
</div>
<div class="row">
    <div class="col-lg-4 col-md-12">
        @include('hr.partials.notifications')
    </div>
    <div class="col-lg-6 col-md-12">


        @include('hr.partials.ftoems')


    </div>

    <div class="col-lg-2 col-md-12">
        @include('hr.partials.menu')

        @include('hr.partials.dragraph')
    </div>
</div>

<!-- Side Modal Top Right -->

<!-- To change the direction of the modal animation change .right class -->
<div class="modal fade right" id="driverModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-small" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="driverLabel">Driver Report</h4>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form class="form-inline" role="search" method="GET" action="{{url('/driver/pdf')}}">
                    @csrf


                    <select class="mdb-select md-form" name="driver">
                        <option value="" disabled selected>Select Driver Status</option>

                        <option value="0">Non-Drivers</option>
                        <option value="1">Drivers</option>
                        <option value="2">30 Step 1</option>
                        <option value="3">30 Step 2</option>
                        <option value="4">30 Step 4</option>
                        <option value="5">BTD Program</option>
                        <option value="6">All Employees</option>

                    </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Get Report</button>

                </form>


            </div>
        </div>
    </div>
</div>


@include('hr.partials.ftoemsmodal')

@include('hr.partials.orientationmodal')

@include('hr.partials.drivermodal')



@stop

@section('styles')
<style>
    .btn-link {
        border: none;
        outline: none;
        background: none;
        cursor: pointer;
        color: #0000EE;
        padding: 0;
        text-decoration: underline;
        font-family: inherit;
        font-size: inherit;
    }
</style>

<style>
    ul.horizontal-fix li a {
        padding: .84rem 2.14rem;
    }
</style>

<!-- Stepper CSS -->

@stop

@section('scripts')

<script>
    // Data Picker Initialization
    $('.datepicker').pickadate();
</script>
<script type="text/javascript">


    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    
    $('.education_form').on('submit',function(e){
    var form = $(this);
    var submit = form.find("[type=submit]");
    var submitOriginalText = submit.attr("value");

    e.preventDefault();
    var data = form.serialize();
    var url = form.attr('action');
    var post = form.attr('method');
    $.ajax({
        type : post,
        url : '{{route('application.store')}}',
        data :data,
        success:function(data){
           submit.attr("value", "Submitted");
           console.log(data)
        },
        beforeSend: function(){
           submit.attr("value", "Loading...");
           submit.prop("disabled", true);
        },
        error: function() {
            submit.attr("value", submitOriginalText);
            submit.prop("disabled", false);
            
           // show error to end user
        }
    })
})

</script>

<script src="{{ url('public/assets/js/addons-pro/steppers.js') }}"></script>
<!-- Stepper JavaScript -->

<script>
    $(document).ready(function () {
        $('.stepper').mdbStepper();
    })

    function someFunction22() {
        setTimeout(function () {
            $('#horizontal-stepper-fix').nextStep();
        }, 2000);
    }
</script>

<script type="text/javascript">
    function add_row_employment() {
        $rowno = $("#employee_table tr").length;
        $rowno = $rowno + 1;
        $("#employee_table tr:last").after("" +
            "<tr id='row" + $rowno + "'>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='estart[]' placeholder='Start Date'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='eend[]' placeholder='End Date'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='ename[]' placeholder='Name'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='eaddress[]' placeholder='Address'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='ewage[]' placeholder='Position'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='eleave[]' placeholder='Reason for Leaving'></div> </td>" +
            "<td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></div></td>" +
            "</tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>

<script type="text/javascript">
    function add_row_school() {
        $rowno = $("#school_table tr").length;
        $rowno = $rowno + 1;
        $("#school_table tr:last").after("" +
            "<tr id='row" + $rowno + "'>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='scompleted[]' placeholder='Year Completed'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='sname[]' placeholder='School Name'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='saddress[]' placeholder='State'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='sdegree[]' placeholder='Degree/Certification'></div> </td>" +
            "<td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></div></td>" +
            "</tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>



@stop