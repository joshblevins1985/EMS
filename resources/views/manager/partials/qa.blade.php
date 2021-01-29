<!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body elegant-color white-text">
                        <!--Title-->
                        <h4 class="card-title">Recent Quality Assurance</h4>
                        <!--Text-->
                        <div class="list-group">



                            @foreach($qa as $row)
                                <a href="qaqi/{{$row->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-2 h5">{{date('m-d-Y', strtotime($row->date))}} Authoring Employee: {{$row->employee->first_name}} {{$row->employee->last_name}}</h5>
                                        <small></small>
                                    </div>
                                    <p class="mb-2">{!!substr($row->comments, 0, 200)!!}</small>
                                </a>
                            @endforeach

                        </div>
                        {{$qa->links()}}
                        <small>Items displayed here are from quality assurance reviews completed on your patient care documents. You may click a review to see more detailed information.</small>
                    </div>

                </div>
                <!--/.Card-->