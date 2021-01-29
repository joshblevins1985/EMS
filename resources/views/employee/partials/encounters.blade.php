<div class="col-lg-5 align-items-stretch">
    <!--Panel-->
    <div class="card card-personal mb-4">
        <div class=" card-header elegant-color white-text">
            Encounters
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="list-group">
                    @foreach($employees->employeeencounters as $row)
                        <a href="/compliance/{{$row->id}}"
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-2 h5">
                                    @if($row->encounter_type == 1)
                                        File Notation
                                    @elseif($row->encounter_type == 2)
                                        Corrective Counciling
                                    @elseif($row->encounter_type == 3)
                                        Verbal Warning
                                    @elseif($row->encounter_type == 4)
                                        Written Warning
                                    @elseif($row->encounter_type == 5)
                                        Suspension
                                    @elseif($row->encounter_type == 6)
                                        Termination
                                    @endif
                                </h5>
                                <small>{{date('m-d-Y', strtotime($row->doi))}}</small>
                            </div>
                            <p class="mb-2">{{$row->policies->title or 'Unknown'}}</p>

                        </a>
                    @endforeach
                </div>

            </div>

        </div>
        <div class="card-footer text-muted elegant-color white-text">
            <p class="mb-0">Total Occurances: {{count($employees->employeeencounters)}}</p>
        </div>
    </div>
    <!--/.Panel-->
</div>