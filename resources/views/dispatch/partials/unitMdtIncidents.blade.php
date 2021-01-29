@if($employee->unitAssigned)
@foreach($employee->unitAssigned->incidents->where('status', '>=', 1)->where('status', '<=', 3) as $incident)
@if($loop->first)
     @if($incident->status == 1)
        <audio src="/public/24.wav" autoplay loop></audio>
11
     @endif
@endif
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Incident Type: {{ $incident->type->description or 'Unknown' }}</h5>
            
            <div class="row">
                <div class="col-md-2 p-3">
                    <button type="button" class="btn btn-danger btn-lg btn-block">Acknowledge</button>
                </div>
                
                <div class="col-md-2 p-3">
                    <button type="button" class="btn btn-primary btn-lg btn-block">Enroute</button>
                </div>
                
                <div class="col-md-2 p-3">
                    <button type="button" class="btn btn-warning btn-lg btn-block">At Scene</button>
                </div>
                
                <div class="col-md-2 p-3">
                    <button type="button" class="btn btn-warning btn-lg btn-block">Transporting</button>
                </div>
                
                <div class="col-md-2 p-3">
                    <button type="button" class="btn btn-warning btn-lg btn-block">At Facility</button>
                </div>
                
                <div class="col-md-2 p-3">
                    <button type="button" class="btn btn-success btn-lg btn-block">Clear</button>
                </div>
            
            </div>
          </div>
        </div>
    </div>
        
</div>
@endforeach
@else

@endif
