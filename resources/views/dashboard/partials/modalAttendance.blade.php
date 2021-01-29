

<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModalLabel">Current Quarter Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <div class="card-body elegant-color white-text">
                        <!--Title-->
                        <h4 class="card-title">Current Quarter Attendance</h4>
                        <!--Text-->
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Infraction</th>
                                <th>Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!count($attend))
                                <tr>
                                    <td colspan="2">No Attendance Infractions</td>
                                </tr>
                            @else
                                @foreach($attend as $row)
                                    <tr>
                                        <td>{{date('m-d-Y', strtotime($row->date))}}</td>
                                        <td>{{$row->type->label or 'Unknown'}}</td>
                                        <td>{{$row->type->points}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="progress md-progress" style="height: 20px">
                            <div class="progress-bar" role="progressbar" style="width: {{$percent}}%; height: 20px"
                                 aria-valuenow="1" aria-valuemin="0" aria-valuemax="7"></div>
                        </div>
                        <small>This progress bar shows a count of your current attendance record for this quarter. When
                            100% is reached you are ineligibleble for the quarterly bonus. If you feel this information
                            is inaccurate contact compliance as soon as possible.
                        </small>
                    </div>

                </div>
                <!--/.Card-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>