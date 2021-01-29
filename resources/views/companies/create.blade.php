@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')
@include('partials.toastr')
{!! Form::open(['route' => 'companies.store', 'id' => 'companies-form']) !!}
<section class="form-elegant">

    <!--Form without header-->
    <div class="card">

        <div class="card-body">
            <div class="row">
            <!--Header-->
                <div class="text-center">
                <h3 class="dark-grey-text mb-5"><strong>Create New Company</strong></h3>
                </div>
            </div>
            <!--Body-->
            <div class="row">
                
                <div class="col-md-12">
                    <div class="md-form">
                        <input type="text" id="name" name="name" class="form-control">
                        <label for="name">Company Name</label>
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="md-form">
                            <input type="text" id="autocomplete"  name="autocomplete"  class="form-control">
                            <label for="autocomplete">Search for Address</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="md-form">
                            <input type="text" id="street_number" name="street_number" class="form-control" disabled="true">
                            <label for="street_number">House Number</label>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="md-form">
                            <input type="text" id="route" name="route" class="form-control" disabled="true">
                            <label for="route">Address</label>
                        </div>
                    </div>
                </div>               
            
            <div class="row">
                <div class="col-4">
                    <div class="md-form">
                        <input type="text" id="locality" name="locality" class="form-control" disabled="true">
                        <label for="locality">City</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="md-form">
                        <input type="text" id="administrative_area_level_1" name="administrative_area_level_1" class="form-control" disabled="true">
                        <label for="administrative_area_level_1">State</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="md-form">
                        <input type="text" id="postal_code" name="postal_code" class="form-control" disabled="true">
                        <label for="postal_code">Zip Code</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="md-form">
                        <input type="text" id="email" name="email" class="form-control">
                        <label for="email">Email Address</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="md-form">
                        <input type="text" id="phone" name="phone" class="form-control">
                        <label for="phone">Phone Number</label>
                    </div>
                </div>
            </div>
            
            

            

            <div class="text-center mb-3">
                <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Create New Company</button>
            </div>
             

        </div>



    </div>
    <!--/Form without header-->

</section>
{!! Form::close() !!}
@stop

@section('styles')
 <style type="text/css">
     .form-elegant .font-small {
  font-size: 0.8rem; }

.form-elegant .z-depth-1a {
  -webkit-box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25);
  box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25); }

.form-elegant .z-depth-1-half,
.form-elegant .btn:hover {
  -webkit-box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15);
  box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15); }
 </style>
@stop

@section('scripts')

    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-admin.js') !!}

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
        administrative_area_level_1: 'short_name',
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

     
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1miNu5y61IhwpHaHHtvO_zZYXGg94XLY&libraries=places&callback=initAutocomplete"
        async defer></script>

    
    
@stop