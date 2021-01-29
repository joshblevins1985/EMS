<form action="/assetSupportRequest" method="post">
    
    @csrf
    <div class="form-group">
        <label for="location">Select Asset</label>
        <select class="select2 form-control" name="assetId" style="width: 100%">
            <option>No Asset to Attach</option>
            @foreach($assets as $asset)
			<option value="{{$asset->id}}" >{{ $asset->asset_tag }}  </option>
			@endforeach
		</select>
    </div>
   
    
    
    <!-- begin panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Description of problem.</h4>
			
		</div>
		<div class="panel-body">
				<textarea class="textarea form-control" style="color:white" id="wysihtml5" name="description" placeholder="Enter a description of the problem you are experiencing." rows="12"></textarea>
		</div>
	</div>
	<!-- end panel -->
	
	<div class="form-group">
        <label for="location">Priority</label>
        <select class="select2 form-control" name="priority" style="width: 100%">
            <option selected disabled>Select Priority</option>
			<option value="1" > Urgent </option>
			<option value="2" > High </option>
			<option value="3" > Medium </option>
			<option value="4" > Low </option>

		</select>
    </div>

	<div class="form-group">
		<label for="station">Station Assigned</label>
		<select class="select2 form-control" name="station" style="width: 100%">
			@foreach($stations as $row)
				<option value="{{$row->id}}"> {{ $row->station }} </option>
			@endforeach
		</select>
	</div>
	
	<div class="form-group">
        <label for="location">Reported By</label>
        <select class="select2 form-control" name="reportedBy" style="width: 100%">
            @foreach($employees as $employee)
			<option value="{{$employee->user_id}}" @if(auth()->user()->id == $employee->user_id) selected @endif >{{ $employee->last_name }} {{ $employee->first_name }} </option>
			@endforeach
		</select>
    </div>
    
    <div class="form-group">
        <label for="location">Assigned To</label>
        <select class="select2 form-control" name="user_id" style="width: 100%">
            <option selected disabled>Assiged To</option>
            @foreach($employees as $employee)
			<option value="{{$employee->user_id}}" @if(auth()->user()->id == $employee->user_id) selected @endif >{{ $employee->last_name }} {{ $employee->first_name }} </option>
			@endforeach
		</select>
    </div>
    
    <div class="form-group">
        <label for="location">Status</label>
        <select class="select2 form-control" name="status" style="width: 100%">
            <option selected disabled>Select Status</option>
			<option value="1" > New Not Started </option>
			<option value="2" > Working in Progress </option>
			<option value="3" > On Hold 30 Days </option>
			<option value="4" > On Hold 60 Days </option>
			<option value="5" > On Hold 90 Days </option>
			<option value="97" > Admin Denied Request </option>
			<option value="98" > Canceled Duplicate Ticket </option>
			<option value="99" > Completed </option>
			
			
		</select>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit New Support Request</button>
    </div>
    
</form>