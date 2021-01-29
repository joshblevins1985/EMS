<div class="modal fade" id="qaModal" tabindex="-1" role="dialog" aria-labelledby="qaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qaModalLabel">Recent Quality Assurance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            @if(!count($qa))
            @else
                <!--Card-->
                    <div class="card">
                        <!--Card content-->
                        <div class="card-body elegant-color white-text">
                            <!--Title-->
                            <h4 class="card-title">Recent Quality Assurance</h4>
                            <!--Text-->
                            <div class="list-group">


                                @foreach($qa as $row)
                                    <a href="qaqi/{{$row->id}}"
                                       class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-2 h5">{{date('m-d-Y', strtotime($row->date))}}</h5>
                                            <small></small>
                                        </div>
                                        <p class="mb-2">{!!substr($row->comments, 0, 200)!!}</small>

                                        <p class="mb-2">@if(!$row->acknowledged) <span class="badge badge-danger">Please click to review and sign the qa report.</span>@else
                                                You have signed and acknowledged this QaQi report. Thank
                                                you @endif</small>
                                    </a>
                                @endforeach

                            </div>
                            {{$qa->links("pagination::bootstrap-4")}}
                            <small>Items displayed here are from quality assurance reviews completed on your patient
                                care documents. You may click a review to see more detailed information.
                            </small>
                        </div>

                    </div>
                    <!--/.Card-->
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>