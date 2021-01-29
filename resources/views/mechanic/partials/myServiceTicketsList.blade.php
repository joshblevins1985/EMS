
@if(count($tickets))
@foreach ($tickets as $ticket )
<li class="list-group-item mb-2 bg-primary">
    <div class="row">
        <div class="col-xl-6">
            <h2> {{  $ticket->unit_id }} </h2>
        </div>
        <div class="col-xl-6">
            
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="/garage/serviceTicket/{{ $ticket->id }}"><button type="button" class="btn btn-success btn-sm" >View Service Ticket</button>
        </div>

        @if($ticket->status == 3)
        <div class="col">
            <a href="/completedServiceTicket/{{ $ticket->id }}"><button type="button" class="btn btn-success btn-sm" >Print Ticket</button>
        </div>
        @endif
        
    </div>
</li>
@endforeach
@else
<li class="list-group-item mb-2 bg-success">
<div class="row">
<div class="col-xl-12">
    <h2>  No Service Tickets Active </h2>
</div>
</div>
</li>
@endif


