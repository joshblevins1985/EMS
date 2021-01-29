@extends('layouts.default')

@section('title', 'Patient Information')

@push('css')
<link href="/public/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
<link rel="stylesheet" href="/public/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="/public/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="/public/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="/public/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="/public/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="/public/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .pac-container {
   
    position: relative;
    z-index: 9999999
}
.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; background-color: black; }
.toggle.ios .toggle-handle {  border-radius: 20px; background-color: black; }

.btn-group.special {
  display: flex;
}

.special .btn {
  flex: 1
}

tr.border_bottom td {
  border-bottom:1pt solid black;
  border-color: white;
}
</style>
@endpush


@section('content')

    @include('partials.toastr')
    <div class="row">
        <div class="col-lg-4 col-sm-12">

            <div class="row">
                <div class="col-lg-12">
                    <div class = "panel panel-default">
                       <div class = "panel-heading bg-dark">
                           <div class="col-xl-10">
                               Patient Demographics
                           </div>
                           
                       </div>
                       
                       <div class = "panel-body">
                          <div class="row">
                              <!--Card image-->
                            <div class="view view-cascade top rounded-circle">
                                <a href="/employee/id/{{$pt->id}}"> <img src="/storage/app/employee_photos/{{$pt->eid}}.png" class="card-img-top rounded-circle"
                                                                               onerror="this.src='/storage/app/employee_photos/nouser.png'"  alt="" style="height:300px;"> </a>
                                <a href="/employee/id/{{$pt->id}}">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                          </div>
                          <div class="row">
                              <table class="table table-borderless">
                                  <tr>
                                      <th>Patient Name</th>
                                      <td>{{decrypt($pt->first_name) ?? ''}} {{decrypt($pt->middle_name) ?? ''}} {{decrypt($pt->last_name) ?? ''}}</td>
                                  </tr>
                                  <tr>
                                      <th>Date of Birth</th>
                                      <td>{{ Carbon\Carbon::parse($pt->dob)->format('m/d/Y') }}</td>
                                  </tr>
                                  <tr>
                                      <th>Age</th>
                                      <td>{{ Carbon\Carbon::parse($pt->dob)->age }}</td>
                                  </tr>
                                  <tr>
                                      <th>SSN</th>
                                      <td>{{decrypt($pt->ssn) ?? ''}}</td>
                                  </tr>
                                  <tr>
                                      <th>Home Phone</th>
                                      <td><?php $phone_home = decrypt($pt->phone); ?> <abbr title="Phone">P:{{ '('.substr($phone_home, 0, 3).') '.substr($phone_home, 3, 3).'-'.substr($phone_home,6)  }}</abbr></td>
                                  </tr>
                                  <tr>
                                      <th>Mobile Phone</th>
                                      <td><?php $phone = decrypt($pt->phone_mobile); ?> <abbr title="Phone">P:{{ '('.substr($phone, 0, 3).') '.substr($phone, 3, 3).'-'.substr($phone,6)  }}</abbr></td>
                                  </tr>
                                  <tr>
                                      <th>Email Address</th>
                                      <td>{{ decrypt($pt->email) }}</td>
                                  </tr>
                                  <tr>
                                      <th>Address</th>
                                      <td><address>
                                      {{$pt->street_number ?? ''}} {{decrypt($pt->route) ?? ''}} <br>
                                      {{decrypt($pt->locality) ?? ''}} {{decrypt($pt->state) ?? ''}} {{decrypt($pt->postal_code) ?? ''}}<br>
                                      
                                    </address></td>
                                  </tr>
                              </table>
                          </div>
                       </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-lg-5 col-sm-12">
            
            <div class="row">

                    <div class="col-lg-12">
                    
                    <div class = "panel panel-default">
                       <div class = "panel-heading bg-primary">
                           <div class="col-xl-10">
                               Patient Physician's
                           </div>
                           <div class="col-xl-1 pull-right">
                               <span class="text-success pull-right"><a data-toggle="modal" data-target="#addPhysicainToPatient" ><i class="far fa-plus-square fa-2x"></i></a></span>
                           </div>
                       </div>
                       
                       <div class = "panel-body">
                          <div class="row">
                             <div class="col-xl-12">
                                
                                    @if(count($pt->physician))
                                    
                                    <table class="table table">
                                        <tr>
                                            <th>Physician Name</th>
                                            <th>NPI Number</th>
                                            <th>Is Active with Patient</th>
                                        </tr>
                                        @foreach($pt->physician as $row)
                                        <tr>
                                            <td>{{ $row->doctor->first_name ?? '' }} {{ $row->doctor->last_name ?? '' }}</td>
                                            <td>{{ $row->doctor->npi }}</td>
                                            <td>@if($row->status == 1) Active @else  @endif</td>
                                        </tr>
                                        @endforeach
                                    </table>

                                  @else
                                 <table class="table table"> 
                                    <tr>
                                        <td>No Physician's on Record</td>
                                        
                                    </tr>
                                 </table>
                                  @endif
                                

                            </div>
                          </div>
                       </div>
                    </div>
                 
                </div>

            </div>
            
            <div class="row">

                    <div class="col-lg-12">
                    
                    <div class = "panel panel-default">
                       <div class = "panel-heading bg-primary">
                           <div class="col-xl-10">
                               Patient Insurance
                           </div>
                           <div class="col-xl-1 pull-right">
                               <span class="text-success pull-right"><a data-toggle="modal" data-target="#addInsurance" ><i class="far fa-plus-square fa-2x"></i></a></span>
                           </div>
                       </div>
                       
                       <div class = "panel-body">
                          <div class="row">
                             <div class="row">
                                <ul class="list-group">
                                    @if(count($pt->insurance))
                                    @foreach($pt->insurance as $row)
                                  <li class="list-group-item">
                                      <div class="row">
                                          <div class="col-lg-4">
                                              {{$row->insur->label}}
                                          </div>
                                          <div class="col-lg-4">
                                             Group: {{$row->group_id}}
                                          </div>
                                          <div class="col-lg-4">
                                              Policy: {{$row->policy_id}}
                                          </div>
                                      </div>
                                          
                                  </li>
                                  @endforeach
                                  @else
                                  <ul class="list-group">
                                      <li class="list-group-item">
                                      <div class="col-lg-12">
                                          No Insurance on File
                                      </div>
                                  </li>
                                  </ul>
                                  @endif
                                

                            </div>
                          </div>
                       </div>
                    </div>
                 
                </div>

            </div>
            
            <div class="row">

                    <div class="col-lg-12">
                    
                    <div class = "panel panel-default">
                       <div class = "panel-heading bg-primary">
                           <div class="col-xl-10">
                               Patient Medical History
                           </div>
                           <div class="col-xl-1 pull-right">
                               <span class="text-success pull-right"><a data-toggle="modal" data-target="#addMedical" ><i class="far fa-plus-square fa-2x"></i></a></span>
                           </div>
                       </div>
                       
                       <div class = "panel-body">
                          <div class="row">
                             <div class="row">
                                
                                    @if(count($pt->medical))
                                   <ul class="list-group">
                                    @foreach($pt->medical as $row)
                                
                                  <li class="list-group-item mb-2">
                                      <div class="row">
                                          <div class="col-xl-4">
                                              {{$row->condition->label}}
                                          </div>
                                          <div class="col-xl-4">
                                             Date Added: {{ Carbon\Carbon::parse($row->created_at)->format('m-d-Y') }}
                                          </div>
                                          <div class="col-xl-4">
                                              Obtained From: @if($row->reported_by == 1) Patient @elseif($row->reported_by == 2) Family @elseif($row->reported_by == 3) Medical Staff @elseif($row->reported_by == 4) Medical Records @else Other @endif
                                          </div>
                                      </div>
                                          
                                  </li>
                                  
                                  @endforeach
                                  </ul>
                                  @else
                                  <ul class="list-group">
                                      <li class="list-group-item">
                                      <div class="col-lg-12">
                                          No Medical History on File
                                      </div>
                                  </li>
                                  </ul>
                
                                  @endif
                                
                            </div>
                          </div>
                       </div>
                    </div>
                 
                </div>

            </div>
            
        </div>

        <div class="col-lg-3 col-sm-12">

            <div class = "panel panel-default">
                       <div class = "panel-heading bg-danger">
                           <div class="col-xl-10">
                               <h1>Notifications</h1>
                           </div>
                           <div class="col-xl-1 pull-right">
                               <span class="text-success pull-right"></span>
                           </div>
                       </div>
                       
                       <div class = "panel-body">
                          
                       </div>
                    </div>

        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="row">

                    <div class="col-lg-12">
                    
                    <div class = "panel panel-default">
                       <div class = "panel-heading bg-danger">
                           <div class="col-xl-10">
                               Patient Tranport Qualifiers
                           </div>
                           <div class="col-xl-1 pull-right">
                               <span class="text-success pull-right"><a data-toggle="modal" data-target="#addTransportQualifier" ><i class="far fa-plus-square fa-2x"></i></a></span>
                           </div>
                       </div>
                       
                       <div class = "panel-body">
                           <div class="row">
                               <div class="col-xl-12 mb-2">
                                   Can this patient safely be transported in a wheelchair van (i.e., seated for the duration of the transport and without a medical attendant?)
                               </div>
                               <form action="/wheelchairChange"  method="post" id="changewheelchair">
                                   <input type="hidden" name="id" value="{{$pt->id}}">
                               <div class="col-xl-12 mb-2">
                                    <div class="btn-group special btn-group-toggle" data-toggle="buttons">
                                      <label class="btn btn-secondary @if(!$pt->safe_wheelchair) active @endif">
                                        <input type="radio" name="safe_wheelchair" id="option1" value="0" autocomplete="off" @if($pt->safe_wheelchair == 0) checked @endif > No
                                      </label>
                                      <label class="btn btn-secondary @if($pt->safe_wheelchair) active @endif">
                                        <input type="radio" name="safe_wheelchair" id="option2" value="1" autocomplete="off" @if($pt->safe_wheelchair == 1) checked @endif > Yes
                                      </label>
                                    </div>
                               </div>
                               </form>
                               <div id="bed_confined_info">
                                   <div class="col-xl-12 mb-2" >
                                       Non-Emergency transportation by ambulance is appropriate if either: the beneficiary is bed confined, and it is documented that the beneficiary's condition is such that other methods of tranport are contraindicated:
                                       <strong>OR</strong> if his or her medical condition, regardless of bed confinement, is such that tranportation by ambulance is medically required. (Bed confinement is not the sole criterion.) 
                                   </div>
                                   
                                   <div class="col-xl-12 mb-2" >
                                       To be bed confined the patient must be (1) unable to get up from bed without assistance <strong>AND</strong> (2) unable to ambulate <strong>AND</strong> (3) unable to sit in a chair or wheelchar. (All three of the above conditions must be met in order for the patient to qualify as bed confined)
                                       
                                   </div>
                                   
                                   <div class="col-xl-12 mb-2">
                                        Is the patient bed conofined as defined above? (You must add at a miniman (1) transport qualification with supporting medical condition that indicates why the patient is bed confined.
                                   </div>
                                   <form action="/bedConfined"  method="post" id="bedconfined">
                                       <input type="hidden" name="id" value="{{$pt->id}}">
                                   <div class="col-xl-12 mb-2">
                                        <div class="btn-group special btn-group-toggle" data-toggle="buttons">
                                          <label class="btn btn-secondary @if(!$pt->bed_confined) active @endif">
                                            <input type="radio" name="bed_confined" id="option3" value="0" autocomplete="off" @if(!$pt->bed_confined) checked @endif > No
                                          </label>
                                          <label class="btn btn-secondary @if($pt->bed_confined) active @endif">
                                            <input type="radio" name="bed_confined" id="option4" value="1" autocomplete="off" @if($pt->bed_confined) checked @endif> Yes
                                          </label>
                                        </div>
                                   </div>
                                   </form>
                               </div>
                                   
                               
                           </div>
                           <div class="row">
                               <div class="col-xl-12">
                                   
                                   <table class="table table-borderless">
                                       @if(count($pt->qualification))
                                       
                                    @foreach($pt->qualification as $row)
                                    <thead>
                                           <tr>
                                               <th>Qaulifier</th>
                                               <th>Medical Supporting Condition</th>
                                               <th>Expires</th>
                                               <th>Status</th>
                                           </tr>
                                       </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $row->qualifier->description }}</td>
                                            <td>{{ $row->pt_condition->condition->label}}</td>
                                            <td>{{ Carbon\Carbon::parse($row->expire)->format('m-d-Y') }}</td>
                                            <td><span id="tc_status{{ $row->id }}">{{ $row->stat->description }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Note: {{ $row->note }}</td>
                                        </tr>
                                        <tr class="text-center border_bottom">
                                            <td colspan="4">
                                                <a id='renewq' data-id="{{ $row->id }}"><span class="col text-warning"><i class="fas fa-recycle fa-2x" data-toggle="tooltip" data-placement="top" title="Renew transport qualifier."></i></span></a>
                                                <a id='activeq' data-id="{{ $row->id }}"><span class="col text-success"><i class="fad fa-check-double fa-2x" data-toggle="tooltip" data-placement="top" title="Mark qualifier as active and confirmed."></i></span></a>
                                                <a id='removeq' data-id="{{ $row->id }}"><span class="col text-warning"><span class="col text-danger"><i class="fad fa-eraser fa-2x" data-toggle="tooltip" data-placement="top" title="Remove transport qualifier."></i></span></a>
                                            </td>
                                        </tr>
                                    </tbody>
                               
                                  @endforeach
                                  
                                  @else
                                  <thead>
                                      <tr>
                                          <td>No Transport Qualifications</td>
                                      </tr>
                                  </thead>
                                  @endif
                                   </table>
                               </div>
                           </div>

                       </div>
                    </div>
                 
                </div>

            </div>
            
            <div class="row">

                    <div class="col-lg-12">
                    
                    <div class = "panel panel-default">
                       <div class = "panel-heading bg-warning">
                           <div class="col-xl-10">
                               Physician Certifications
                           </div>
                           <div class="col-xl-1 pull-right">
                               <span class="text-success pull-right"><a data-toggle="modal" data-target="#addDoctorsCert" ><i class="far fa-plus-square fa-2x"></i></a></span>
                           </div>
                       </div>
                       
                       <div class = "panel-body">
                          <div class="row">
                             <div class="col-xl-12">
                                 @if(count($pt->certifications))
                                    <table class="table table">
                                        <thead>
                                            <tr>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Physician</th>
                                                <th>Procedure</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    @foreach($pt->certifications as $row)
                                    
                                    <tr class="@if(Carbon\Carbon::parse($row->end_date)->subDays(15) <= Carbon\Carbon::now() &&  Carbon\Carbon::parse($row->end_date)->subDays(5) > Carbon\Carbon::now()) bg-warning @elseif(Carbon\Carbon::parse($row->end_date)->subDays(5) <= Carbon\Carbon::now()) bg-danger @endif">
                                        <td>{{ Carbon\Carbon::parse($row->start_date)->format('M d Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse($row->end_date)->format('M d Y') }}</td>
                                        <td> {{ $row->pt_physician->doctor->first_name ?? '&nbsp' }} {{ $row->pt_physician->doctor->middle_initial }} {{ $row->pt_physician->doctor->last_name ?? '' }}  </td>
                                        <td>{{ $row->procedure->description ?? '' }}</td>
                                        <td>
                                            <a href="/medicaidCert/{{ $row->id }}" target="_blank"><i class="fad fa-eye" data-toggle="tooltip" data-placement="top" title="View copy of PCS"></i></a>
                                            <a href="/medicaidCert/pdf/{{ $row->id }}" target="_blank"><i class="fas fa-file-pdf" data-toggle="tooltip" data-placement="top" title="Make saveable PDF Copy"></i></a>
                                            <i class="fas fa-upload" data-toggle="tooltip" data-placement="top" title="Upload signed copy of PCS"></i>
                                        </td>
                                    </tr>
                                  @endforeach
                                  </tbody>
                                  </table>
                             </div>
                                    
                                  @else
                                  <div class="row">
                                      <div class="col-lg-12 text-center">
                                        <table class="table">
                                            <tr>
                                                <td>Patient Has No Certification on File</td>
                                            </tr>
                                        </table>
                                    
                                      </div>
                                  </div>
                                  @endif
                          </div>
                       </div>
                    </div>
                 
                </div>

            </div>
        </div>
    </div>


   



@endsection

@include('patients.partials.modalAddPhysicianToPatient')
@include('patients.partials.modalAddPhysician')
@include('patients.partials.modalAddFacility')
@include('patients.partials.modalAddTransportQualifier')
@include('patients.partials.modalAddInsurance')
@include('patients.partials.modalAddMedical')




@push('scripts')
<script src="/public/assets/plugins/moment/moment.js"></script>
<script src="/public/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="/public/assets/plugins/select2/dist/js/select2.min.js"></script>

@if($pt->safe_wheelchair == 1)
<script>
    $(document).ready(function() {
        $("#bed_confined_info").hide();
    });
</script>
@endif

<script>
    
    $("input[name='safe_wheelchair']").change(function(e){
       var $form = $(this).closest('form');
        if($(this).val() == '0') {
            $form.submit();
            $("#bed_confined_info").show();
        } else {
            $form.submit();
            $("#bed_confined_info").hide();
        }
    
    });
    
    $("input[name='bed_confined']").change(function(e){
       var $form = $(this).closest('form');
       $form.submit();
    
    });
    
    $(document).on('submit', '#changewheelchair', function(event){
            	event.preventDefault(); //prevent default action 
            	var post_url = $(this).attr("action"); //get form action url
            	var request_method = $(this).attr("method"); //get form GET/POST method
            	var form_data = $(this).serialize(); //Encode form elements for submission
            	
            	$.ajax({
            		url : post_url,
            		type: request_method,
            		data : form_data
            	}).done(function(response){ //
            		toastr.success(response)
            	});
            });
            
    $(document).on('submit', '#bedconfined', function(event){
            	event.preventDefault(); //prevent default action 
            	var post_url = $(this).attr("action"); //get form action url
            	var request_method = $(this).attr("method"); //get form GET/POST method
            	var form_data = $(this).serialize(); //Encode form elements for submission
            	
            	$.ajax({
            		url : post_url,
            		type: request_method,
            		data : form_data
            	}).done(function(response){ //
            		toastr.success(response)
            	});
            });
            
    $(document).on('click', '#renewq', function(event){
                var id = $(this).attr("data-id");
            	event.preventDefault(); //prevent default action 
            	var post_url = '/transportQualifier/renew/'+ id; //get form action url
            	var request_method = $(this).attr("method"); //get form GET/POST method
            	var form_data = $(this).serialize(); //Encode form elements for submission
            	
            	$.ajax({
            		url : post_url,
            		type: request_method,
            		data : form_data
            	}).done(function(response){ //
            		toastr.success(response)
            	});
            });
            
    $(document).on('click', '#removeq', function(event){
                var id = $(this).attr("data-id");
            	event.preventDefault(); //prevent default action 
            	var post_url = '/transportQualifier/remove/'+ id; //get form action url
            	var request_method = $(this).attr("method"); //get form GET/POST method
            	var form_data = $(this).serialize(); //Encode form elements for submission
            	
            	$.ajax({
            		url : post_url,
            		type: request_method,
            		data : form_data
            	}).done(function(response){ //
            		toastr.success(response);
            		$('#tc_status'+id).text('Removed');
            	});
            });
  $(document).on('click', '#activeq', function(event){
                var id = $(this).attr("data-id");
            	event.preventDefault(); //prevent default action 
            	var post_url = '/transportQualifier/active/'+ id; //get form action url
            	var request_method = $(this).attr("method"); //get form GET/POST method
            	var form_data = $(this).serialize(); //Encode form elements for submission
            	
            	$.ajax({
            		url : post_url,
            		type: request_method,
            		data : form_data
            	}).done(function(response){ //
            		toastr.success(response);
            		$('#tc_status'+id).text('Active');
            	});
            });
            
            $(document).on('submit', '#add_facility', function(event){
            	event.preventDefault(); //prevent default action 
            	var post_url = $(this).attr("action"); //get form action url
            	var request_method = $(this).attr("method"); //get form GET/POST method
            	var form_data = $(this).serialize(); //Encode form elements for submission
            	
            	$.ajax({
            		url : post_url,
            		type: request_method,
            		data : form_data
            	}).done(function(result){ //
            		toastr.success('New facility added');
            		$('#facility').append('<option value="'+result.result.id+'" selected="selected">'+result.result.name+'</option>');
            	});
            });
</script>

<script>
$("#addphysicianform").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(result){ //
		toastr.success('New physician has been added.')
		$('#addPatientPhysicianSelect').append('<option value="'+result.result.id+'" selected="selected">'+result.result.first_name+' '+result.result.last_name+'</option>');
	});
});

</script>

<script>
var handleDatepicker = function() {
	$('#datepicker-default').datepicker({
		todayHighlight: true
	});
	
	$('#datepicker-end').datepicker({
		todayHighlight: true
	});
	$('#datepicker-term').datepicker({
		todayHighlight: true
	});
	
	$('#datepicker-effective').datepicker({
		todayHighlight: true
	});
	
};

var handleSelect2 = function() {
	$(".default-procedure").select2();
	$(".default-doctors_cert").select2();
	$(".default-round_trip").select2();
	$(".default-pcs_doc").select2();
	$(".default-facility").select2();
	$(".default-physician").select2();
	
};

var FormPlugins = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDatepicker();
			handleSelect2();
		}
	};
}();

$(document).ready(function() {
	FormPlugins.init();
});
</script>
@endpush
@include('patients.partials.modalAddDoctorsCert')