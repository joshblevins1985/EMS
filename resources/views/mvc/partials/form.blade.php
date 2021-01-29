<div class="row">
    <h1>PEASI Crash Report</h1>
    <div class="col-lg-2 col-md-12">
        <div class="md-form">
            <input placeholder="Selected date" type="text" id="date" name="date" class="form-control datepicker">
            <label for="date">Date of Crash</label>
        </div>
    </div>

    <div class="col-lg-2 col-md-12">
        <div class="md-form">
            <input placeholder="Crash Time" type="text" id="time" name="time" class="form-control timepicker">
            <label for="time">Time of Crash</label>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12">
        <select class="mdb-select md-form" name="driver">
            <option value="" disabled selected>Choose driver of the unit</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
        </select>
    </div>
    
    <div class="col-lg-4 col-md-12">
        <select class="mdb-select md-form" name="unit">
            <option value="" disabled selected>Choose unit number</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
        </select>
    </div>
    
    <div class="col-lg-6 col-md-6">
        <select class="mdb-select md-form" name="direction_of_travel">
            <option value="" disabled selected>Choose your direction of travel</option>
            <option value="1">North</option>
            <option value="3">North-East</option>
            <option value="3">North-West</option>
            <option value="2">South</option>
            <option value="3">South-East</option>
            <option value="3">South-West</option>
            <option value="3">East</option>
            <option value="3">West</option>
            <option value="3"></option>
        </select>
    </div>
    
    <div class="col-lg-6 col-md-12">
            <!-- Material input -->
        <div class="md-form">
          <input type="text" id="roadway" name="roadway" class="form-control">
          <label for="roadway">Road / Street you were traveling on</label>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12">
        <select class="mdb-select md-form" name="lane">
            <option value="" disabled selected>Choose your lane of travel.</option>
            <option value="1">Lane 1</option>
            <option value="2">Lane 2</option>
            <option value="3">Lane 3</option>
            <option value="3">Lane 4</option>
        </select>
    </div>
    
    <div class="col-lg-2 col-md-12">
        <div class="md-form">
            <input  type="text" id="speed" name="speed" class="form-control timepicker">
            <label for="time">Your Speed</label>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-12">
        <div class="md-form">
            <input placeholder="City" type="text" id="city" name="city" class="form-control timepicker">
            <label for="time">City Where accident occurred.</label>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-12">
        <div class="md-form">
            <input placeholder="County" type="text" id="county" name="county" class="form-control timepicker">
            <label for="time">County where accident occurred.</label>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
            <!-- Material input -->
        <div class="md-form">
          <input type="text" id="approach" name="approach" class="form-control">
          <label for="roadway">Road / Street or area you were approaching.</label>
        </div>
    </div>
    
    <div class="col-lg-6 col-md-12">
            <!-- Material input -->
        <div class="md-form">
          <input type="text" id="other_vehicle" name="other_vehicle" class="form-control">
          <label for="roadway">Color / Make / Model / Year of other vehicle</label>
        </div>
    </div>
    
    <div class="col-lg-12 col-md-12">
            <!-- Material input -->
        <div class="md-form">
          <input type="text" id="other_vehicle" name="other_vehicle" class="form-control">
          <label for="roadway">Describe what the other vehicle did / was doing.</label>
        </div>
    </div>
    
    <div class="col-lg-6 col-md-12">
            <!-- Material input -->
        <div class="md-form">
          <input type="text" id="striking" name="striking" class="form-control">
          <label for="roadway">Area of PEASI vehicle that was hit.</label>
        </div>
    </div>
    
    <div class="col-lg-6 col-md-12">
            <!-- Material input -->
        <div class="md-form">
          <input type="text" id="striking" name="striking" class="form-control">
          <label for="roadway">Area of other vehicle that was hit.</label>
        </div>
    </div>
    
    <div class="col-lg-6 col-md-12">
        <select class="mdb-select md-form" name="vehicle_damage">
            <option value="" disabled selected>Rate Damage to PEASI Vehicle</option>
            <option value="1">Minor</option>
            <option value="2">Modorate</option>
            <option value="3">Major</option>
        </select>
    </div>
    
    <div class="col-lg-6 col-md-12">
        <select class="mdb-select md-form" name="drivable">
            <option value="" disabled selected>Select Drivability</option>
            <option value="1">Drove away from the scene.</option>
            <option value="2">Vehicle had to be towed.</option>
        </select>
    </div>
    
    <div class="col-lg-6 col-md-12">
        <select class="mdb-select md-form" name="other_vehicle_damage">
            <option value="" disabled selected>Rate Damage to PEASI Vehicle</option>
            <option value="1">Minor</option>
            <option value="2">Modorate</option>
            <option value="3">Major</option>
        </select>
    </div>
    
    <div class="col-lg-6 col-md-12">
        <select class="mdb-select md-form" name="other_drivable">
            <option value="" disabled selected>Select Drivability</option>
            <option value="1">Drove away from the scene.</option>
            <option value="2">Vehicle had to be towed.</option>
        </select>
    </div>

    <div class="col-lg-2 col-md-12">
        <div class="col-lg-12">
            Police Contacted?
        </div>

        <div class="col-lg-4 col-md-12">
            <!-- Material inline 1 -->
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="police1" name="police" value="1">
                <label class="form-check-label" for="police1">Yes</label>
            </div>

            <!-- Material inline 2 -->
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="police2" name="police" value="2">
                <label class="form-check-label" for="police2">No</label>
            </div>

        </div>

    </div>

    <div class="col-lg-8 col-md-12">
            <!-- Material input -->
        <div class="md-form">
          <input type="text" id="pd_name" name="pd_name" class="form-control">
          <label for="pd_name">Police Department Name</label>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
             <!-- Material input -->
        <div class="md-form">
          <input type="text" id="officer" name="officer" class="form-control">
          <label for="officer">Officer's Name</label>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
             <!-- Material input -->
        <div class="md-form">
          <input type="text" id="badge_number" name="badge_number" class="form-control">
          <label for="badge_number">Badge Number</label>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
             <!-- Material input -->
        <div class="md-form">
          <input type="text" id="report_number" name="report_number" class="form-control">
          <label for="report_number">Report Number</label>
        </div>
    </div>

</div>


