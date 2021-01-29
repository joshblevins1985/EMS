<!--Card-->
            <div class="card">

                <!--Card content-->
                <div class="card-body elegant-color white-text">
                    <!--Title-->
                    <h4 class="card-title">Employee Encounters for @foreach($station as $row) {{$row['station']}} @endforeach</h4>
                    <!--Text-->
                    <div class="list-group">
                        @foreach($encounters as $row)
                            <a href="#!" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-2 h5">{{date('m-d-Y', strtotime($row->doi))}}</h5>
                                    <small>@if($row->status == 1) Investigation @elseif($row->status == 2)
                                            Contact @elseif($row->status == 3) Admin/Training @elseif($row->status == 4)
                                            Closed @else Unknown @endif</small>
                                            
                                            
                                </div>
                                <small>{!!substr($row->incident_report, 0, 200)!!}</small>
                            </a>
                        @endforeach
                    </div>
                    {{$encounters->links()}}
                    <small>Items displayed here are from encounters entered into the system that require a response or action by the employee.</small>
                </div>

            </div>
            <!--/.Card-->