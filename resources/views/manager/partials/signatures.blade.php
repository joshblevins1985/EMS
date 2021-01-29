<!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body elegant-color white-text">
                        <!--Title-->
                        <h4 class="card-title">Driving Evaluation Signatures Needed</h4>
                        <!--Text-->
                        <div class="list-group">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Employee</th>
                                        <th>Score</th>
                                        <th>View Report</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($signatures as $row)
                                    <tr>
                                        <td>{{date('m-d-Y', strtotime($row->date_of_evaluation))}}</td>
                                        <td>{{$row->employee->first_name or 'unk'}} {{$row->employee->last_name or 'unk'}}</td>
                                        <td>{{$row->performance_rating}}%</td>
                                        <td><a href="/driveassessment/{{$row->id}}" style="color:red">View Report</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
 

                    </div>

                </div>
                <!--/.Card-->