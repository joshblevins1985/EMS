

<select class="mdb-select" id="employee" name="employee" searchable="Search Employee">
    <option value="" disabled selected>Choose Mechanic to Assign</option>
    @foreach($mechanics as $option)
    <option value="{{$option->user_id}}" @if($edit == false) @elseif($option->user_id == $task->mechanic_assigned) selected   @endif > {{$option->last_name.', '.$option->first_name}}</option>
    @endforeach
</select>


<div class="md-form">
    <input placeholder="Expected Start Date" type="text" @if(!$task->anticipated_start_date) @else data-value="{{date('Y-m-d',strtotime($task->anticipated_start_date))}}"@endif id="anticipated_start_date" name="anticipated_start_date" class="form-control datepicker">
    <label for="anticipated_start_date">Expected Start Date</label>
</div>

<div class="md-form">
    <input placeholder="Expected End Date" type="text" @if(!$task->anticipated_end_date) @else data-value="{{date('Y-m-d',strtotime($task->anticipated_end_date))}}"@endif id="anticipated_end_date" name="anticipated_end_date" class="form-control datepicker">
    <label for="anticipated_end_date">Expected End Date</label>
</div>

<div class="md-form">
    <input placeholder="Actual Start Date" type="text" @if(!$task->start_date) @else data-value="{{date('Y-m-d',strtotime($task->start_date))}}"@endif id="start_date" name="start_date" class="form-control datepicker">
    <label for="start_date">Actual Start Date</label>
</div>

<div class="md-form">
    <input placeholder="Actual End Date" type="text"  @if(!$task->end_date) @else data-value="{{date('Y-m-d',strtotime($task->end_date))}}"@endif id="end_date" name="end_date" class="form-control datepicker">
    <label for="end_date">Actual End Date</label>
</div>



<select class="mdb-select" id="status" name="status" >
    <option value="" disabled selected>Choose your option</option>
    <option value="1" @if($edit == false) @elseif($task->status == 1) selected @endif>Pending</option>
    <option value="2" @if($edit == false) @elseif($task->status == 2) selected @endif>Assigned</option>
    <option value="3" @if($edit == false) @elseif($task->status == 3) selected @endif>Working</option>
    <option value="4" @if($edit == false) @elseif($task->status == 4) selected @endif>Inspection</option>
    <option value="5" @if($edit == false) @elseif($task->status == 5) selected @endif>Completed</option>

</select>
<label>Status</label>

<button class="btn btn-info btn-block my-4" type="submit">Update Task</button>