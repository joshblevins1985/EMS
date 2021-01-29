@extends('layouts.sidebar-fixed')

@section('title', 'Administration Dashboard')

@push('css')
    <style>
        .pac-container {

            position: relative;
            z-index: 9999999
        }

        .toggle.ios, .toggle-on.ios, .toggle-off.ios {
            border-radius: 20px;
            background-color: black;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
            background-color: black;
        }
    </style>
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dispatch Alerts Search</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Search for Address Alerts</h1>

    <div class="row">
        <div class="col-xl-12">
            <div class="row mb-2">
                <div class="col-lg-12">

                    <!-- Material input -->

                    <input type="text" id="autocomplete" placeholder="Enter your address"
                           onFocus="geolocate()" class="form-control validate">


                </div>
            </div>

            <div class="row mb-2">

                <div class="col-lg-2">
                    <!-- Material input -->

                    <input type="text" id="street_number" name="house_number" class="form-control" disabled>
                    <label for="house_number"><span class="text-danger">House Number</span></label>

                </div>
                <div class="col-lg-4">
                    <!-- Material input -->

                    <input type="text" id="route" name="incident_address" class="form-control" disabled>
                    <label for="address"><span class="text-danger">Street Name</span></label>

                </div>
                <div class="col-lg-6">
                    <!-- Material input -->

                    <input type="text" id="address_2" name="address_2" class="form-control">
                    <label for="address_2"><span
                                class="text-warning">If no valid address type address here.</span></label>

                </div>

            </div>

            <div class="row mb-2">

                <div class="col-lg-3">
                    <!-- Material input -->

                    <input type="text" id="locality" name="incident_city" class="form-control">
                    <label for="city"><span class="text-danger">City</span></label>

                </div>
                <div class="col-lg-3">
                    <!-- Material input -->

                    <input type="text" id="administrative_area_level_1" name="incident_state" class="form-control">
                    <label for="state"><span class="text-danger">State</span></label>

                </div>
                <div class="col-lg-2">
                    <!-- Material input -->

                    <input type="text" id="postal_code" name="incident_zip" class="form-control">
                    <label for="zip"><span class="text-danger">Zip</span></label>

                </div>
                <div class="col-lg-4">
                    <!-- Material input -->

                    <input type="text" id="phone" name="incident_phone" class="form-control" value="">
                    <label for="phone">Phone</label>

                </div>


            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12" id="alerts">

        </div>

    </div>



@endsection



@push('scripts')
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
                    //fixFieldState($("#"+addressType));
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
        var Timer;

        function Start() {
            $("#autocomplete").change(function () {
                clearTimeout(Timer);
                Timer = setTimeout(SendRequest, 800);
            });
        }

        function SendRequest() {
            var house_number = $('#street_number').val();
            var street_name = $('#route').val();
            var city = $('#locality').val();
            var state = $('#administrative_area_level_1').val();
            var address = $('#address_2').val();
            console.log(street_name);
            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: '/dispatch/alert',
                data: {house: house_number, street: street_name, city: city, state: state, address: address},
                success: function (data) {
                    $('#alerts').html(data);
                },
                error: function () {
                    console.log(data);
                }
            });

        }

        $(Start);
    </script>

@endpush
