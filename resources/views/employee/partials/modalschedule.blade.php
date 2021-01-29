<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleSchedule"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee Scheduled Shifts</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                <button type="button" data-toggle="modal" data-target="#modalScheduleDate" class="btn primary-color btn-lg btn-block">Add Schedule Date</button>
                <!--Panel-->
                <div class="card ">
                    <div class=" card-header primary-color-dark white-text">
                        Scheduled Shifts
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Unit / Department</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$schedule)
                                    <tr>
                                        <td colspan="3"> No Scheduled Dates </td>
                                    </tr>
                                    @else
                                    @foreach($schedule as $row)
                                    <tr>
                                    <td>{{ Carbon\Carbon::parse($row->sin)->format('m-d-Y H:i') }}</td>
                                    <td>{{ Carbon\Carbon::parse($row->sout)->format('m-d-Y H:i') }}</td>
                                    <td>{{$row->location->unit_number or ''}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <div class="card-footer text-muted primary-color-dark white-text">
                        <p class="mb-0"></p>
                    </div>
                </div>
                <!--/.Panel-->

            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">

                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->