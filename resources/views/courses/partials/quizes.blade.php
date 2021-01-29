<div class="list-group">
    
    @foreach($quiz as $ql)
  <a  class="list-group-item list-group-item-action flex-column align-items-start " @if($student_data->grade)  style="background: lightgray" @else data-toggle="modal" data-target="#modalQuiz" @endif >
    <div class="d-flex w-100 justify-content-between" >

     <div class="col-lg-8"> <h5 class="mb-1">{{$ql->title}}</h5></div>
    @if($student_data->grade) 
    <div class"col-lg-2">You have completed this assessment with a {{$student_data->grade}} %.</div> 
    @endif
    <div class="col-lg-2">
        @permission('online.instructor.menu')
          <a href="/quiz/{{$ql->id}}" target="_blank"><button type="button" class="btn btn-sm btn-primary"  >Edit Quiz</button></a>
        @endpermission
    </div>
    <div class"col-lg-2"> @if(!$ql->link) @else<a href="{{$ql->link}}" target="_blank"><button type="button" class="btn btn-sm btn-primary"  >Open</button></a>@endif</div>
        
    </div>
    

 </a>
  <hr>


  <hr>
 @endforeach
</div>