<link href="/public/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="/public/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="/public/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />

<link href="/public/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />

	

    <h2>Adding new date for {{$trainee->first_name}} {{$trainee->last_name}}</h2>
    
   
   
   <input type="hidden" id="hours" name="eid" class="form-control mb-2"  value="{{ $trainee->user_id }}">
   <input type="hidden" id="hours" name="level" class="form-control mb-2"  value="{{ $trainee->primary_position }}">
   
   <div class="form-group row m-b-15">
       <input type="text" class="form-control mb-2" name="date" id="datepicker-default" placeholder="Select Date"  />
       
   
   <input type="text" id="hours" name="hours" class="form-control mb-2" placeholder="Total Hours Trained">
   
  
			<select class="form-control selectpicker mb-2" name="training_officer" data-size="10" data-live-search="true" data-style="btn-inverse">
				<option value="" selected>Select Training Officer</option>
				@foreach($employees as $emp)
				<option value="{{ $emp->user_id }}"> {{ $emp->first_name }} {{  $emp->last_name }} -- {{ $emp->employeepositions->label or '' }}</option>
				@endforeach
			</select>

			<select class="form-control selectpicker mb-2" name="type" data-size="10" data-live-search="true" data-style="btn-inverse">
				<option value="" selected>Select Training Type</option>
				
				<option value="1"> Field Orienation</option>
				<option value="2"> Drivers Orientation</option>
			
			</select>
	
	
	
			<select class="form-control selectpicker mb-2" name ="complete" data-size="10" data-live-search="true" data-style="btn-inverse">
				<option value="" selected>Select Status</option>
				
				<option value=""> Incomplete </option>
				<option value="1"> Complete </option>
			
			</select>
	
	<button type="submit" class="btn btn-primary">Save changes</button>
    
</div>

<script src="/public/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="/public/assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="/public/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="/public/assets/plugins/gritter/js/jquery.gritter.js"></script>

<script>
    var handleDatepicker = function() {
	$('#datepicker-default').datepicker({
		todayHighlight: true
	});
	
};

var handleSelectpicker = function() {
	$('.selectpicker').selectpicker('render');
};

var FormPlugins = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDatepicker();
			handleSelectpicker();
		}
	};
}();

$(document).ready(function() {
	FormPlugins.init();
});
</script>
<script>
    $( "#ftoForm" ).on( "submit", function( event ) {
  event.preventDefault();
      //Serialize the Form
    var values = {};
    $.each($( this ).serializeArray(), function (i, field) {
        values[field.name] = field.value;
    });
    
    //Value Retrieval Function
    var getValue = function (valueName) {
        return values[valueName];
    };
    
    //Retrieve the Values
    var eid = getValue("eid");
    var href = $(this).attr('action');
  
 
  
  console.log( $( this ).serialize() );
  
  $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
    // AJAX request
   $.ajax({
    url: href,
    type: 'post',
    data: $( this ).serialize(),
    success: function(response){ 
      // Add response in Modal body
      $('#trainingDates' + eid + ' > tbody:last-child').append(response);
      
        
		$.gritter.add({
			title: 'Successfully Added',
			text: 'You have added a new training date to an employee. ',
			sticky: false,
			time: ''
		});
		return false;

      $('#ftoDateModal').modal('toggle');
      
    }
  });
});
</script>

