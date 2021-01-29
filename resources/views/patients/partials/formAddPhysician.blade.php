<form action="/physicianAdd"  method="post" id="addphysicianform">
    
    @csrf
    <div class="row">
        <div class="col-xl-4">
            <div class="form-group">
               <label for="first_name">Physician First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Physician First Name">
           </div>
        </div> 
    
        <div class="col-xl-2">
            <div class="form-group">
                <label for="middle_initial">MI</label>
                <input type="text" id="middle_initial" name="middle_initial" class="form-control" placeholder="Middle Initial">
            </div>
        </div>
        
        <div class="col-xl-4">
            <div class="form-group">
                <label for="last_name">Physician Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Physician Last Name">
            </div>
        </div>
    
    </div>
    
    <div class="row">
        <div class="col-xl-6">
            <div class="form-group">
               <label for="npi">NPI Number</label>
                <input type="text" id="npi" name="npi" class="form-control" placeholder="Physician NPI number">
           </div>
        </div>
        
        <div class="col-xl-6">
            <div class="form-group">
               <span class="text-success pull-right"><a data-toggle="modal" data-target="#addFacility" ><i class="far fa-plus-square fa-2x"></i></a></span>
                <label for="location">Select Facility</label>
                <select class="default-facility form-control" id="facility" name="facility_id">
                    @foreach($facilities as $row)
        			<option value="{{$row->id}}" > {{ $row->name }} </option>
        			@endforeach
        		</select>
           </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="form-group">
               <label for="address_other">Physician Address if different than facility address.</label>
                <input type="text" id="address_other" name="address_other" class="form-control" placeholder="Address">
           </div>
        </div>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-lg btn-block">Add Physician</button>
    </div>
    
</form>