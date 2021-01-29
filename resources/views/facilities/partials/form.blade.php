<!--Panel-->
    <div class="card">
      <h3 class="card-header light-blue lighten-1 white-text text-uppercase font-weight-bold text-center py-5">Add New Facility </h3>
      <div class="card-body">
        @csrf
        
        <div class="row">
            <div class="col-lg-8">
                <div class="md-form">
                    <input type="text" id="name" name="name" class="form-control">
                    <label for="name">Facility Name </label>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="md-form">
                    <input type="text" id="abbreviation" name="abbreviation" class="form-control">
                    <label for="abbreviation">Abbreviation </label>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="md-form">

                                <input type="text" id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()"  class="form-control validate" >
                                
                            </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-2 col-sm-12">
                <div class="md-form">
                    <input type="text" id="street_number" name="house_number" class="form-control">
                    <label for="house_number">House Number </label>
                </div>
            </div>
                
                <div class="col-lg-3 col-sm-12">
                <div class="md-form">
                    <input type="text" id="route" name="street" class="form-control">
                    <label for="street">Street Name </label>
                </div>
                </div>
            
                <div class="col-lg-3 col-sm-12">
                <div class="md-form">
                    <input type="text" id="locality" name="city" class="form-control">
                    <label for="city">City </label>
                </div>
                </div>
            
            <div class="col-lg-2 col-sm-12">
                <div class="md-form">
                    <input type="text" id="administrative_area_level_1" name="state" class="form-control">
                    <label for="state">State </label>
                </div>
            </div>
            
            <div class="col-lg-2 col-sm-12">
                <div class="md-form">
                    <input type="text" id="postal_code" name="zip" class="form-control">
                    <label for="zip">Zip Code </label>
                </div>
            </div>
        
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                <!-- Material unchecked -->
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="check1" name="contracted" value="1">
                    <label class="form-check-label" for="check1">Contracted Facility</label>
                </div>
        
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="check2" name="contracted" value="0">
                    <label class="form-check-label" for="check2">Not Contracted</label>
                </div>

            </div>
            </div>
        
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-primary btn-block my-4" type="submit">Add New Facility</button>
            </div>
            
        </div>
      </div>
    </div>
    <!--/.Panel-->

        