<!-- Modal -->
<div class="modal fade" id="courseDates" tabindex="-1" role="dialog" aria-labelledby="courseDates"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudent">Add New Course Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('course_dates.store') }}" method="POST">
                    {{csrf_field()}}

                    <input type="hidden" name="class_id" value="{{$class->id}}">

                    <div class="md-form">
                        <input placeholder="Date of Completion" type="text" id="date" name="date"
                               class="form-control datepicker">
                        <label for="date">Class Date</label>
                    </div>

                    <div class="md-form">
                        <input placeholder="Selected time" type="text" name="start_time" id="input_starttime"
                               class="form-control timepicker">
                        <label for="input_starttime">Start Time</label>
                    </div>

                    <div class="md-form">
                        <input placeholder="Selected time" type="text" name="end_time" id="input_endtime"
                               class="form-control timepicker">
                        <label for="input_endtime">End Time</label>
                    </div>
                    
                    <select class="mdb-select" id="instructor" name="instructor" searchable="Search here.." >
                                <option value="" disabled selected>Choose Instructor</option>
                                @foreach($employees as $id => $employee_name)
                                    <option value="{{$id}}" >{{$employee_name}}</option>
                                @endforeach
                            </select>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-primary">Add New Course Date to Course</button>

                </form>
            </div>
        </div>
    </div>
</div>