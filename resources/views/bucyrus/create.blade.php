@extends('layouts.default')

@section('title', 'Bucyrus Run Log')

@push('css')
<link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />

<style>
    .pac-container {

    position: relative;
    z-index: 9999999
}
.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; background-color: black; }
.toggle.ios .toggle-handle {  border-radius: 20px; background-color: black; }
</style>
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="/dashboard">home</a></li>
    <li class="breadcrumb-item"><a href="/bucyrus">Bucyrus</a></li>
    <li class="breadcrumb-item"><a href="/bucyrus/create">Add New Incident</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">Add New Incident</h1>
<!-- end page-header -->



	<!-- begin wizard-form -->
	<form action="/bucyrus" method="POST" name="form-wizard" class="form-control-with-bg">
	    @csrf
		<!-- begin wizard -->
		<div id="wizard">
			<!-- begin wizard-step -->
			<ul>
				<li>
					<a href="#step-1">
						<span class="number">1</span>
						<span class="info">
							Crew Information

						</span>
					</a>
				</li>
				<li>
					<a href="#step-2">
						<span class="number">2</span>
						<span class="info">
							Dispatch Information

						</span>
					</a>
				</li>
				<li>
					<a href="#step-3">
						<span class="number">3</span>
						<span class="info">
							Incident Times

						</span>
					</a>
				</li>
				<li>
					<a href="#step-4">
						<span class="number">4</span>
						<span class="info">
							Transport Information

						</span>
					</a>
				</li>
				<li>
					<a href="#step-5">
						<span class="number">5</span>
						<span class="info">
							Disposition

						</span>
					</a>
				</li>
				<li id="step-6" style="display:none;">
					<a href="#step-6">
						<span class="number">6</span>
						<span class="info">
							Equipment Used

						</span>
					</a>
				</li>
				<li id="variance">
					<a href="#step-7">
						<span class="number">7</span>
						<span class="info">
							Variance Information

						</span>
					</a>
				</li>
			</ul>
			<!-- end wizard-step -->
			<!-- begin wizard-content -->
			<div>
				<!-- begin step-1 -->
				<div id="step-1">
					@include('bucyrus.partials.form_step1')
				</div>
				<!-- end step-1 -->
				<!-- begin step-2 -->
				<div id="step-2">
					@include('bucyrus.partials.form_step2')
				</div>
				<!-- end step-2 -->
				<!-- begin step-3 -->
				<div id="step-3">
					@include('bucyrus.partials.form_step3')
				</div>
				<!-- end step-3 -->
				<!-- begin step-4 -->
				<div id="step-4">
					@include('bucyrus.partials.form_step4')
				</div>
				<!-- end step-4 -->
				<!-- begin step-5 -->
				<div id="step-5">
					@include('bucyrus.partials.form_step5')

					<div class="row mt=5" id="submitDisposition"> <button type="submit" class="btn btn-primary btn-lg btn-block">Submit Incident Data</button> </div>
				</div>
				<!-- end step-5 -->
				<!-- begin step-6 -->
				<div id="step-6" style="display:none;">
					@include('bucyrus.partials.form_step6')
				</div>
				<!-- end step-4 -->
				<!-- begin step-6 -->
				<div id="step-7" >
					@include('bucyrus.partials.form_step7')

					<div class="row mt=5" style="display:none;" id="varianceSubmit"> <button type="submit" class="btn btn-primary btn-lg btn-block">Submit Incident Data</button> </div>
				</div>
				<!-- end step-4 -->
			</div>
			<!-- end wizard-content -->
		</div>
		<!-- end wizard -->
	</form>
	<!-- end wizard-form -->

@endsection







@push('scripts')

<script src="/assets/plugins/moment/moment.js"></script>
<script src="/assets/plugins/parsleyjs/dist/parsley.js"></script>
<script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
<script src="/assets/js/demo/form-wizards-validation.demo.js"></script>
<script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script>$.fn.selectpicker.Constructor.BootstrapVersion = '4';</script>

<script src="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>



	<script>

    $(document).ready(function() {
        var counter = 0;

        $("#addrow").on("click", function() {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select name="crew[user_id][]" id="crew'+ counter +'" class="selectpicker" data-width="fit" data-style="btn-dark" data-parsley-group="step-1" data-parsley-required="true" title="Choose Employee">@foreach($employees as $row)<option value="{{$row->user_id}}">{{$row->last_name}}, {{$row->first_name}}</option>@endforeach</select></td>';
            cols += '<td><select name="crew[assignment][]" id="assignment'+ counter +'" class="selectpicker" data-width="fit" data-style="btn-dark" data-parsley-group="step-1" data-parsley-required="true" title="Choose Employee"><option value="1">Driver</option><option value="2">Attendant</option><option value="3">Assistant</option><option value="4">Student</option></select></td>';
            cols += '<td><select name="crew[level][]" id="level'+ counter +'" class="selectpicker" data-width="fit" data-style="btn-dark" data-parsley-group="step-1" data-parsley-required="true" title="Choose Employee"><option value="1">EMT</option><option value="2">AEMT</option><option value="3">MEDIC</option></select></td>';
            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
            newRow.append(cols);
            $("#crew_table").append(newRow);
            $('#crew'+counter).selectpicker();
            $('#assignment'+counter).selectpicker();
            $('#level'+counter).selectpicker();
            counter++;
        });



        $("#crew_table").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            counter -= 1
        });


    });
</script>



<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY7nRvFyz8x5OXhkagsIj5MW9g9vsNhlc&libraries=places&callback=initAutocomplete"
        async defer></script>

<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;

          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>

<script>
    var handleDateTimePicker = function() {
	$('#datetimepicker1').datetimepicker({
	    format: 'YYYY-MM-DD HH:mm'
	});
	$('#datetimepicker2').datetimepicker({
	    format: 'YYYY-MM-DD HH:mm'
	});
	$('#datetimepicker3').datetimepicker({
	    format: 'YYYY-MM-DD HH:mm'
	});
	$('#datetimepicker4').datetimepicker({
	    format: 'YYYY-MM-DD HH:mm'
	});

	$('#datetimepicker5').datetimepicker({
	    format: 'YYYY-MM-DD HH:mm'
	});
	$('#datetimepicker6').datetimepicker({
	    format: 'YYYY-MM-DD HH:mm'
	});
	$('#datetimepicker7').datetimepicker({
	    format: 'YYYY-MM-DD HH:mm'
	});
	$('#datetimepicker8').datetimepicker({
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

$(document).ready(function() {
	FormPlugins.init();
});
</script>

<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {

   $('#datetimepicker4').on('dp.change', function() {
       var startTime = $('#dispatchTime').val();
       var endTime = $('#onsceneTime').val();
       var varianceToggle = $('#variance_toggle');

       var startTime = moment(startTime);
       var endTime = moment(endTime);

       var responseTime = moment.duration(endTime.diff(startTime, 'minutes'));
       var township = $('#township').val();

       $( "div.responseTime" ).text(responseTime +' min');

       $.ajax({
           type: "GET",
           url: "/buc/get_twp/"+township,
           dataType: "json",
           success: function(townships){
               const requiredResponseTime = townships.response_time;

               if(responseTime > requiredResponseTime){
           varianceToggle.attr('checked', true);
           varianceToggle.closest('.toggle').addClass(' btn-danger').removeClass('btn-success off');
           $('#submitDisposition').hide();
                   $('#varianceSubmit').show();


           console.log(responseTime);
       }
           }
       });

  });

  $('#datetimepicker3').on('dp.change', function() {
       var startTime = $('#callTime').val();
       var endTime = $('#enrouteTime').val();

       var startTime = moment(startTime);
       var endTime = moment(endTime);

       var chuteTime = moment.duration(endTime.diff(startTime, 'minutes'));

       $( "div.chuteTime" ).text(chuteTime +' min');

  });

  $('#datetimepicker8').on('dp.change', function() {
       var startTime = $('#callTime').val();
       var endTime = $('#inserviceTime').val();

       var startTime = moment(startTime);
       var endTime = moment(endTime);

       var totalTime = moment.duration(endTime.diff(startTime, 'minutes'));

       $( "div.totalTime" ).text(totalTime +' min');

  });
    });
</script>

@endpush
