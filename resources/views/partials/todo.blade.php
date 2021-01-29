<!--Attandance Model-->
    <div class="modal fade right" id="todoModal" tabindex="-1" role="dialog" aria-labelledby="todoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fluid modal-full-height modal-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="todoModalLabel">My Todo List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <!--Card-->
        <div class="card">
            
            

            <!--Card content-->
            <div >
                <ul class="list-group">

    
    <a class="dropdown-item" data-toggle="modal" data-target="#newTodoModal">
        <i class="fas fa-sign-out-alt text-muted mr-2"></i>
        Add New Task
    </a>
    <div class="dropdown-divider"></div>



    @foreach($todo as $row)
    
        <li class="list-group-item" @if($row->status == 2) style= "background: orange" @endif>
            <div class="row">
                
                    @if(date('Y-m-d') > $row->expected_complete)
                    <div class="col-lg-2">
                        <i class="fas fa-exclamation-circle red-text"></i>
                    </div>
                    @endif
                    
                    @if(date('Y-m-d') == $row->expected_complete)
                    <div class="col-lg-2">
                        <i class="fas fa-calendar-day text-warning"></i>
                    </div>
                    @endif
                
                <div class="col-lg-10">
                    {!!$row->task!!}
                </div>
                <div class="row">
                <div class="col-lg-12 text-center">
                   <strong>Due: {{Carbon\Carbon::parse($row->expected_complete)->diffForHumans()}}</strong> 
                </div>
            </div>
                </div>
                <div class="row">
                    @if($row->notes)
                    @foreach($row->notes as $nrow)
                    <div class="col-lg-3">
                        {{ Carbon\Carbon::parse($nrow->created_at)->format('m-d') }} 
                    </div>
                    <div class="col-lg-9">
                        {!! $nrow->note !!}
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class ="row">
                   <div class="col-lg-1">
                   
                       <a data-toggle="modal" data-target="#newTodoNoteModal" data-tid="{{$row->id}}"><i class="far fa-sticky-note"></i></a>
                   
                
                </div>
                <div class="col-lg-1">
                   
                       <a href='#'><i class="far fa-edit"></i></a>
                   
                
                </div>
                <div class="col-lg-1">

                   <a href="/task/active/{{$row->id}}"><span class="green-text"><i class="fal fa-snowboarding"></i></span></a>
                
                </div> 
                <div class="col-lg-1">

                   <a href="/task/complete/{{$row->id}}"><span class="green-text"><i class="fas fa-check-double"></i></span></a>
                
                </div> 
                </div>
                
            
            
                
        </li>
        <hr>
   
    @endforeach
    
            </ul>
    <!--
    @foreach(auth()->user()->readNotifications as $notification)
        <a class="dropdown-item" href="#">
            {{$notification->data['data']}}
        </a>
    @endforeach
    -->
</div>

        </div>
        <!--/.Card-->
      </div>
    
    </div>
  </div>
</div>