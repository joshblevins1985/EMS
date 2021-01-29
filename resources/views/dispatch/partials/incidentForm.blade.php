<script>
    $("#call_back").keyup(function () {
        update();
    });

    function update() {
        $("#phone").val($('#call_back').val());
    }
</script>
<div class="row">
    <div class="col-lg-6">
        <!-- Material input -->

        <input type="text" id="call_back" name="call_back" class="form-control" value="" required>
        <label for="call_back"><span class="text-danger">Callers Phone Number</span></label>
    </div>
    <div class="col-lg-6">
        <!-- Material input -->

        <input type="text" id="caller_name" name="caller_name" class="form-control is-invalid">
        <label for="caller_name"><span class="text-danger">Callers Name</span></label>

    </div>
</div>

<div class="row mb-2">
    <div class="col-lg-12">

        <select class="default-select2 form-control" name="facility" style="width: 100%">
            <option value="" disabled selected>Select Facility</option>
            @foreach($facility as $row)
                <option value="{{$row->id}}">{{$row->abbreviation}} - {{$row->name}}</option>
            @endforeach
        </select>

    </div>
</div>

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
        <label for="address_2"><span class="text-warning">If no valid address type address here.</span></label>

    </div>

</div>

<div class="row mb-2">

    <div class="col-lg-3">
        <!-- Material input -->
        <input type="text" id="locality" name="incident_city" class="form-control p-input">
        <label for="city"><span class="text-danger">City</span></label>

    </div>
    <div class="col-lg-3">
        <!-- Material input -->
        <input type="text" id="administrative_area_level_1" name="incident_state" class="form-control p-input">
        <label for="state"><span class="text-danger">State</span></label>

    </div>
    <div class="col-lg-2">
        <!-- Material input -->
        <input type="text" id="postal_code" name="incident_zip" class="form-control p-input">
        <label for="zip"><span class="text-danger">Zip</span></label>

    </div>
    <div class="col-lg-4">
        <!-- Material input -->
        <input type="text" id="phone" name="incident_phone" class="form-control p-input" value="">
        <label for="phone">Phone</label>

    </div>


</div>

<div class="row mb-2">
    <div class="col-lg-12">
        <label for="phone"><span class="text-danger">Primary Station</span></label>
        <select class="default-select2 form-control is-invalid" id="station_id" name="station_id" searchable style="width: 100%;">
            <option value="" disabled selected><span class="text-danger">Choose Primary Station</span></option>
            @foreach($stations as $row)
                <option value="{{$row->id}}">{{$row->station}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-xl-12" id="alerts">

    </div>

</div>
<div class="row mb-2">
    <div class="col-lg-12">
        <label for="patient_id"><span class="">Patient Name</span></label>
        <select class="default-select2 typehead form-control" id="patient_id" name="patient_id" style="width: 100%;"
                searchable="Search Patients">
            <option value="" disabled selected>Choose Patient</option>
            @foreach($patients as $row)
                <option value="{{$row->id}}">{{decrypt($row->last_name)}} {{decrypt($row->first_name)}}
                    -- {{ Carbon\Carbon::parse($row->dob)->format('m-d-Y') }}</option>
            @endforeach
        </select>

    </div>
</div>
<div class="row mb-2">

    <div class="col-lg-6">
        <label for="incident_type"><span class="text-danger">Incident Type</span></label>
        <select class="default-select2 form-control-lg has-error" id="incident_type" name="incident_type" searchable="Search here.." style="width: 100%;">
            <option value="" disabled selected><span class="text-danger">Choose Incident Type</span></option>
            @foreach($incident_types as $row)
                <option value="{{$row->id}}">{{$row->description}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="priority"><span class="text-danger">Incident Priority</span></label>
        <select class="default-select2 form-control-lg has-error" id="priority" name="priority" style="width: 100%;">
            <option value="" disabled selected><span class="text-danger">Choose Incident Priority</span></option>
            <option value="1">Immediate</option>
            <option value="2">High</option>
            <option value="3">Medium</option>
            <option value="3">Low</option>
        </select>
    </div>

</div>


<div class="row">
    <div class="col-lg-3">
        <!-- Material input -->

        <input type="text" id="expected_complete" name="expected_complete" class="form-control">
        <label for="expected_complete"><span class="text-danger">ETA Given</span></label>

    </div>
    <div class="col-lg-3">
        <!-- Material input -->

        <input type="datetime-local" id="pu_time" name="pick_up" class="form-control">
        <label for="pu_time"><span class="text-danger">P/U Time</span></label>

    </div>
    <div class="col-lg-3">
        <!-- Material input -->

        <input type="datetime-local" id="apt_time" name="apt_time" class="form-control">
        <label for="apt_time"><span class="text-danger">APT Time</span></label>

    </div>
    <div class="col-lg-3">
        <!-- Material input -->

        <input type="datetime-local" id="expected_complete" name="expected_complete" class="form-control">
        <label for="expected_complete"><span class="text-danger">Expected Complete</span></label>

    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        Additional notes
    </div>
    <div class="col-lg-12">
        <!--Textarea with icon prefix-->

        <i class="fas fa-pencil-alt prefix"></i>
        <textarea id="notes" class="md-textarea form-control" rows="4"></textarea>

    </div>
</div>

<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY7nRvFyz8x5OXhkagsIj5MW9g9vsNhlc&libraries=places&callback=initAutocomplete"
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
                fixFieldState($("#" + addressType));
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
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
