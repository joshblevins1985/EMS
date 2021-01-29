@csrf

<input type="hidden" name="patient_id" value="{{$pt->id}}" />

<div class="form-group">
   <span class="text-success pull-right"><a data-toggle="modal" data-target="#addFacility" ><i class="far fa-plus-square fa-2x"></i></a></span>
    <label for="location">Select Insurance Provider</label>
    <select class="default-facility form-control" id="insurance_provider" name="carrier_id">
        @foreach($insurances as $row)
		<option value="{{$row->id}}" > {{ $row->label }} </option>
		@endforeach
	</select>
</div>

<div class="form-group">
   <label for="group_id">Group ID</label>
    <input type="text" id="group_id" name="group_id" class="form-control" placeholder="Group ID">
</div>

<div class="form-group">
   <label for="policy">Policy Number</label>
    <input type="text" id="policy" name="policy_id" class="form-control" placeholder="Policy Number">
</div>

<div class="form-group">
	<label class="col-lg-4 col-form-label">Effective Date</label>
	
		<input type="text" class="form-control" id="datepicker-effective" name="effective_date" placeholder="Effective Date"  />
	
</div>

<div class="form-group">
	<label class="col-lg-4 col-form-label">Terminiation Date</label>
	
	<input type="text" class="form-control" id="datepicker-term" name="term_date" placeholder="Termination Date"  />
	
</div>

<div class="form-group">
   
    <label for="primary">Is Isurance Primary</label>
    <select class="default-facility form-control" id="primary" name="primary">
        <option  selected > Is insurance primary. </option>
		<option value="1" > Yes </option>
		<option value="0" > No </option>
	
	</select>
</div>

<div class="form-group">
   
    <label for="status">Status of insurance.</label>
    <select class="default-facility form-control" id="status" name="status">
        <option  selected > Status of insurance. </option>
		<option value="1" > Active </option>
		<option value="2" > Pending Expiration </option>
		<option value="3" > PExpired </option>
	
	</select>
</div>

<div class="form-group">
        <input type="submit" class="btn btn-primary btn-lg btn-block">Add Insurance</button>
    </div>