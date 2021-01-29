@if(!$courses)
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">No Lessons available for this course at this time.</h5>
      
    </div>
    <p class="mb-1">{{$course->description}}</p>
    
  </a>
  <hr>
@else
<div class="list-group">
    @foreach($courses as $course)
  <a href="courses/{{$course->id}}" class="list-group-item list-group-item-action flex-column align-items-start ">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">{{$course->course->title}}</h5>
      <small>@if(!$course->employeepositions) Level: Unknown @else Level: {{$course->employeepositions->label}} @endif</small>
    </div>
    </a>
  <hr>
  @endforeach
</div>
@endif