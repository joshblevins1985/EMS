<form action="/patientAddPhysician" method="post">
    
    @csrf
    <input type="hidden"  name="patient_id" value="{{ $pt->id }}">
    <input type="hidden"  name="status" value="1">
   
    
    <div class="form-group">
        <span class="text-success pull-right"><a data-toggle="modal" data-target="#addPhysicain" ><i class="far fa-plus-square fa-2x"></i></a></span>
        <label for="location">Select Asset</label>
        <select class="default-physician form-control" id="addPatientPhysicianSelect" name="physician_id">
            @foreach($physicians as $row)
			<option value="{{$row->id}}" > {{ $row->last_name }} {{ $row->first_name }} - {{ $row->npi }} </option>
			@endforeach
		</select>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Add Physician</button>
    </div>
    
</form>