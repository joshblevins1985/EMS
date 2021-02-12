
                    <?php
                    if ($percent >= 0 && $percent <= 25) {
                        $acolor = "success";
                    } elseif ($percent >= 26 && $percent <= 50) {
                        $acolor = "primary";
                    } elseif ($percent >= 51 && $percent <= 99) {
                        $acolor = "warning";
                    } elseif ($percent >= 100) {
                        $acolor = "danger";
                    } else {
                        $acolor = "";
                    }
                    ?>

<div class="col-xl-4 col-sm-6 grid-margin stretch-card">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">{{ round($percent) }} %</h3>
                        {{-- Update To get Last week data <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>--}}
                    </div>
                </div>
                <a href="javascript;" data-toggle="modal" data-target="#attendanceModal" >
                <div class="col-3">
                    <div class="icon icon-box-{{ $acolor }} ">
                        <span class="fas fa-calendar-alt icon-item"></span>
                    </div>
                </div>
                </a>
            </div>
            <h6 class="font-weight-normal">Attendance</h6>
            <h6 class="font-weight-normal">Click the icon to see report</h6>
        </div>
    </div>

</div>
