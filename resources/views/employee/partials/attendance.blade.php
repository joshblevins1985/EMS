<div class="col-lg-5 mb-4 align-items-stretch">
    <!--Panel-->
    <div class="card card-personal mb-4">
        <div class=" card-header elegant-color white-text">
            Attendance
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="list-group">
                    @foreach($employees->attendance as $row)
                        <a href="/compliance/{{$row->id}}"
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-2 h5">
                                    {{$row->type->label}}
                                </h5>
                                <small>{{date('m-d-Y', strtotime($row->date))}}</small>
                            </div>
                            <p class="mb-2"></p>

                        </a>
                    @endforeach
                </div>

            </div>

        </div>
        <div class="card-footer text-muted elegant-color white-text">
            <p class="mb-0">Total Encounters: {{count($employees->employeeencounters)}}</p>
        </div>
    </div>
    <!--/.Panel-->
</div>