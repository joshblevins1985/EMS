@csrf

<input type="hidden" name="patient_id" value="{{$pt->id}}" />

<div class="form-group">
   <span class="text-success pull-right"><a data-toggle="modal" data-target="#addFacility" ><i class="far fa-plus-square fa-2x"></i></a></span>
    <label for="condition_id">Select Insurance Provider</label>
    <select class="default-facility form-control" id="condition_id" name="condition_id">
        @foreach($conditions as $row)
		<option value="{{$row->id}}" > {{ $row->label }} </option>
		@endforeach
	</select>
</div>

<div class="form-group">
   <span class="text-success pull-right"><a data-toggle="modal" data-target="#addFacility" ><i class="far fa-plus-square fa-2x"></i></a></span>
    <label for="reported_by">Select Insurance Provider</label>
    <select class="default-facility form-control" id="reported_by" name="reported_by">
       
		<option value="1" > Patient </option>
		<option value="2" > Family </option>
		<option value="3" > Medical Staff </option>
		<option value="4" > Medical Records </option>
		
	</select>
</div>

<div class="form-group">
        <input type="submit" class="btn btn-primary btn-lg btn-block">Add Insurance</button>
    </div>