<!-- begin panel -->
<div class="panel" data-sortable-id="index-3">
    <div class="panel-heading">
        <h4 class="panel-title">Course Students</h4>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
    </div>
    <div id="schedule-calendar" class="bootstrap-calendar"></div>
    <div class="list-wrapper" >
        <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom" id="myUL">
            @if($classroom->students)
        @foreach($classroom->students as $row)
        @if($row->user_id)
            
            
            <li><a href="@if($row->completed) /classroom/certificate/{{ $row->id }} @else javascript:; @endif" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-ellipsis">
        
                {{$row->employee->last_name}}, {{$row->employee->first_name}}
                <span class="badge badge-success">Enrolled</span>
    
            </a></li>
    
           
        @else
            
            
            <li ><a data-toggle="modal" data-target="#modalConnectEmployee" data-id="{{ $row->id }}" class="list-group-item-action d-flex justify-content-between align-items-center text-ellipsis">
        
                {{$row->temp_name}}
                <span class="badge badge-danger">No User</span>
    
            </a></li>
            
           
        @endif
        @endforeach
         @else
            <li class="list-group-item"><a href="javascript:" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-ellipsis">
                No Students Enrolled in Course
                
            </a></li>
            @endif 
        </ul>
       
    
        
    </div>
</div>
<!-- end panel -->

<script>
function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
      txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>