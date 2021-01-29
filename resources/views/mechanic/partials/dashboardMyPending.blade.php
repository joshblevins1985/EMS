
@if(count($jobs))
@foreach ($jobs as $job )
<li class="list-group-item mb-2 bg-primary">
    <div class="row">
        <div class="col-xl-6">
            <h2> {{  $job->unit }} </h2>
        </div>
        <div class="col-xl-6">
            <small>Total Reported Issues: {{ count($job->problems) }} </small>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success btn-sm" data-unit_id="{{ $job->id}}" data-toggle="modal" data-target="#modalServiceTicket">Start Working</button>
        </div>
        
    </div>
</li>
@endforeach
@else
<li class="list-group-item mb-2 bg-success">
<div class="row">
<div class="col-xl-12">
    <h2>  No Available For Assignement </h2>
</div>
</div>
</li>
@endif


