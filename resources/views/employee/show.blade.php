@extends('layouts.sidebar-fixed')

@section('page-title', trans('Employee Info'))
@section('page-heading', trans('Employee Info'))

<style>

    /* The heart of the matter */
    .testimonial-group > .row {
        overflow-x: auto;
        max-height: 400px;
        flex-wrap: nowrap;
    }

    .testimonial-group > .row > .col-lg-4 {
        display: inline-block;
        float: none;
    }


</style>



@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Employee Info')
</li>
@stop

@section('content')

@include('partials.toastr')
<div class="row">
    <div class="col-lg-3  col-sm-12">
        @permission('view.photo')
        <div class="row mb-3">
            <!--Deep-orange-->
            <button type="button" class="btn btn-warning mr-3" data-toggle="modal" data-target="#basicExample1">Add
                Photo
            </button>
            <a href="/employee/id/{{$employees->id}}">
                <button type="button" class="btn btn-warning  mr-3">Print Badge</button>
            </a>
            
            <a href="/employees/{{$employees->id}}/edit">
                <button type="button" class="btn btn-primary mr-3">Edit Employee</button>
            </a>


        </div>
        @endpermission

        <div class="row">
            <div class="col-lg-12">
                @include('employee.partials.demographics')
            </div>

        </div>

    </div>

    <div class="col-lg-7 col-sm-12">
        <div class="row">
            <div class="col-lg-12">
                <!-- Card -->
                <div class="card card-cascade">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient">

                        <!-- Title -->
                        <h2 class="card-header-title mb-3">Employee Demographics</h2>

                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">

                        <!-- Text -->
                        <p class="card-text">Employee Data Will Go Here</p>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Card -->
                <div class="card card-cascade">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header peach-gradient">

                        <!-- Title -->
                        <h2 class="card-header-title mb-3">Employee Files</h2>

                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">

                        <!-- Text -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a data-toggle="modal" data-target="#modalEncounters" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fas fa-indent fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Encounters</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-money fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Pay Rates</p>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a data-toggle="modal" data-target="#modalSchedule" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-calendar-check-o fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Schedule</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-calendar-times-o fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Quarterly Attendance</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a data-toggle="modal" data-target="#modalStateCert" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-id-card fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">State Certifications</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-id-card-o fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">ABC Certifications</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a data-toggle="modal" data-target="#modalContinuingEducation" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-book fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Continuing Education</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a data-toggle="modal" data-target="#modalCompetency" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-book fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Competencies</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-book fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Quality Assurance</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a data-toggle="modal" data-target="#modalDra" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-car fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Drivers Risk Assessment</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <a data-toggle="modal" data-target="#modalDriver" class="text-center no-decoration">
                                            <div class="icon my-3">
                                                <i class="fa fa-list fa-2x"></i>
                                            </div>
                                            <p class="lead mb-0">Driving Reviews</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
           
        </div>
    </div>

    <div class="col-lg-2 col-sm-12">
        @include('employee.partials.notifications')
        
         @include('employee.partials.reports')
         
        @include('employee.partials.fieldtraining')
        
        @include('employee.partials.orientation')
        
        @include('employee.partials.field_training')
        
        @include('employee.partials.photomodal')
        
        @include('employee.partials.modalschedule')
        
        @include('employee.partials.modalscheduledate')
        
        @include('employee.partials.modalstatecert')
        
        @include('employee.partials.modalstatecertform')
        
        @include('employee.partials.modaldriver')
        
        @include('employee.partials.modalcompetencies')
        
        @include('employee.partials.dra')
        
        @include('employee.partials.store_mvr')
        
        @include('employee.partials.store_driver')
        
        @include('employee.partials.store_dra')
        
        @include('classes.partials.modal_course_complete')
        
        @include('employee.partials.modalencounters')

        @include('employee.partials.modalNewCertificate')

    </div>
</div>


@include('employee.partials.courses')



    @stop

    @push('css')
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/signature-pad.css') }}">
    <!-- Bootstrap Date-Picker Plugin -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link href="/assets/corona/vendors/cropper/cropper.css" rel="stylesheet">

    @endpush

    @push('scripts')
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
        <script src="/assets/plugins/highlight.js/highlight.min.js"></script>
        <script src="/assets/js/demo/render.highlight.js"></script>
        <script src="/assets/corona/vendors/cropper/cropper.js"></script>

        <script>
            const preview = document.getElementById('cert');
            const file_input = document.getElementById('file');
            let cropper;

            function previewFile  () {
                let file = file_input.files[0];
                let reader = new FileReader();

                reader.addEventListener('load', function (event) {
                    preview.src = reader.result;
                }, false);

                if(file)
                {
                    reader.readAsDataURL(file);
                }
            }

            preview.addEventListener('load', function (event) {
               cropper =  new Cropper(preview,{

                });
                console.log('image loaded');
            });

            let form = document.getElementById('new-certification');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                cropper.getCroppedCanvas({

                }).toBlob(function (blob) {
                    //console.log(blob);
                    formSubmit(blob);

                })
            })

            function formSubmit(blob) {
                let url = '/certificates';
                let request_method = 'POST'; //get form GET/POST method
                let form_data = new FormData(document.getElementById('new-certification')); //Encode form elements for submission
                form_data.append('cert', blob);

                console.log(blob);

                console.log(form_data);



                $.ajax({
                    type: request_method,
                    url: url,
                    data: form_data,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        alert('Image has been uploaded successfully');
                        $('#new-certification').trigger("reset");

                        cropper("destroy");

                    },
                    error: function(response){
                        console.log(response);
                    }
                });;
            }


        </script>

<script>
    $('#modalStateCertForm').on('show.bs.modal', function(e) {
        var employee = $(e.relatedTarget).data('employee');

        $("#employee_id").val(employee);
  
    });
</script>
    
<script>
    $('#input_starttime').pickatime({
    // 12 or 24 hour
    twelvehour: false,
});
</script>
    <script type="text/javascript">

    $('.datetimepicker-input').each(function() {
			var value = $(this).val();
			$(this).datetimepicker({
				format: 'DD/MM/YYYY HH:mm',
				date: value
			});
			$(this).val(value);
		});
        </script>
        
        
        <script type="text/javascript">
        $('#repeatCheckBox').change(function() {
            $('#repeatinfo').toggle();
        });
        </script>
        <script>
            // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
        </script>
        
        <script>
$('#mvrModal').on('show.bs.modal', function(e) {
    var employee1 = $(e.relatedTarget).data('employee1');

    $("#employee_id1").val(employee1);

});
</script>

        <script>
$('#driverModal').on('show.bs.modal', function(e) {
    var employee2 = $(e.relatedTarget).data('employee2');

    $("#employee_id2").val(employee2);

});
</script>

        <script>
$('#draModal').on('show.bs.modal', function(e) {
    var employee3 = $(e.relatedTarget).data('employee3');

    $("#employee_id3").val(employee3);

});
</script>
<script>
    $(document).on("click", ".open-courseComplete", function () {
     var userId = $(this).data('userid');
     var classId = $(this).data('classid');
     $(".modal-body #userId").val( userId );
     $(".modal-body #classId").val( classId );
});
</script>

        <script>
            $(document).ready(function(){
                var date_input=$('.datepicker'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'mm/dd/yyyy',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                };
                date_input.datepicker(options);
            })
        </script>

    @endpush