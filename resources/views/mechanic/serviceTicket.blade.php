@extends('layouts.default')

@section('page-title', trans('Mechanic Tasks'))
@section('page-heading', trans('Maintanance Tasks'))

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card bg-dark mb-2">
                        
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td> <strong> Date : </strong>  {{ Carbon\Carbon::parse($ticket->created_at)->format('m-d-Y H:i') }}</td>
                            <td> <strong> Unit / Type : </strong> {{ $ticket->unit_id }} / @if($ticket->unit->type <= 4) Ambulance @elseif($ticket->unit->type == 5) Wheel Chair @elseif($ticket->unit->type == 6) Car @endif</td>
                            <td> <strong> Service Mileage : </strong> {{ $ticket->unit->service }} </td>
                        </tr>
                        <tr>
                            <td> <strong> License Plate / Expiration : </strong> {{ $ticket->license_plate }}  /  {{ Carbon\Carbon::parse($ticket->unit->tag_expiration)->format('m-d-Y')   }}</td>
                            <td> <strong> Model : </strong> {{ $ticket->unit->model }} </td>
                            <td> <strong> State ID : </strong> 
                                {{ $ticket->unit->odps_number ? 'OH /'. $ticket->unit->odps_number : 'OH None'}} 
                                <p>{{ $ticket->unit->ky_number ? 'KY /'. $ticket->unit->ky_number : 'KY None'}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td> <strong> Last Odometer Reading : </strong> {{$ticket->unit->odometer }}  {{   Carbon\Carbon::parse($ticket->unit->odometer_date)->format('m-d-Y')   }}</td>
                            <td> <strong> Engine : </strong> {{  $ticket->unit->engine ?? 'Engine Not on Record'}} </td>
                            <td> <strong> VIN Number : </strong> {{ $ticket->unit->vin ?? 'No VIN number on Record'}} </td>
                        </tr>
                        <tr>
                            <td> <strong> Year : </strong>  {{ Carbon\Carbon::parse($ticket->created_at)->format('m-d-Y H:i') }}</td>
                            <td> <strong> Primary Station : </strong> {{ $ticket->unit->location->station }} </td>
                            <td> <strong> Stretcher  : </strong> @if($ticket->unit->last_stretcher_inspection < Carbon\Carbon::now()) <span class="text-danger"> Stretcher Inspection Required / SN: {{ $ticket->unit->stretcher  ?? 'No Stretcher Found'}}</span> @else SN: {{ $ticket->unit->stretcher  ?? 'No Stretcher Found'}} / {{ Carbon\Carbon::parse($ticket->unit->last_stretcher_inspection)->format('m-d-Y')  }}  @endif </td>
                        </tr>
                        <tr>
                            
                            <td> <strong> Safety Inspection Due : @if($ticket->unit->odometer > $ticket->unit->safety_report + 25000) <a data-toggle="modal" data-target="#modalSafetyReport" data-unitid="{{$ticket->unit_id}}" ><span class="text-danger"> Safety Inspection Due {{ $ticket->unit->odometer - ($ticket->unit->safety_report + 25000) }} miles overdue.</span> </a> @else  {{  $ticket->unit->safety_report     }} @endif </strong>  </td>
                            <td colspan="2"> <strong> Company : </strong> {{ $ticket->unit->company->name ?? 'Unknown'}}  </td>
                            
                        </tr>
                    </thead>
                </table>
               
              
            </div>
          </div>
    </div>
    
    
</div>
<div class="row">
    <div class="col-xl-4">
        <table class="table table-bordered table-striped">
            <tr>
                <td> Check Wipers </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="wipers" id="wipers1" value="0" onchange="this.form.submit()"@if(!$ticket->wipers) checked @endif>
                        <label class="form-check-label" for="wipers1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="wipers" id="wipers2" value="1" onchange="this.form.submit()" @if($ticket->wipers) checked @endif>
                        <label class="form-check-label" for="wipers2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Head Lights </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="head_lights" id="head_lights1" value="0" onchange="this.form.submit()"@if(!$ticket->head_lights) checked @endif>
                        <label class="form-check-label" for="head_lights1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="head_lights" id="head_lights2" value="1" onchange="this.form.submit()" @if($ticket->head_lights) checked @endif>
                        <label class="form-check-label" for="head_lights2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Turn Signals </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="turn_signals" id="turn_signals1" value="0" onchange="this.form.submit()"@if(!$ticket->turn_signals) checked @endif>
                        <label class="form-check-label" for="turn_signals1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="turn_signals" id="turn_signals2" value="1" onchange="this.form.submit()" @if($ticket->turn_signals) checked @endif>
                        <label class="form-check-label" for="turn_signals2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Lube Hinges </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="lube_higes" id="lube_higes1" value="0" onchange="this.form.submit()"@if(!$ticket->lube_higes) checked @endif>
                        <label class="form-check-label" for="lube_higes1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="lube_higes" id="lube_higes2" value="1" onchange="this.form.submit()" @if($ticket->lube_higes) checked @endif>
                        <label class="form-check-label" for="lube_higes2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Emergency Lights </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="emergency_lights" id="emergency_lights1" value="0" onchange="this.form.submit()"@if(!$ticket->emergency_lights) checked @endif>
                        <label class="form-check-label" for="emergency_lights1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="emergency_lights" id="emergency_lights2" value="1" onchange="this.form.submit()" @if($ticket->emergency_lights) checked @endif>
                        <label class="form-check-label" for="emergency_lights2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Rear Dome Lights </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rear_domes" id="rear_domes1" value="0" onchange="this.form.submit()"@if(!$ticket->rear_domes) checked @endif>
                        <label class="form-check-label" for="rear_domes1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rear_domes" id="rear_domes2" value="1" onchange="this.form.submit()" @if($ticket->rear_domes) checked @endif>
                        <label class="form-check-label" for="rear_domes2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Washer Fluid </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="washer_fluid" id="washer_fluid1" value="0" onchange="this.form.submit()"@if(!$ticket->washer_fluid) checked @endif>
                        <label class="form-check-label" for="washer_fluid1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="washer_fluid" id="washer_fluid2" value="1" onchange="this.form.submit()" @if($ticket->washer_fluid) checked @endif>
                        <label class="form-check-label" for="washer_fluid2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Check Air Filter </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="air_filter" id="air_filter1" value="0" onchange="this.form.submit()"@if(!$ticket->air_filter) checked @endif>
                        <label class="form-check-label" for="air_filter1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="air_filter" id="air_filter2" value="1" onchange="this.form.submit()" @if($ticket->air_filter) checked @endif>
                        <label class="form-check-label" for="air_filter2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Oil Level </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="oil_level" id="oil_level1" value="0" onchange="this.form.submit()"@if(!$ticket->oil_level) checked @endif>
                        <label class="form-check-label" for="oil_level1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="oil_level" id="oil_level2" value="1" onchange="this.form.submit()" @if($ticket->oil_level) checked @endif>
                        <label class="form-check-label" for="oil_level2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Power Steering Fluid </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="power_steering_level" id="power_steering_level1" value="0" onchange="this.form.submit()"@if(!$ticket->power_steering_level) checked @endif>
                        <label class="form-check-label" for="power_steering_level1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="power_steering_level" id="power_steering_level2" value="1" onchange="this.form.submit()" @if($ticket->power_steering_level) checked @endif>
                        <label class="form-check-label" for="power_steering_level2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Brake Fluid </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="brake_fluid_level" id="brake_fluid_level1" value="0" onchange="this.form.submit()"@if(!$ticket->brake_fluid_level) checked @endif>
                        <label class="form-check-label" for="brake_fluid_level1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="brake_fluid_level" id="brake_fluid_level2" value="1" onchange="this.form.submit()" @if($ticket->brake_fluid_level) checked @endif>
                        <label class="form-check-label" for="brake_fluid_level2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Coolant Level</td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="coolant_level" id="coolant_level1" value="0" onchange="this.form.submit()"@if(!$ticket->coolant_level) checked @endif>
                        <label class="form-check-label" for="coolant_level1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="coolant_level" id="coolant_level2" value="1" onchange="this.form.submit()" @if($ticket->coolant_level) checked @endif>
                        <label class="form-check-label" for="coolant_level2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Test/Clean Batteries </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="batteries" id="batteries1" value="0" onchange="this.form.submit()"@if(!$ticket->batteries) checked @endif>
                        <label class="form-check-label" for="batteries1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="batteries" id="batteries2" value="1" onchange="this.form.submit()" @if($ticket->batteries) checked @endif>
                        <label class="form-check-label" for="batteries2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Spare Tire </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="spare_tire" id="spare_tire1" value="0" onchange="this.form.submit()"@if(!$ticket->spare_tire) checked @endif>
                        <label class="form-check-label" for="spare_tire1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="spare_tire" id="spare_tire2" value="1" onchange="this.form.submit()" @if($ticket->spare_tire) checked @endif>
                        <label class="form-check-label" for="spare_tire2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Brakes </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="brakes" id="brakes1" value="0" onchange="this.form.submit()"@if(!$ticket->brakes) checked @endif>
                        <label class="form-check-label" for="brakes1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="brakes" id="brakes2" value="1" onchange="this.form.submit()" @if($ticket->brakes) checked @endif>
                        <label class="form-check-label" for="brakes2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Rotors </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rotors" id="rotors1" value="0" onchange="this.form.submit()"@if(!$ticket->rotors) checked @endif>
                        <label class="form-check-label" for="rotors1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rotors" id="rotors2" value="1" onchange="this.form.submit()" @if($ticket->rotors) checked @endif>
                        <label class="form-check-label" for="rotors2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Tires </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tires" id="tires1" value="0" onchange="this.form.submit()"@if(!$ticket->tires) checked @endif>
                        <label class="form-check-label" for="tires1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tires" id="tires2" value="1" onchange="this.form.submit()" @if($ticket->tires) checked @endif>
                        <label class="form-check-label" for="tires2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Torque Wheels 70/100/150 </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="torque_wheels" id="torque_wheels1" value="0" onchange="this.form.submit()"@if(!$ticket->torque_wheels) checked @endif>
                        <label class="form-check-label" for="torque_wheels1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="torque_wheels" id="torque_wheels2" value="1" onchange="this.form.submit()" @if($ticket->torque_wheels) checked @endif>
                        <label class="form-check-label" for="torque_wheels2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Check/Lube Front End </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="front_end" id="front_end1" value="0" onchange="this.form.submit()"@if(!$ticket->front_end) checked @endif>
                        <label class="form-check-label" for="front_end1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="front_end" id="front_end2" value="1" onchange="this.form.submit()" @if($ticket->front_end) checked @endif>
                        <label class="form-check-label" for="front_end2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Backup Beeper </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="backup_beeper" id="backup_beeper1" value="0" onchange="this.form.submit()"@if(!$ticket->backup_beeper) checked @endif>
                        <label class="form-check-label" for="backup_beeper1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="backup_beeper" id="backup_beeper2" value="1" onchange="this.form.submit()" @if($ticket->backup_beeper) checked @endif>
                        <label class="form-check-label" for="backup_beeper2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Check / Lube Stretcher</td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stretcher" id="stretcher1" value="0" onchange="this.form.submit()"@if(!$ticket->stretcher) checked @endif>
                        <label class="form-check-label" for="stretcher1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stretcher" id="stretcher2" value="1" onchange="this.form.submit()" @if($ticket->stretcher) checked @endif>
                        <label class="form-check-label" for="stretcher2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Check E-Brake </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ebrake" id="ebrake1" value="0" onchange="this.form.submit()"@if(!$ticket->ebrake) checked @endif>
                        <label class="form-check-label" for="ebrake1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ebrake" id="ebrake2" value="1" onchange="this.form.submit()" @if($ticket->ebrake) checked @endif>
                        <label class="form-check-label" for="ebrake2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Body Damage </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="body_damage" id="body_damage1" value="0" onchange="this.form.submit()"@if(!$ticket->body_damage) checked @endif>
                        <label class="form-check-label" for="body_damage1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="body_damage" id="body_damage2" value="1" onchange="this.form.submit()" @if($ticket->body_damage) checked @endif>
                        <label class="form-check-label" for="body_damage2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Check HVAC </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hvac" id="hvac1" value="0" onchange="this.form.submit()"@if(!$ticket->hvac) checked @endif>
                        <label class="form-check-label" for="hvac1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hvac" id="hvac2" value="1" onchange="this.form.submit()" @if($ticket->hvac) checked @endif>
                        <label class="form-check-label" for="hvac2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td> Check Camera </td>
                <td> 
                    <form action="/updateTicketItem/{{ $ticket->id }}" method="POST">
                        
                        @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="camera" id="camera1" value="0" onchange="this.form.submit()"@if(!$ticket->camera) checked @endif>
                        <label class="form-check-label" for="camera1">Not Ok</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="camera" id="camera2" value="1" onchange="this.form.submit()" @if($ticket->camera) checked @endif>
                        <label class="form-check-label" for="camera2">Ok</label>
                      </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>

    <div class="col-xl-8">
        
            <div class="card" style="height:950px">
                <div class="card-header bg-danger text-center">
                   <h3> JOBS COMPLETED ON THIS SERVICE TICKET </h3>
                </div>
                <div class="card-body">
                  
                    @foreach($ticket->jobs as $job)
                    <div class="card @if($job->status == 4) bg-primary @else bg-dark  @endif mb-2">
                        
                        <div class="card-body">
                          
                            <div claas="row">
                                <strong> Description </strong> : {!! $job->comments !!}
                            </div>

                            <div class="row">
                                @foreach($job->problems as $problem)
                                <div class="col-xl-11 offset-xl-1">
                                    <div class="col-xl-12">
                                        {{ $problem->task_label->label }} - {{ $problem->comments ?? 'No Comments' }}

                                        <span class="float-right" data-toggle="modal" data-target="#modalViewNote" data-taskid="{{$problem->id}}" >Notes: <span class="badge badge-danger" > {{ count($problem->notes) }}</span></span>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span class="badge badge-warning" data-toggle="modal" data-target="#modalAddNote" data-taskid="{{$problem->id}}">Add Note</span>
                                        </div>
                                        <div class="col">
                                            <span class="badge badge-success text-dark" data-toggle="modal" data-target="#modalAddNote" data-taskid="{{$problem->id}}">Complete Task</span>
                                        </div>
                                    </div>
                                    
                                </div>
                                @endforeach
                            </div>
                          
                        </div>
                      </div>
                    @endforeach
                    <div class="row">
                        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#modalAddNewTask" data-unitid="{{$ticket->unit->unit_number}}" data-serviceid="{{ $ticket->id }}" >Add Another Job</button>
                      </div>
                </div>
              </div>
              <a href="/garage/repair/completeAll/{{$ticket->id}}"<button type="button" class="btn btn-success btn-lg btn-block"  >Complete all Tasks on This Ticket</button></a>


              
          
    </div>

</div>

@stop
@include('mechanic.partials.modelAddNotes')
@include('mechanic.partials.modalAddNewTask')
@include('mechanic.partials.modelViewNotes')
@include('mechanic.partials.modelRemoveParts')
@include('mechanic.partials.modalSafetyReport')

@push('styles')

@endpush

@push('scripts')
<script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
<script src="/assets/plugins/highlight.js/highlight.min.js"></script>
<script>
    $('#modalSafetyReport').on('show.bs.modal', function(e) {
        var unitid = $(e.relatedTarget).data('unitid');
        $("#safety_unit_id").val( unitid );
        console.log(unitid);
        $('#safeyReport').load('/safetyReport' ,function () {
            $(this).html();
            
       });
    });

    $('#modalAddNote').on('show.bs.modal', function(e) {
        var taskid = $(e.relatedTarget).data('taskid');
        $("#task_id").val( taskid );
    });

   

    $('#modalViewNote').on('show.bs.modal', function(e) {
        var taskid = $(e.relatedTarget).data('taskid');
        $('#bodyNotes').load('/garage/notes/' + taskid,function () {
            $(this).html();
       });
    });

    $('#modalAddNewTask').on('show.bs.modal', function(e) {
        var unitid = $(e.relatedTarget).data('unitid');
        var serviceid = $(e.relatedTarget).data('serviceid');
        $("#service_id").val( serviceid );
        $("#unit_id").val( unitid )
    });

    var handleSelect2 = function() {
        $(".default-select2").select2();
        $(".multiple-select2").select2({ placeholder: "Select a state" });
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
    
    function radioUpdate() {
        alert("radio selected");
        }
</script>

@endpush

