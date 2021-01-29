<form action="/patientAddDoctorCert" method="post">
    
    @csrf
    <input type="hidden"  name="patient_id" value="{{ $pt->id }}">
    <input type="hidden"  name="status" value="1">
   
    
    <div class="form-group">
        
        <label for="doctors_cert">Select Type of Cert</label>
        <select class="default-doctors_cert form-control" id="doctors_cert" name="physician_id">
			<option value="1" > Medicaid Certification </option>
			<option value="9999" > Other Certification </option>
		</select>
    </div>
    
        <div class="form-group">
			<label class="col-lg-4 col-form-label">Start Date</label>
			
				<input type="text" class="form-control" id="datepicker-default" name="start_date" placeholder="Start Date" value="{{ Carbon\Carbon::now()->format('m-d-Y') }}" />
			
		</div>
		<div class="form-group">
			<label class="col-lg-4 col-form-label">End Date</label>
			
				<input type="text" class="form-control" id="datepicker-end" name="end_date" placeholder="End Date" value="{{ Carbon\Carbon::now()->addDays(60)->format('m-d-Y') }}" />

		</div>
		
		<div class="form-group">
               <label for="not">Number of Transports Expected during time period.</label>
                <input type="text" id="not" name="number_of_transports" class="form-control" placeholder="Number of transports">
           </div>
		
		<div class="form-group">
        
            <label for="round_trip">Is this a round trip transprot</label>
            <select class="default-round_trip form-control" id="round_trip" name="round_trip">
    			<option value="0" > No </option>
    			<option value="1" selected > Yes </option>
    		</select>
        </div>
        
            <div class="form-group">
               <label for="pick_up">Pick up address</label>
                <input type="text" id="pick_up" name="pick_up_address" class="form-control" placeholder="Pick up address">
           </div>
           
           <div class="form-group">
               <label for="drop_off">Drop off address</label>
                <input type="text" id="drop_off" name="drop_off_address" class="form-control" placeholder="Drop off address">
           </div>
           
           <div class="form-group">
        
        <label for="procedure">Select Procedure Code</label>
        <select class="default-procedure form-control" id="procedure" name="procedure_code">
			<option selected > Select Procedure </option>
            @foreach($procedures as $row)
            <option value="{{ $row->id }}"> {{ $row->code }} - {{ $row->description }} </option>
            @endforeach
		</select>
    </div>
    
    <div class="form-group">
        
        <label for="pcs_doc">Select Certifying Physician</label>
        <select class="default-pcs_doc form-control" id="pcs_doc" name="physician_id">
			<option selected > Select Physician for Cert </option>
            @foreach($pt->physician as $row)
            <option value="{{ $row->id }}"> {{ $row->doctor->first_name }} - {{ $row->doctor->last_name }} -- {{ $row->doctor->npi }} </option>
            @endforeach
		</select>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Add Certification</button>
    </div>
    
</form>