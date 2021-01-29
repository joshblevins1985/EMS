
<!-- Modal -->
<div class="modal fade right" id="modalTransport" tabindex="-1" role="dialog" aria-labelledby="modalTransportLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTransportLabel">Dispatching Unit on incident number:<span id="incident_id"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="notFacility">
            <label class="form-check-label" for="notFacility">Check this box for address boxes.</label>
        </div>
        <form action="transport" method="POST">
        
        @csrf
        
        <input id="runid" name="runid" type="hidden" value=""></input>
        <select class="mdb-select md-form" id="facility" name="facility" searchable="Search Facilities">
          <option value="" disabled selected>Choose your option</option>
          @foreach($facilities as $row)
          <option value="1">{{$row->name}}</option>
            @endforeach    
        </select>
        
        
        <div class="address" id="address" style="display: none">
            <div class="row">
    <div class="col-lg-12">

        <!-- Material input -->
        <div class="md-form">
            <input type="text" id="autocomplete" placeholder="Enter your address"
                   onFocus="geolocate()"  class="form-control validate" >
        </div>

    </div>
</div>

<div class="row">

    <div class="col-lg-2">
        <!-- Material input -->
        <div class="md-form">
            <input type="text" id="street_number" name="house_number" class="form-control" disabled>
            <label for="house_number">House</label>
        </div>
    </div>
    <div class="col-lg-4">
        <!-- Material input -->
        <div class="md-form">
            <input type="text" id="route" name="incident_address" class="form-control" disabled>
            <label for="address">Street Name</label>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Material input -->
        <div class="md-form">
            <input type="text" id="address_2" name="address_2" class="form-control">
            <label for="address_2">If no valid address type address here.</label>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-4">
        <!-- Material input -->
        <div class="md-form">
            <input type="text" id="locality" name="incident_city" class="form-control">
            <label for="city">City</label>
        </div>
    </div>
    <div class="col-lg-4">
        <!-- Material input -->
        <div class="md-form">
            <input type="text" id="administrative_area_level_1" name="incident_state" class="form-control">
            <label for="state">State</label>
        </div>
    </div>
    <div class="col-lg-4">
        <!-- Material input -->
        <div class="md-form">
            <input type="text" id="postal_code" name="incident_zip" class="form-control">
            <label for="zip">Zip</label>
        </div>
    </div>



</div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

