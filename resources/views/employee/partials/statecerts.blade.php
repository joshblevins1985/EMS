<div class="col-lg-6 align-items-stretch">
    <!--Panel-->
    <div class="card ">
        <div class=" card-header primary-color-dark white-text">
            State Certifications
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="list-group">
                    @foreach($employees->statecertifications as $scert)
                        <?php

                        $now = time(); // or your date as well
                        $expiration = strtotime($scert->expiration);
                        $datediff = $now - $expiration;

                        $days= round($datediff / (60 * 60 * 24 * -1));

                        ?>
                        @if($expiration < strtotime("now"))
                                <a href="#"
                                   class="list-group-item list-group-item-action list-group-item-dark flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-2 h5">
                                            {{$scert->states->label or 'Unknown'}}
                                        </h5>
                                        <small>{{date('m-d-Y', strtotime($scert->expiration))}} - {{$scert->certtype->label or 'Unknown'}}</small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <small>{{$scert->certification_number}}</small>
                                        <small>
                                            @if($scert->status == 0) Active - Not Verified @elseif($scert->status == 1) Active - Verified @elseif($scert->status == 2) Pending Expiration @elseif($scert->status == 3) Expired @elseif($scert->status == 4) Not Active / Renewed @endif
                                        </small>

                                    </div>

                                </a>

                        @elseif($expiration > strtotime("now") && $expiration < strtotime("+ 30 days"))

                                <a href="#"
                                   class="list-group-item list-group-item-action list-group-item-danger flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-2 h5">
                                            {{$scert->states->label or 'Unknown'}}
                                        </h5>
                                        <small>{{date('m-d-Y', strtotime($scert->expiration))}} - {{$scert->certtype->label or 'Unknown'}}</small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <small>{{$scert->certification_number}}</small>
                                        <small>
                                            @if($scert->status == 0) Active - Not Verified @elseif($scert->status == 1) Active - Verified @elseif($scert->status == 2) Pending Expiration @elseif($scert->status == 3) Expired @elseif($scert->status == 4) Not Active / Renewed @endif
                                        </small>

                                    </div>

                                </a>

                        @elseif($expiration > strtotime("+ 30 days") && $expiration < strtotime("+ 60 days"))

                                <a href="#"
                                   class="list-group-item list-group-item-action list-group-item-warning flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-2 h5">
                                            {{$scert->states->label or 'Unknown'}}
                                        </h5>
                                        <small>{{date('m-d-Y', strtotime($scert->expiration))}} - {{$scert->certtype->label or 'Unknown'}}</small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <small>{{$scert->certification_number}}</small>
                                        <small>
                                            @if($scert->status == 0) Active - Not Verified @elseif($scert->status == 1) Active - Verified @elseif($scert->status == 2) Pending Expiration @elseif($scert->status == 3) Expired @elseif($scert->status == 4) Not Active / Renewed @endif
                                        </small>

                                    </div>

                                </a>
                            @elseif($expiration > strtotime("+ 61 days") )
                                <a href="#"
                                   class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-2 h5">
                                            {{$scert->states->label or 'Unknown'}}
                                        </h5>
                                        <small>{{date('m-d-Y', strtotime($scert->expiration))}} - {{$scert->certtype->label or 'Unknown'}}</small>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <small>{{$scert->certification_number}}</small>
                                        <small>
                                            @if($scert->status == 0) Active - Not Verified @elseif($scert->status == 1) Active - Verified @elseif($scert->status == 2) Pending Expiration @elseif($scert->status == 3) Expired @elseif($scert->status == 4) Not Active / Renewed @endif
                                        </small>

                                    </div>

                                </a>
                            @endif

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