<form  action="/unit/create"  method="post">
    
    @csrf
    
    <div class="form-group">
        <label for="asset_tag">Unit Id</label>
        <input type="text" id="asset_tag" name="unit_id" class="form-control"  placeholder="Unit Id">
    </div>
    
    <div class="form-group">
        <label for="type">Station</label>
        <select class="default-select1 form-control" name="type">
            @foreach($stations as $station)
			<option value="{{$station->id}}" >{{ $station->station}}</option>
			@endforeach
		</select>
    </div>
    <div class="form-group">
        <label for="type">Station</label>
        <select class="default-select1 form-control" name="type">
			<option value="0" >Out of Service</option>
			<option value="1" >In-Service</option>
			<option value="90" >Parted Out</option>
			<option value="91" >Sold</option>
		</select>
    </div>
    
    <div class="form-group">
        <label for="vin">Unit Id</label>
        <input type="text" id="vin" name="vin" class="form-control"  placeholder="Vehicle VIN Number">
    </div>
    
    <div class="form-group">
        <label for="make">Make</label>
        <input type="text" id="make" name="make" class="form-control"  placeholder="Vehicle Make">
    </div>
    
    <div class="form-group">
        <label for="model">Model</label>
        <input type="text" id="model" name="model" class="form-control"  placeholder="Vehicle Model">
    </div>
    
    <div class="form-group">
        <label for="manufacturer">Manufacturer</label>
        <input type="text" id="manufacturer" name="manufacturer" class="form-control"  placeholder="Vehicle Manufacturer">
    </div>
    
    <div class="form-group">
        <label for="year">Year</label>
        <input type="text" id="year" name="year" class="form-control"  placeholder="Year">
    </div>
    
    <div class="form-group">
        <label for="license_plate">License Plate</label>
        <input type="text" id="license_plate" name="license_plate" class="form-control"  placeholder="Vehicle License Plate">
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit Unit</button>
    </div>
    
    <div class="form-group">
        <label for="type">Vehicle Type</label>
        <select class="default-select1 form-control" name="type">
			<option value="1" >Ambulance Type 1</option>
			<option value="2" >Ambulance Type 2</option>
			<option value="3" >Ambulance Type 3</option>
			<option value="4" >Amublance Type 4</option>
			<option value="5" >Ambulette</option>
		</select>
    </div>
    <div class="form-group">
        <label for="company">Company</label>
        <select class="default-select1 form-control" name="company">
            @foreach($companies as $company)
			<option value="{{$company->id}}" >{{ $company->name}}</option>
			@endforeach
		</select>
    </div>
    
    <div class="form-group">
        <label for="odps_number">ODPS Number</label>
        <input type="text" id="odps_number" name="odps_number" class="form-control"  placeholder="ODPS Number">
    </div>
    
    <div class="form-group">
        <label for="ky_number">KY Number</label>
        <input type="text" id="ky_number" name="ky_number" class="form-control"  placeholder="KY Number">
    </div>
    
    <div class="form-group">
        <label for="wv_number">WV Number</label>
        <input type="text" id="wv_number" name="wv_number" class="form-control"  placeholder="WV Number">
    </div>
    
    
</form>