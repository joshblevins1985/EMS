

<div class="col-xl-4 col-sm-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0"> {{count($brs)}}</h3>
                        {{-- Update To get Last week data <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>--}}
                    </div>
                </div>
                <div class="col-3">
                    <div class=" @if(count($brs)) icon icon-box-danger @else icon icon-box-success @endif ) ">
                        <span class="fad fa-file-medical-alt  icon-item"></span>
                    </div>
                </div>
            </div>
            <h6 class="text-muted font-weight-normal">Patient Care Reports</h6>
        </div>
    </div>
</div>

