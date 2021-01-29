@csrf
        
        <div class="row">
            <div class="col-lg-8">
                
                    <input type="text" id="name" name="name" class="form-control">
                    <label for="name">Facility Name </label>
               
            </div>
            <div class="col-lg-4">
                
                    <input type="text" id="abbreviation" name="abbreviation" class="form-control">
                    <label for="abbreviation">Abbreviation </label>
               
            </div>
        </div>
        
        <div class="row mb-2">
            <div class="col-lg-12">
                <input type="text" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()"  class="form-control validate" >

            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-2 col-sm-12">
                
                    <input type="text" id="street_number" name="house_number" class="form-control">
                    <label for="house_number">House Number </label>
                
            </div>
                
                <div class="col-lg-3 col-sm-12">
                
                    <input type="text" id="route" name="street" class="form-control">
                    <label for="street">Street Name </label>
                
                </div>
            
                <div class="col-lg-3 col-sm-12">
                
                    <input type="text" id="locality" name="city" class="form-control">
                    <label for="city">City </label>
               
                </div>
            
            <div class="col-lg-2 col-sm-12">
                
                    <input type="text" id="administrative_area_level_1" name="state" class="form-control">
                    <label for="state">State </label>
                
            </div>
            
            <div class="col-lg-2 col-sm-12">
                
                    <input type="text" id="postal_code" name="zip" class="form-control">
                    <label for="zip">Zip Code </label>
                
            </div>
        
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                <!-- Material unchecked -->
                
                    <input type="radio" class="form-check-input" id="check1" name="contracted" value="1">
                    <label class="form-check-label" for="check1">Contracted Facility</label>
                
                </div>
                <div class="col-lg-6 col-sm-12">
                
                    <input type="radio" class="form-check-input" id="check2" name="contracted" value="0">
                    <label class="form-check-label" for="check2">Not Contracted</label>
                

            </div>
            </div>
        
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-primary btn-block my-4" type="submit">Add New Facility</button>
            </div>
            
            </div>
            
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
            
            
            
            
            