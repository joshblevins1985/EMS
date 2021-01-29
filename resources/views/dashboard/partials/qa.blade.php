<?php
if ($qapercent == 0) {
    $qapercent = 100;
    $qacolor = "success";
} elseif ($qapercent >= 90 && $qapercent <= 100) {
    $qacolor = "success";
} elseif ($qapercent >= 85 && $qapercent <= 89) {
    $qacolor = "primary";
} elseif ($qapercent >= 80 && $qapercent <= 84) {
    $qacolor = "warning";
} elseif ($qapercent <= 79) {
    $qacolor = "danger";
} else {
    $qacolor = "";
}
?>


<div class="col-xl-4 col-sm-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">{{ round($qapercent) }} %</h3>
                        {{-- Update To get Last week data <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>--}}
                    </div>
                </div>
                <a href="javascript;" data-toggle="modal" data-target="#qaModal" >
                <div class="col-3">
                    <div class="icon icon-box-{{ $qacolor }} ">
                        <span class="fad fa-paste  icon-item"></span>
                    </div>
                </div>
                </a>
            </div>
            <h6 class="text-muted font-weight-normal">Quality Assurance Review</h6>
            <h6 class="text-muted font-weight-normal">Click the icon to see report</h6>
        </div>
    </div>
</div>
