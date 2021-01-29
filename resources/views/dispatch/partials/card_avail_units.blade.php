@foreach($units as $row)
    <div class="col-lg-12">
        <blockquote class="blockqoute {{$row->care->color}}">
    <div  class="card">
        <div class="card-body ">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <a draggable="true" id="unitClick" data-uuid="{{$row->id}}" data-title="Unit History for {{$row->care->level}} - {{$row->u->unit_number}}" data-toggle="modal" data-target="#unitModal">  <h1>{{$row->care->abbreviation}} - {{$row->u->unit_number}}</h1> </a>
                    </div>
                    <div class="row">
                <div class="col-lg-12">
                   <h2><span class="badge badge-pill badge-success">UHU: 0.60</span></h2>
                </div>
            </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        @if($row->status == 0)
                            <a data-toggle="modal" data-target="#unitstatusModal" data-unit="{{$row->id}}" data-status="1" data-message="inspecting unit." data-call="{{$row->care->abbreviation}} - {{$row->u->unit_number}}"><div class="{{$row->stat->color}}">{{$row->stat->description}}</div></a>
                        @elseif($row->status == 1)
                            <a data-toggle="modal" data-target="#unitstatusModal" data-unit="{{$row->id}}" data-status="2" data-message="available" data-call="{{$row->care->abbreviation}} - {{$row->u->unit_number}}"><span class="{{$row->stat->color}}" >Pre-Inspection</span></a>
                        @elseif($row->status == 2)
                        <div class="col-lg-6">
                            <div class="{{$row->stat->color}}">{{$row->stat->description}}</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class"col-lg-12">
                                    <span class="badge badge-info">Add Note</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class"col-lg-12">
                                    <span class="badge badge-danger">Mark O.O.S</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class"col-lg-12">
                                    <span class="badge badge-dark">Mark Clean Up</span>
                                </div>
                            </div>
                            
                        </div>
                        @elseif($row->status == 3)
                            <span class="{{$row->stat->color}}">{{$row->stat->description}}</span>
                        @elseif($row->status == 4)
                            <span class="{{$row->stat->color}}">{{$row->stat->description}}</span>
                        @elseif($row->status == 5)
                            <span class="{{$row->stat->color}}">{{$row->stat->description}}</span>
                        @elseif($row->status == 6)
                            <span class="{{$row->stat->color}}">{{$row->stat->description}}</span>
                         @elseif($row->status == 7)
                            <span class="{{$row->stat->color}}">{{$row->stat->description}}</span>
                         @elseif($row->status == 8)
                            <span class="{{$row->stat->color}}">{{$row->stat->description}}</span>
                         @elseif($row->status == 9)
                            <span class="{{$row->stat->color}}">{{$row->stat->description}}</span>
                            @elseif($row->status == 99)
                            <span class="{{$row->stat->color}}">{{$row->stat->description}}</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-3">
                    @foreach($row->crew as $emp)
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    
                    $punch = Vanguard\timepunch::where('employee_id', $emp->employee->user_id)->where('schedule_id', $emp->id)->first();
                    ?>
                   @if($punch)
                   <span class="green-text">{{substr($emp->employee->first_name, 0, 1)}}.{{$emp->employee->last_name}} {{ Carbon\Carbon::parse($punch->time_in)->format('H:i') }}</span> 
                   @else
                   <span class="red-text">{{substr($emp->employee->first_name, 0, 1)}}.{{$emp->employee->last_name}}</span>
                   @endif
                </div>
            </div>
            @endforeach
                </div>
                
                <div class="col-lg-3">
                    <ul class="list-group list-group-flush">
                      
                      @foreach($row->unit_notes as $un)
                            <li class="list-group-item">{{$un->note}}</li>
                        @endforeach
                    </ul>
                        
                </div>
                
            </div>
            

            
            
        </div>
    </div>
    </blockquote>
</div>
@endforeach



