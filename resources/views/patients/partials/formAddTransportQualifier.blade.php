<form action="/patientAddTransportQualifier/{{ Auth()->user()->id }}" method="post">
    
    @csrf
    <input type="hidden"  name="patient_id" value="{{ $pt->id }}">
    <input type="hidden"  name="status" value="1">
   
    
    <div class="form-group">
        
        <label for="location">Select Transport Qualifier</label>
        <select class="default-physician form-control" id="transport_qualifier" name="transport_qualifier_id">
            @foreach($transportQualifiers as $row)
			<option value="{{$row->id}}" > {{ $row->description }} </option>
			@endforeach
		</select>
    </div>
    
        <div class="form-group">
        <label for="medical_condition">Choose supporting medical condition.</label>
        <select class="default-physician form-control" id="medical_condition" name="medical_condition">
            @foreach($pt->medical as $row)
			<option value="{{$row->id}}" > {{ $row->condition->label }} </option>
			@endforeach
		</select>
    </div>
 
    <div class="form-group">
       <label for="note">Note</label>
        <input type="text" id="note" name="note" class="form-control" placeholder="Clarifying note">
    </div>
    
    
	
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Add Qualifier</button>
    </div>
    
</form>