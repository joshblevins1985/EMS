
            <div class="row">
                You are dipatching this unit for: <span id="incident_type"></span>
            </div>
            <div class="row">
                @foreach($units as $row)
                
    <div class="col-lg-12">
        <blockquote class="blockqoute {{$row->care->color}}">
    <div  class="card">
        <div class="card-body ">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <a  id="unitClick" data-uuid="{{$row->id}}" data-title="Unit History for {{$row->care->level}} - {{$row->u->unit_number}}" data-toggle="modal" data-target="#unitModal">  <h3>{{$row->care->abbreviation}} - {{$row->u->unit_number}}</h3> </a>
                    </div>
                    
                
            
                </div>
                <div class="col-lg-3">
                   <h4><span class="badge badge-pill badge-success">UHU: 0.60</span></h4>
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
                   <span class="red-text">{{substr($emp->employee->first_name, 0, 1)}}.{{$emp->employee->last_name}}</span> 
                </div>
            </div>
            @endforeach
                </div>
                
                
                
            </div>
            <div class="row">
                <div class="col-lg-12 list-wrapper">
                    <h3>Unit Notes</h3>
                    <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                      
                      @foreach($row->unit_notes as $un)
                            <li class="">{{$un->note}}</li>
                        @endforeach
                    </ul>
                        
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a href="dispatch/{{$incident->id}}/{{$row->id}}"><div class="chip chip-md info-color-dark white-text">Dispatch Unit</div></a>
                </div>
                
            </div>
        </div>
    </div>
    </blockquote>
</div>

@endforeach




            </div>
           
        