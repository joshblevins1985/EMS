<div class="col-lg-6 align-items-stretch">
    <!--Panel-->
    <div class="card ">
        <div class=" card-header primary-color-dark white-text">
            Quality Assuracne Reviews
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="list-group">
                    @foreach($employees->qa as $row)

                        <a href="/qa/pdf/{{$row->id}}"
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-2 h5">
                                    @if($row->grade == 1) Suficient @elseif($row->grade == 2) Insuficient @endif
                                </h5>
                                <small>{{date('m/d/Y', strtotime($row->date))}}</small>
                            </div>


                        </a>
                    @endforeach
                </div>

            </div>

        </div>
        <div class="card-footer text-muted primary-color-dark white-text">
            <p class="mb-0"></p>
        </div>
    </div>
    <!--/.Panel-->
</div>