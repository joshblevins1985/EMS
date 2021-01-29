<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalFieldDates" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee Field Training Date</p>
            </div>

            <!--Body-->
            <div class="modal-body">

                <!--Panel-->
                <div class="card ">
                    <div class=" card-header elegant-color-dark white-text">
                        Add Field Training Date
                    </div>
                    <div class="card-body">
                        <!-- Card -->
                        <div class="card card-cascade">

                            <!-- Card image -->
                            <div class="view view-cascade gradient-card-header elegant-color-dark">

                                <!-- Title -->
                                <h2 class="card-header-title mb-3">Employee Field Training Date</h2>


                            </div>

                            <!-- Card content -->
                            <div class="card-body card-body-cascade text-center">

                                <!-- Text -->
                                <div class="row">
                                    {!! Form::open(['route' => 'orientation.store', 'id' => 'badrunsheets-form']) !!}
                                        
                                        <input type="hidden" name="rid" value="{{$employees->id}}">
                                        <input type="hidden" name="eid" value="{{$employees->user_id}}">
                                        <div class="md-form">
                                            <input placeholder="Training Date" type="text" id="date" name="date" class="form-control datepicker">
                                            <label for="date">Training Date</label>
                                        </div>

                                        <div class="md-form">
                                            <input type="text" id="hours" name="hours" class="form-control">
                                            <label for="hours">Total Hours</label>
                                        </div>

                                        <select class="mdb-select md-form" id="user_id" name="user_id" searchable="Search here.." >
                                            <option value="" disabled selected>Choose Level</option>
                                            @foreach($employee_level as $level)
                                            <option value="{{$level->id}}" @if($employees->primary_position == $level->id) selected  @endif>{{$level->label}}</option>
                                            @endforeach
                                        </select>

                                        <select class="mdb-select md-form" id="training_officer" name="training_officer" searchable="Search here.." >
                                            <option value="" disabled selected>Choose Employee</option>
                                            @foreach($ftos as $id => $employee_name)
                                            <option value="{{$id}}" >{{$employee_name}}</option>
                                            @endforeach
                                        </select>
                                        
                                        <select class="mdb-select md-form" id="type" name="type" searchable="Search here.." >
                                            <option value="" disabled selected>Choose Orientation Type</option>
                                            
                                            <option value="1" >Field Orientation</option>
                                            <option value="2" >Drivers Orientation</option>
                                            <option value="3" >Increased Level</option>
                                            
                                        </select>

                                        <div class="switch">
                                            <label>
                                                Incomplete
                                                <input type="checkbox" name="complete" value="1">
                                                <span class="lever"></span> Complete
                                            </label>
                                        </div>


                                </div>
                            </div>

                        </div>

                    </div>
                 
                </div>
                <!--/.Panel-->

            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <button type="submit" class="btn btn-primary">Add Field Training Date </button>
                {!! Form::close() !!}
                
                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->