@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Create Employee')
    </li>
@stop

@section('content')

    @include('partials.toastr')


    <form action="{{ route('patients.store') }}" method="post" enctype="multipart/form-data">

        <div class=row >
            <div class="col-6 ">

                <div class=row>
                    <div class="col-3">
                        <p class="font-weight-bold">Full Name</p>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col">
                                <div class="md-form">
                                    <i class="fa fa-user prefix"></i>
                                    <input type="text" id="first_name" name="first_name" class="form-control validate" placeholder="First Name" required>

                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form">

                                    <input type="text" id="middle_name" name="middle_name" class="form-control validate" placeholder="Middle Name" >

                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form">

                                    <input type="text" id="last_name" name="last_name" class="form-control validate" placeholder="Last Name" required>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                </div>
                <div class=row>
                    <div class="col-3">
                        <p class="font-weight-bold">Preferred Name</p>
                    </div>
                    <div class="col-9">

                        <div class="md-form">

                            <input type="text" id="prefered_name" name="prefered_name" class="form-control validate" placeholder="Preferred Name" >

                        </div>

                    </div>
                    <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                </div>
                <div class=row>
                    <div class="col-3">
                        <p class="font-weight-bold">Date of Birth</p>
                    </div>
                    <div class="col-9">
                        <div class="md-form">
                            <input placeholder="Date of Birth" type="text" name="dob" id="dob" class="form-control datepicker">

                        </div>
                    </div>
                    <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                </div>
                <div class=row>
                    <div class="col-3">
                        <p class="font-weight-bold">Social Security Number</p>
                    </div>
                    <div class="col-9">
                        <div class="md-form">

                            <input type="tel" id="ssn" name="ssn" class="form-control validate" placeholder="Social Security Number" >

                        </div>
                    </div>
                    <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                </div>
                <div class=row>
                    <div class="col-3">
                        <p class="font-weight-bold">Ethnicity</p>
                    </div>
                    <div class="col-9">
                        <select class="mdb-select" id="ethnicity" name="ethnicity">
                            <option value="" disabled selected>Choose Employees Ethnicity</option>
                            <option value="1">Caucasion</option>
                            <option value="2">African American</option>
                            <option value="3">Native American</option>
                            <option value="4">Hispanic</option>
                            <option value="5">Other</option>
                        </select>
                    </div>
                    <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                </div>
                <div class=row>
                    <div class="col-3">
                        <p class="font-weight-bold">Personal Email Address</p>
                    </div>
                    <div class="col-9">
                        <div class="md-form">
                            <i class="fa fa-envelope prefix"></i>
                            <input type="email" id="personal_email" name="email" class="form-control validate" placeholder="Personal Email" >

                        </div>
                    </div>
                    <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                </div>

            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <div class=row>
                        <div class="col-3">
                            <p class="font-weight-bold">Phone Number</p>
                        </div>
                        <div class="col-9">
                            <div class="md-form">
                                <i class="fa fa-phone prefix"></i>
                                <input type="tel" id="phone" name="phone" class="form-control validate" placeholder="Phone Number" >

                            </div>
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col-3">
                            <p class="font-weight-bold">Mobile Number</p>
                        </div>
                        <div class="col-9">
                            <div class="md-form">
                                <i class="fa fa-mobile prefix"></i>
                                <input type="tel" id="phone_mobile" name="phone_mobile" class="form-control validate" placeholder="Mobile Phone" >

                            </div>
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>
                    <div class=row>
                        <div class="col-3">
                            <p class="font-weight-bold">Mobile Carrier</p>
                        </div>
                        <div class="col-9">

                            <select class="mdb-select" id="phone_carrier" name="phone_carrier">
                                <option value="" disabled selected>Choose Employees Mobile Carrier</option>

                                @foreach($mobilecarriers as $id => $mcarrier)
                                    <option value="{{ $id}}">{{ $mcarrier }}</option>
                                @endforeach

                            </select>

                        </div>


                    </div>
                    <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
                </div>

                <div class="d-flex flex-column">
                    <div class=row>
                        <div class="col-3">
                            <p class="font-weight-bold">Address</p>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-9">
                                    <div class="md-form">

                                        <input type="text" id="autocomplete" placeholder="Enter your address"
                                               onFocus="geolocate()"  class="form-control validate" >

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="md-form">
                                        <i class="fa fa-home prefix"></i>
                                        <input type="tel" id="street_number" name="street_number" class="form-control validate" placeholder="House #" disabled="true">

                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="md-form">
                                        <i class="fa fa-road prefix"></i>
                                        <input type="text" id="route" name="route" class="form-control validate" placeholder="Street Name" disabled="true">

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12">
                                    <div class="md-form">
                                        <i class="fa fa-road prefix"></i>
                                        <input type="text" id="address_2" name="address_2" class="form-control validate" placeholder="Address P.O Box or add Info">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class=row>
                        <div class="col-3">
                            <p class="font-weight-bold">City / State / Zip Code</p>
                        </div>
                        <div class="col-9">


                            <div class="row">
                                <div class="col-4">
                                    <div class="md-form">

                                        <input type="tel" id="locality" name="locality" class="form-control validate" placeholder="City" disabled="true">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="md-form">

                                        <input type="text" id="administrative_area_level_1" name="state" class="form-control validate" placeholder="State" disabled="true">

                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="md-form">

                                        <input type="text" id="postal_code" name="postal_code" class="form-control validate" placeholder="Zip Code" disabled="true">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <hr style="width: 100%; color: black; height: 1px; background-color: black;" />
                </div>

                <div class="d-flex flex-column">
                    <div class=row>
                        <div class="col-3">
                            <p class="font-weight-bold">Primary Station</p>
                        </div>
                        <div class="col-9">
                            <select class="mdb-select colorful-select dropdown-primary" id="primary_station" name="primary_station" >
                                <option value="" disabled selected>Primary Station</option>
                                @foreach($station as $id => $station)
                                    <option value="{{$id}}" >{{$station}}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class=row>
                        <div class="col-3">
                            <p class="font-weight-bold">Transport Mode</p>
                        </div>
                        <div class="col-9">
                            <select class="mdb-select" id="transport_mode" name="transport_mode">
                                <option value="" disabled selected>Choose Patient Primary Transport Mode</option>
                                <option value="1">Car Service</option>
                                <option value="2">Wheel Chair</option>
                                <option value="3">Stretcher</option>
                            </select>
                        </div>
                        <hr style="width: 100%; color: #A9A9A9; height: 1px; background-color: #A9A9A9;" />
                    </div>

                </div>


                <div class="d-flex flex-column">
                    <div class=row>
                        <div class="col-3">
                            <p class="font-weight-bold">Employee Status</p>
                        </div>
                        <div class="col-9">

                            <!-- Default inline 1-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="d1" name="status" value="1" checked>
                                <label class="custom-control-label" for="d1">Acitve</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="d2" name="status" value="2" >
                                <label class="custom-control-label" for="d2">Deactive</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="d3" name="status" value="3" >
                                <label class="custom-control-label" for="d3">Deceased</label>
                            </div>

                    </div>

                    <div class="row">
                        <div class="md-form">
                            <input type="file" class="form-control" name="photo[]" multiple />
                        </div>
                    </div>


                    <hr style="width: 100%; color: black; height: 1px; background-color: black;" />

                    <div class="text-center mb-3">
                        <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Create New Patient</button>
                    </div>
                </div>

            </div>

        </div>
        {{ csrf_field() }}
        {!! Form::close() !!}

        @stop

        @section('styles')

        @stop

        @section('scripts')
            <script>
                // Data Picker Initialization
                $('.datepicker').pickadate(
                    {
                        format: 'mmmm d, yyyy'

                    });
            </script>
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

            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY7nRvFyz8x5OXhkagsIj5MW9g9vsNhlc&libraries=places&callback=initAutocomplete"
                    async defer"></script>
@stop