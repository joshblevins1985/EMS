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
                        </tr>
                        </thead>
                        <tbody>
                        @if(!count($attendance))
                        <tr>
                            <td colspan="2">No Attendance Infractions</td>
                        </tr>
                        @else
                        @foreach($attendance as $row)
                        <tr>
                            <td>{{date('m-d-Y', strtotime($row->date))}}</td>
                            <td>{{$row->type->label}}</td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$attendance->links()}}
                    
                    <small>This progress bar shows a count of your current attendance record for this quarter. When 100% is reached you are ineligable for the quarterly bonus. If you feel this information is inaccurate contact compliance as soon as possible. </small>
                </div>

            </div>
            <!--/.Card-->