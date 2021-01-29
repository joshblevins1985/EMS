<!--<div class="list-group">-->
<!--    @foreach($lessons as $lesson)-->
<!--  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">-->
<!--    <div class="d-flex w-100 justify-content-between">-->
     
<!--     <div class="col-8"> <h5 class="mb-1">{{$lesson->title}}</h5></div>-->
    
<!--    <div class"col-4"> @if(!$lesson->content) @else<button type="button" class="btn btn-sm btn-primary" onClick="document.getElementById('display').src='{{$lesson->content}}'">Play Lesson</button>@endif</div>-->
    
<!--    </div>-->
<!--    <div class="col-12"><p class="mb-1">{{$course->description}}</p></div>-->
    
<!--  </a>-->
<!--  <hr>-->
  

<!--  <hr>-->
<!--  @endforeach-->
<!--</div>-->

<div class="list-group">
    @foreach($lessons as $lesson)
    <?php 
        $status=DB::table('lesson_log')
                    ->where('lesson_id','=',$lesson->id)
                    ->where('user_id','=',Auth::user()->id)
                    ->first();
    ?>
   
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
        <div class="d-flex w-100 justify-content-between">
         <div class="col-6"> <h5 class="mb-1">{{$lesson->title}}</h5></div>
         <div class="col-2"> 
         @if (!$status)
          
          @else
            <span class="badge badge-success" style="margin:10px; height:20px; margin-top:12px">{{ Carbon\Carbon::parse($status->created_at)->format('m-d-Y H:i') }} </span>
          @endif
         </div>
          @if (!$status)
            <span class="badge badge-danger" id="{{'lesson_complate_id'.$lesson->id}}" data-id="{{$lesson->id}}" style="margin:10px; height:20px; margin-top:12px">Incomplete </span>
          @else
            <span class="badge badge-success" id="{{'lesson_complate_id'.$lesson->id}}" data-id="{{$lesson->id}}" style="margin:10px; height:20px; margin-top:12px">Completed </span>
          @endif
         <div class"col-4"> @if(!$lesson->content) @else<button type="button" class="btn btn-sm btn-primary" data-id="{{$lesson->id}}" onClick="document.getElementById('display').src='{{$lesson->content}}?api=1&player_id=display'">Play Lesson</button>@endif</div>
        
        </div>
        
  </a>
    
  
    
  <hr>
  <hr>
  @endforeach
</div>