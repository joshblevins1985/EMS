
    <!--Panel-->
    <div class="card text-center"">
    <div class=" card-header primary-color white-text">
        Courses Completed Today
    </div>
    <div class="card-body">
        <div class="list-group">
        @if($courses)
            @foreach($courses as $row)
            
            
                        <?php
                              
                 $cert = '/certificate/'.$row->classesfrom->id.'/'.$row->employee->user_id; 
                 
                 $eu = Vanguard\EnrolledStudent::where('class_id', $row->course_id)->where('user_id', $row->user_id)->first();
                 
                 $start = strtotime($eu->created_at); 

                $end = strtotime($eu->completed); 
                
                $totaltime = ($end - $start)  ; 
                
                $hours = intval($totaltime / 3600);   
                $seconds_remain = ($totaltime - ($hours * 3600)); 
                
                $minutes = intval($seconds_remain / 60);   
                $seconds = ($seconds_remain - ($minutes * 60)); 
                
                if($row->classesfrom->course->video_time > $minutes){
                    $color = "bg-warning";
                }else{
                    $color = "";
                }
                
                
 ?>

                <a href="{{$cert or ''}}" class="list-group-item list-group-item-action flex-column align-items-start {{$color or ''}}">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-2 h5">{{$row->employee->last_name or ''}}, {{$row->employee->first_name or ''}}</h5>
                        <small>{{  Carbon\Carbon::parse($row['created_at'])->diffForHumans(Carbon\Carbon::now()) }}</small>
                    </div>
                    <p class="mb-2">Has completed the course {{$row->classesfrom->course->title or ''}}</p>
                    <p class="mb-2">{{$minutes or ''}}</p>
                    <small>Print Certificate Now</small>
                </a>
            @endforeach
        @endif
            
        </div>
    </div>
    <div class="card-footer text-muted primary-color white-text">

    </div>
</div>
<!--/.Panel-->
