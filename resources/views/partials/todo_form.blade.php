<!--Attandance Model-->
<div class="modal fade right" id="newTodoModal" tabindex="-1" role="dialog" aria-labelledby="todoModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fluid modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="todoModalLabel">My Todo List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'todo.store', 'id' => 'badrunsheets-form']) !!}

                <!--Textarea with icon prefix-->
                <div class="md-form">
                    <i class="fas fa-pencil-alt prefix"></i>
                    <textarea id="task" name="task" class="md-textarea form-control" rows="3"></textarea>
                    <label for="task">Task to be Completed.</label>
                </div>

                <div class="md-form">
                    <input placeholder="Selected date" type="text" id="expected_complete" name="expected_complete" class="form-control datepicker">
                    <label for="expected_complete">Date to be Completed</label>
                </div>

                <select class="mdb-select md-form" name="assigned_to">
                    <option value="" disabled selected>Choose employee to assign to.</option>
                    @foreach($employee as $row)
                    <option value="{{$row->user_id}}" @if(auth()->User()-> id == $row->user_id) selected @endif>{{$row->first_name}} {{$row->last_name}}</option>
                    @endforeach
                </select>

                <select class="mdb-select md-form" name="department">
                    <option value="" disabled selected>Choose employee to assign to.</option>
                    
                    <option value="1" selected>Education</option>
                    <option value="2" >Administration</option>
                    <option value="3" >Dispatch</option>
                    <option value="4" >Logistics</option>
                    <option value="5" >Scheduling</option> 
                    <option value="6" >Web Development</option> 
                    <option value="7" >IT Department</option> 
                    
                </select>

                <button class="btn btn-info btn-block my-4" type="submit">Add Report</button>

                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>