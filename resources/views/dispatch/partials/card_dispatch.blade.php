@foreach($active->where('status','<', 4)->where('status', '>', 0) as $row)
<div class="col-lg-12">
       <div draggable="true" data-uuid="100" class="card">
      <div class="card-body">
          <div class="row">
              <div class="col-lg-4">
                  <strong>Incident #:{{$row->incident_number}}</strong>
              </div>
              <div class="col-lg-4">
                  <strong>{{$row->type->description or 'Unknown'}}</strong>
              </div>
          </div>
            <div class="row">
                <div class="col-lg-1">
                    <i class="fas fa-ambulance fa-5x" style="color:red"></i>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-2">
                            <strong>Pick Up</strong>
                        </div>
                        <div class="col-lg-10">
                            {{ucwords($row->facility_id or '')}} - {{ucwords($row->incident_address)}} {{ucwords($row->incident_city)}} {{ucwords($row->incident_state)}} {{$row->incident_zip}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <strong>Drop Off</strong>
                        </div>
                        <div class="col-lg-10">
                            @if($row->desitination_facility_id)
                            {{$row->desitination_facility_id or ''}} - {{ucwords($row->destination_address) }} {{ucwords($row->destination_city)}} {{ucwords($row->destination_state)}} {{$row->destination_zip}}
                            @elseif($row->destination_address)
                            {{ucwords($row->destination_address) }} {{ucwords($row->destination_city)}} {{ucwords($row->destination_state)}} {{$row->destination_zip}}
                            @else
                            Destination yet to be determined
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <strong>Notes</strong>
                        </div>
                        <div class="col-lg-10">
                            @if($row->notes)
                            <ul class="list-group list-group-flush">
                            @foreach($row->notes as $note)
                                <li class="list-group-item">{{$note->note}}</li>
                            @endforeach
                        @else
                            <li class="list-group-item">No Notes to Display</li>
                        @endif
                        </ul>
                        </div>
                    </div>
                   
                </div>
                <div class="col-lg-2">
                    <div class="row">
                        Notifications
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <a data-toggle="modal" data-target="#modalSendMessage" data-unit="{{$row->unit or ''}}"><h5><span class="badge badge-warning"><i class="far fa-comments"></i> Send Message</span></h5></a>
                            
                        </div>
                        <div class="col-lg-12">
                            <strong>Unit Crew Members</strong>
                        </div>
                        <div class="col-lg-12">
                            John Doe <br> (740) 354-3122
                        </div>
                        <div class="col-lg-12">
                            John Doe <br> (740) 354-3122
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-lg-12">
                     <div class="row">
                        <div class="col-lg-1">
                            <strong>P/U</strong>
                        </div>
                        <div class="col-lg-1">
                            <strong>DISP</strong>
                        </div>
                        <div class="col-lg-1">
                            <strong>ACK</strong>
                        </div>
                        <div class="col-lg-1">
                            <strong>ENR</strong>
                        </div>
                        <div class="col-lg-1">
                            <strong>O/S</strong>
                        </div>
                        <div class="col-lg-1">
                            <strong>TXP</strong>
                        </div>
                        <div class="col-lg-1">
                            <strong>ARRIVE</strong>
                        </div>
                        <div class="col-lg-1">
                            <strong>CLEAR</strong>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            @if($row->pick_up)
                            {{ Carbon\Carbon::parse($row->pick_up)->format('H:i') }}
                            @else
                                @if($row->mark->dispatched)
                                {{ Carbon\Carbon::parse($row->mark->dispatched)->format('H:i') }}
                                @else
                                <a href="/dispatch/status/{{$row->unit}}/99/{{$row->id}}" class="status"><i class="far fa-clock"></i></a>
                                @endif
                            @endif
                        </div>
                        @if($row->mark)
                        <div class="col-lg-1">
                            @if($row->mark->dispatched)
                            {{ Carbon\Carbon::parse($row->mark->dispatched)->format('H:i') }}
                            @else
                            <a href="/dispatch/status/{{$row->unit}}/99/{{$row->id}}" class="status"><i class="far fa-clock"></i></a>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            @if($row->mark->unit_acknowledged)
                            {{ Carbon\Carbon::parse($row->mark->unit_acknowledged)->format('H:i') }}
                            @else
                            <a href="/dispatch/status/{{$row->unit}}/99/{{$row->id}}" class="status"><i class="far fa-clock"></i></a>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            @if($row->mark->enroute)
                            {{ Carbon\Carbon::parse($row->mark->enroute)->format('H:i') }}
                            @else
                            <a href="/dispatch/status/{{$row->unit}}/4/{{$row->id}}" class="status"><i class="far fa-clock"></i></a>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            @if($row->mark->atscene)
                            {{ Carbon\Carbon::parse($row->mark->atscene)->format('H:i') }}
                            @else
                            <a href="/dispatch/status/{{$row->unit}}/5/{{$row->id}}" class="status"><i class="far fa-clock"></i></a>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            @if($row->mark->transporting)
                            {{ Carbon\Carbon::parse($row->mark->transporting)->format('H:i') }}
                            @else
                            <a data-toggle="modal" data-target="#modalTransport" data-id="{{$row->id}}" class="show_modal"><i class="far fa-clock"></i></a>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            @if($row->mark->arrived)
                            {{ Carbon\Carbon::parse($row->mark->arrived)->format('H:i') }}
                            @else
                            <a href="/dispatch/status/{{$row->unit}}/7/{{$row->id}}" class="status"><i class="far fa-clock"></i></a>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            @if($row->mark->available)
                            {{ Carbon\Carbon::parse($row->mark->available)->format('H:i') }}
                            @else
                            <a href="/dispatch/status/{{$row->unit}}/98/{{$row->id}}" class="status"><i class="far fa-clock"></i></a>
                            @endif
                        </div>
                        @else
                        <div class="col-lg-7">
                            No Times Available
                        </div>
                        @endif

                    </div>
                 </div>
            </div>
      </div>
    </div>    
</div>

@endforeach

<script>
    $(".status").click(function (e) {
        e.preventDefault();
        var anchorValue= $(this).attr("href");
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    
    
    $.ajax({
      type: "GET",
      url: anchorValue,
      
    }).done(function( msg ) {
      alert( "Stuatus Updated: " + msg );
    });
    });
</script>
