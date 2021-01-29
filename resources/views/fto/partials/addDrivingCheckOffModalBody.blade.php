<link href="/public/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="/public/assets/plugins/select2/dist/js/select2.min.js"></script>
<form action="/fto/addDriverCheck" method="post">
                    @csrf
                    
                    <input type="hidden" id="user_id" name="employee_id" value ="{{ $trainee->user_id }}" />
                    
                    <div class="form-group row">
							<label class="col-lg-4 col-form-label">Select Evoc Instructor</label>
							<div class="col-lg-8">
								<select class="default-select1 form-control" name="trainingOfficer">
								    @foreach($employees as $row)
									<option value="{{ $row->user_id }}" @if($row->user_id == auth()->user()->id) selected @endif>{{ $row->last_name }}, {{ $row->first_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-lg-4 col-form-label">Select Training Date</label>
							<div class="col-lg-8">
								<select class="default-select2 form-control" name="training_date">
								    @foreach($trainee->fieldtraining->where('type', 2) as $row)
									<option value="{{$row->id}}" > {{ Carbon\Carbon::parse($row->date)->format('m-d-Y') }}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-lg-4 col-form-label">Select Driving Check Off Type</label>
							<div class="col-lg-8">
								<select class="default-select3 form-control" name="type">
								   
									<option value="1" >Non-Emergency Driving Daily</option>
									<option value="2" >Emergency Driving</option>
							
								</select>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-lg-4 col-form-label">Reason for Training</label>
							<div class="col-lg-8">
								<select class="default-select4 form-control" name="reason">
								    
									<option value="1" >New Employee</option>
									<option value="2" >New Driver</option>
									<option value="2" >Back to Driving</option>
								
								</select>
							</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Submit Update</button>
                </form>
                
                
                    <script>
        var handleSelect1 = function() {
        	$(".default-select1").select2();
        	$(".default-select2").select2();
        	$(".default-select3").select2();
        	$(".default-select4").select2();
        
        };
   
        
        var FormPlugins = function () {
	"use strict";
	return {
		//main function
		init: function () {
  
    			handleSelect1();
    			
    
    		}
    	};
    }();
    
    $(document).ready(function() {
    	FormPlugins.init();
    });
    </script>