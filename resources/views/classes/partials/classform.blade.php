@csrf
<div class="row">
    <div class="col-lg-12">
        <select class="mdb-select md-form" name="course_id">
            <option value="" disabled selected>Choose course being instructed.</option>
            @foreach($courses as $row)
            <option value="{{$row->id}}" @if($edit) @if($row->id == $class->course_id ) selected @endif @endif >{{$row->title}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-sm-12">
        <div class="md-form">
            <input type="text" id="recert" name="recert" class="form-control">
            <label for="location">Recert Year </label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <select class="mdb-select md-form" name="instructor" searchable="Search Instructor">
            <option value="" disabled selected>Choose Primary Instructor</option>
            @foreach($instructors as $row)
            <option value="{{$row->user_id}}" @if($edit) @if($row->user_id == $class->insturctor ) selected @endif @endif >{{$row->last_name}}, {{$row->first_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4 col-sm-12">
        <select class="mdb-select md-form colorful-select dropdown-primary" name="level[]" multiple searchable="Search Here">
            <option value="" disabled selected>Choose Base Level for Course </option>
            @foreach($levels as $row)
            <option value="{{$row->id}}"  >{{$row->label}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-sm-12">
        <div class="md-form">
            <input placeholder="Selected date" type="text" id="start" name="start" class="form-control datepicker" value=@if($edit) {{$class->start}} @endif>
            <label for="start">Start Date</label>
        </div>
    </div>
    <div class="col-lg-3 col-sm-12">
        <div class="md-form">
            <input placeholder="Selected date" type="text" id="end" name="end" class="form-control datepicker" value=@if($edit) {{$class->end}} @endif>
            <label for="end">Start Date</label>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <!-- Material unchecked -->
        <div class="form-check">
            <input type="radio" class="form-check-input" id="check1" name="type" value="O" @if($edit) @if($class->type == "O" ) checked @endif @endif >
            <label class="form-check-label" for="check1">Online</label>
        </div>

        <div class="form-check">
            <input type="radio" class="form-check-input" id="check2" name="type" value="C" @if($edit) @if($class->type == "C" ) checked @endif @endif>
            <label class="form-check-label" for="check2">Class Room</label>
        </div>

        <div class="form-check">
            <input type="radio" class="form-check-input" id="check3" name="type" value="H" @if($edit) @if($class->type == "H" ) checked @endif @endif>
            <label class="form-check-label" for="check3">Hybrid</label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <select class="mdb-select md-form" name="status">
            <option value="" disabled selected>Select the status of the course.</option>

            <option value="1" @if($edit) @if($class->status == 1 ) selected  @endif @endif>Open</option>
            <option value="2" @if($edit) @if($class->status == 2 ) selected  @endif @endif>Closed</option>

        </select>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-sm-12">
        <!-- Material input -->
        <div class="md-form">
            <input type="text" id="location" name="location" class="form-control" value=@if($edit) {{$class->location}} @endif>
            <label for="location">Location of Course </label>
        </div>

    </div>
    <div class="col-lg-4 col-sm-12">
        <!-- Material unchecked -->
        <div class="form-check">
            <input type="radio" class="form-check-input" id="required1" name="required" value="1" @if($edit) @if($class->required == 1 ) checked  @endif @endif>
            <label class="form-check-label" for="required1">Required Training</label>
        </div>

        <div class="form-check">
            <input type="radio" class="form-check-input" id="required2" name="required" value="2" @if($edit) @if($class->required == 2 ) checked  @endif @endif>
            <label class="form-check-label" for="required2">Not Required</label>
        </div>
    </div>
</div>

<button class="btn btn-primary btn-block my-4" type="submit">Add New Class</button>