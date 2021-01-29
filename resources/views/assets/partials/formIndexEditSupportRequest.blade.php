<form action="/updateAssetSupportRequest/{{$ticket->id}}" method="post">
    
    @csrf
    <div class="form-group">
        <label for="location">Select Asset</label>
        <select class="select2 form-control" name="assetId">
            <option>No Asset to Attach</option>
            @foreach($assets as $asset)
			<option value="{{$asset->id}}" @if($ticket->asset_id == $asset->id) selected @endif >{{ $asset->asset_tag }}  </option>
			@endforeach
		</select>
    </div>
   
    
    
    <!-- begin panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Description of problem.</h4>
			
		</div>
		<div class="panel-body">
				<textarea class="textarea form-control" style="color:white" id="wysihtml5" name="description" placeholder="Enter a description of the problem you are experiencing." rows="12"> {!! $ticket->description !!}</textarea>
		</div>
	</div>
	<!-- end panel -->
	
	<div class="form-group">
        <label for="location">Priority</label>
        <select class="select2 form-control" name="priority">
            <option selected disabled>Select Priority</option>
			<option value="1" @if($ticket->priority == 1) selected @endif > Urgent </option>
			<option value="2" @if($ticket->priority == 2) selected @endif > High </option>
			<option value="3" @if($ticket->priority == 3) selected @endif > Medium </option>
			<option value="4" @if($ticket->priority == 4) selected @endif > Low </option>
			
			
		</select>
    </div>

	<div class="form-group">
		<label for="station">Station Assigned</label>
		<select class="select2 form-control" name="station" style="width: 100%">
			@foreach($stations as $row)
				<option value="{{$row->id}}" @if($ticket->station == $row->id) selected @endif> {{ $row->station }} </option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
        <label for="location">Reported By</label>
        <select class="select2 form-control" name="reportedBy">
            <option selected disabled>Reported By</option>
            @foreach($employees as $employee)
			<option value="{{$employee->user_id}}" @if($ticket->reported_by == $employee->user_id) selected @endif >{{ $employee->last_name }} {{ $employee->first_name }} </option>
			@endforeach
		</select>
    </div>
    
    <div class="form-group">
        <label for="location">Assigned To</label>
        <select class="select2 form-control" name="user_id">
            <option selected disabled>Assiged To</option>
            @foreach($employees as $employee)
			<option value="{{$employee->user_id}}" @if($ticket->user_id == $employee->user_id) selected @endif >{{ $employee->last_name }} {{ $employee->first_name }} </option>
			@endforeach
		</select>
    </div>
    
    <div class="form-group">
        <label for="location">Status</label>
        <select class="select2 form-control" name="status">
            <option selected disabled>Select Status</option>
			<option value="1" @if($ticket->status == 1) selected @endif > New Not Started </option>
			<option value="2" @if($ticket->status == 2) selected @endif > Working in Progress </option>
			<option value="3" @if($ticket->status == 3) selected @endif > On Hold 30 Days </option>
			<option value="4" @if($ticket->status == 4) selected @endif > On Hold 60 Days </option>
			<option value="5" @if($ticket->status == 5) selected @endif > On Hold 90 Days </option>
			<option value="97" @if($ticket->status == 97) selected @endif > Admin Denied Request </option>
			<option value="98" @if($ticket->status == 98) selected @endif > Canceled Duplicate Ticket </option>
			<option value="99" @if($ticket->status == 99) selected @endif > Completed </option>
			
			
		</select>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Update Support Request</button>
    </div>
    
</form>

<script>
    var handleSelect2 = function() {
	$(".select2").select2();
	$(".default-assignEmployee ").select2();
};

var FormPlugins = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleSelect2();
		}
	};
}();

$(document).ready(function() {
	FormPlugins.init();
});
</script>