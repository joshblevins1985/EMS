<form @if($edit) action="/assetEdit/{{ $asset->id }}" @else action="/assetNew" @endif method="post">
    
    @csrf
    @if($edit) <input type="hidden" name="id" value="{{ $asset->id }}" /> @endif
    <div class="form-group">
        <label for="asset_tag">Service Tag Number</label>
        <input type="text" id="asset_tag" name="asset_tag" class="form-control" @if($edit) value="{{ $asset->asset_tag }}" @endif placeholder="Service Tag Number">
    </div>
    <div class="form-group">
        <label for="serial_number">Serial Number</label>
        <input type="text" id="serial_number" name="serial_number" class="form-control" @if($edit) value="{{ $asset->seirial_number }}" @endif placeholder="Serial Number">
    </div>
    <div class="form-group">
        <label for="year">Year</label>
        <input type="text" id="year" name="year" class="form-control" @if($edit) value="{{ $asset->year }}" @endif placeholder="Year Manufactured">
    </div>
    <div class="form-group">
        <label for="make">Make</label>
        <input type="text" id="make" name="make" class="form-control" @if($edit) value="{{ $asset->make }}" @endif placeholder="Make">
    </div>
    <div class="form-group">
        <label for="model">Model</label>
        <input type="text" id="model" name="model" class="form-control" @if($edit) value="{{ $asset->model }}" @endif placeholder="Model / Description">
    </div>
    <div class="form-group">
        <label for="description">Description / User</label>
        <input type="text" id="description" name="description" class="form-control" @if($edit) value="{{ $asset->description }}" @endif placeholder="Description or User">
    </div>
    <div class="form-group">
        <label for="type">Asset Type</label>
        <select class="select2 form-control" name="type">
            @foreach($types as $type)
			<option value="{{$type->id}}" @if($edit) @if($asset->type == $type->id) selected @endif @endif >{{ $type->description }}</option>
			@endforeach
		</select>
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <select class="select2 form-control" name="location">
            @foreach($locations as $location)
			<option value="{{$location->id}}" @if($edit) @if($location->id == $asset->location_id) selected @endif @endif >{{ $location->description }}</option>
			@endforeach
		</select>
    </div>
    <div class="form-group">
        <label for="station">Station</label>
        <select class="select2 form-control" name="station">
            @foreach($stations as $station)
			<option value="{{$station->id}}" @if($edit) @if($station->id == $asset->station_id) selected @endif @endif  >{{ $station->station }}</option>
			@endforeach
		</select>
    </div>
    <div class="form-group">
        <label for="units">Unit Assigned</label>
        <select class="default-select4 form-control" name="unit">
            <option>No Unit Assigned</option>
            @foreach($units as $unit)
			<option value="{{$unit->id}}" @if($edit) @if($unit->id == $asset->unit_id) selected @endif @endif  >{{ $unit->unit_number}}</option>
			@endforeach
		</select>
    </div>
    <div class="form-group">
        <label for="company">Company</label>
        <select class="default-select5 form-control" name="company">
            @foreach($companies as $company)
			<option value="{{$company->id}}" @if($edit) @if($company->id == $asset->company_id) selected @endif @endif >{{ $company->name}}</option>
			@endforeach
		</select>
    </div>
    <div class="form-group">
        <label for="cost">Initial Cost</label>
        <input type="number" id="cost" name="cost" class="form-control" placeholder="Initial Cost">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="default-select5 form-control" name="status">
            @foreach($statuses as $status)
			<option value="{{$status->id}}" @if($edit) @if($status->id == $asset->status) selected @endif @endif >{{ $status->description}}</option>
			@endforeach
		</select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit New Asset</button>
    </div>
</form>