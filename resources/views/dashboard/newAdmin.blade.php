@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
<link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="assets/plugins/morris.js/morris.css" rel="stylesheet" />
<style>
    .morris-chart text {
  fill: white;
}
</style>
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
    <li class="breadcrumb-item active">Dashboard v3</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">Dashboard v3</h1>
<!-- end page-header -->
<!-- begin daterange-filter -->
<div class="d-sm-flex align-items-center mb-3">
    <a href="#" class="btn btn-inverse mr-2 text-truncate" id="daterange-filter">
        <i class="fa fa-calendar fa-fw text-white-transparent-5 ml-n1"></i>
        <span>1 Jun 2019 - 7 Jun 2019</span>
        <b class="caret"></b>
    </a>
    <div class="text-muted f-w-600 mt-2 mt-sm-0">compared to <span id="daterange-prev-date">24 Mar-30 Apr 2019</span></div>
</div>
<!-- end daterange-filter -->

<div class="row">
    <!-- begin col-6 -->
    <div class="col-xl-12">
        <!-- begin card -->
        <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
            <!-- begin card-body -->
            <div class="card-body">
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-7 -->
                    <div class="col-xl-7 col-lg-8" id="attrition">
                        <!-- begin title -->
                        <div class="mb-3 text-grey">
                            <b>EMPLOYEE ATTRITION RATE</b>
                            <span class="ml-2">
									<i class="fa fa-info-circle" data-toggle="popover"  data-trigger="hover" data-title="Total sales" data-placement="top" data-content="Net sales (gross sales minus discounts and returns) plus taxes and shipping. Includes orders from all sales channels."></i>
								</span>
                        </div>
                        <!-- end title -->
                        <!-- begin total-sales -->
                        <div class="d-flex mb-1">
                            <h2 class="mb-0"><span id="company-attrition" class="company-attrition" data-animation="number" data-value="{{$data['company_attrition']}}">0.00</span> %</h2>
                            <div class="ml-auto mt-n1 mb-n1"><div id="total-sales-sparkline"></div></div>
                        </div>
                        <!-- end total-sales -->
                        <!-- begin percentage -->
                        <div class="mb-3 text-grey">
                            <i class="@if($data['company_attrition'] > $data['company_attrition_compare']) fa fa-caret-up @elseif($data['company_attrition'] < $data['company_attrition_compare']) fa fa-caret-down @endif"></i> <span data-animation="number" data-value="@if($data['company_attrition'] > $data['company_attrition_compare']) {{$data['company_attrition'] - $data['company_attrition_compare']}} @elseif($data['company_attrition'] < $data['company_attrition_compare']) {{$data['company_attrition_compare'] - $data['company_attrition']}} @endif">0.00</span>% compared to last month
                        </div>
                        <!-- end percentage -->
                        <hr class="bg-white-transparent-2" />
                        <!-- begin row -->
                        <div class="row text-truncate">
                            <!-- begin col-6 -->
                            <div class="col-6">
                                <div class="f-s-12 text-grey">Total Ambulette</div>
                                <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="1568">0</div>
                                <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                    <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="55%" style="width: 0%"></div>
                                </div>
                            </div>
                            <!-- end col-6 -->
                            <!-- begin col-6 -->
                            <div class="col-6">
                                <div class="f-s-12 text-grey">Total EMT's</div>
                                <div class="f-s-18 m-b-5 f-w-600 p-b-1">$<span data-animation="number" data-value="41.20">0.00</span></div>
                                <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                    <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="55%" style="width: 0%"></div>
                                </div>
                            </div>
                            <!-- end col-6 -->
                        </div>
                        <!-- end row -->
                        <!-- begin row -->
                        <div class="row text-truncate">
                            <!-- begin col-6 -->
                            <div class="col-6">
                                <div class="f-s-12 text-grey">Total AEMT's</div>
                                <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="1568">0</div>
                                <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                    <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="55%" style="width: 0%"></div>
                                </div>
                            </div>
                            <!-- end col-6 -->
                            <!-- begin col-6 -->
                            <div class="col-6">
                                <div class="f-s-12 text-grey">Total Medics's</div>
                                <div class="f-s-18 m-b-5 f-w-600 p-b-1">$<span data-animation="number" data-value="41.20">0.00</span></div>
                                <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                    <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="55%" style="width: 0%"></div>
                                </div>
                            </div>
                            <!-- end col-6 -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col-7 -->
                    <!-- begin col-5 -->
                    <div class="col-xl-5 col-lg-4 align-items-center d-flex justify-content-center">
                        <img src="assets/img/svg/img-1.svg" height="175px" class="d-none d-lg-block" />
                    </div>
                    <!-- end col-5 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col-6 -->

    <div class="col-xl-12">
        <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
        <!-- begin card-body -->
            <div class="card-body">
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-7 -->
                    <div class="col-xl-9 col-lg-8" id="attrition">
                        <!-- begin title -->
                        <div class="mb-3 text-grey">
                            <b>Bucyrus Run Statistics</b>
                            <span class="ml-2">
									<i class="fa fa-info-circle" data-toggle="popover"  data-trigger="hover" data-title="Run Stats" data-placement="top" data-content="Runs statistics for the designated time."></i>
								</span>
                        </div>
                        <!-- end title -->
                        <!-- begin totals -->
                        <div class="col-xl-12">
                            <div class="col-xl-12 text-center">
                                <h1>Total Runs: </h1>
                            </div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <h1>Chute Time: </h1>
                                </div>
                                <div class="col-xl-2">
                                    <h1> {{round($chute_e, 2)}}</h1>
                                </div>
                                <div class="col-xl-4">
                                    <h1>NE Chute Time: </h1>
                                </div>
                                <div class="col-xl-2">
                                    <h1> {{round($chute_n, 2)}}</h1>
                                </div>
                                <div class="col-xl-4">
                                    <h1>Response Average: </h1>
                                </div>
                                <div class="col-xl-2">
                                    <h1> {{round($response, 2)}} </h1>
                                </div>
                                <div class="col-xl-4">
                                    <h1>Total Average: </h1>
                                </div>
                                <div class="col-xl-2">
                                    <h1> {{round($total, 2)}} </h1>
                                </div>
                                <div class="col-xl-4">
                                    <h1>UHU </h1>
                                </div>
                                <div class="col-xl-2">
                                    <h1> </h1>
                                </div>
                            </div>

                        </div>
                        <!-- end total-sales -->

                        <hr class="bg-white-transparent-2" />
                        <div class="col-xl-12">
                            <div class="col-xl-3">
                                <div class="panel panel-inverse" data-sortable-id="morris-chart-4">
                    				<div class="panel-heading">
                    					<h4 class="panel-title">Morris Donut Chart</h4>
                    					<div class="panel-heading-btn">
                    						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    					</div>
                    				</div>
                    				<div class="panel-body">
                    					<h4 class="text-center">Incident Types</h4>
                    					<div id="runTypeChart" class="height-sm morris-chart"></div>
                    				</div>
                    			</div>
                    			<!-- end panel -->
                            </div>
                        </div>
                    </div>
                    <!-- end col-7 -->
                    <!-- begin col-5 -->
                    <div class="col-xl-3 col-lg-4 align-items-center d-flex justify-content-center">
                        <img src="assets/img/ambulance_car.png" height="175px" class="d-none d-lg-block" />
                    </div>
                    <!-- end col-5 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script src="assets/plugins/d3/d3.min.js"></script>
<script src="assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/morris.js/morris.min.js"></script>


	<script>
	new Morris.Donut({

	       element: 'runTypeChart',

	       data: {!! $stats !!},
	       formatter: function (y) { return y + "%" },
	           colors: ['0762f5', 'ed05e2', 'f50707', 'f57e07']
	    });
	</script>



@endpush
