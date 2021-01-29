<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalOrientationDates" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee Orientation File</p>
            </div>

            <!--Body-->
            <div class="modal-body">

                <!--Panel-->
                <div class="card ">
                    <div class=" card-header elegant-color-dark white-text">
                        Orientation Dates
                    </div>
                    <div class="card-body">
                        <!-- Card -->
                        <div class="card card-cascade">

                            <!-- Card image -->
                            <div class="view view-cascade gradient-card-header elegant-color-dark">

                                <!-- Title -->
                                <h2 class="card-header-title mb-3">Employee Orientation</h2>


                            </div>

                            <!-- Card content -->
                            <div class="card-body card-body-cascade text-center">

                                <!-- Text -->
                                <div class="row">
                                    {!! Form::open(['url' => route('orientation.update', $employees->id), 'method' => 'POST']) !!}
                                    @method('PUT')

                                    <div class="md-form">
                                        <input placeholder="Didactic Start" type="text" @if($employees->orientation_start_date === NULL) @else data-value="{{date('Y-m-d',strtotime($employees->orientation_start_date))}}" @endif id="didactic_start_date" name="didactic_start_date" class="form-control datepicker">
                                        <label for="date">Didactic Start</label>
                                    </div>

                                    <div class="md-form">
                                        <input placeholder="Didactic End" type="text" @if($employees->orientation_end_date === NULL) @else data-value="{{date('Y-m-d',strtotime($employees->orientation_end_date))}}" @endif id="didactic_end_date" name="didactic_end_date" class="form-control datepicker">
                                        <label for="date">Didactic End</label>
                                    </div>

                                    <div class="md-form">
                                        <input placeholder="FTO Start" type="text" @if($employees->fto_start_date === NULL) @else data-value="{{date('Y-m-d',strtotime($employees->fto_start_date))}}" @endif name="fto_start_date" class="form-control datepicker">
                                        <label for="date">FTO Start</label>
                                    </div>

                                    <div class="md-form">
                                        <input placeholder="FTO End" type="text" @if($employees->fto_end_date === NULL) @else data-value="{{date('Y-m-d',strtotime($employees->fto_end_date))}}" @endif id="fto_end_date" name="fto_end_date" class="form-control datepicker">
                                        <label for="date">FTO End End</label>
                                    </div>




                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer text-muted elegant-color-dark white-text">
                        <p class="mb-0"></p>
                    </div>
                </div>
                <!--/.Panel-->

            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <button type="submit" class="btn btn-primary">Update Orientation File</button>
                {!! Form::close() !!}
                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->