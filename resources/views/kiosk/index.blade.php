@extends('layouts.defaultEmpty')

@section('title', 'Employee Kiosk')

@push('css')
<link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
@endpush

@section('content')

<div class="row">
    <div class="col-xl-6">
        <a data-toggle="modal" data-target="#timeClockModal">
            <!-- begin card -->
			<div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
				<!-- begin card-body -->
				<div class="card-body">
					<div class="row">
					    <div class="col-xl-12 text-center">
					        <strong><h2>Employee Sign In</h2></strong>
					    </div>
					</div>
					<div class="row">
					    <div class="col-xl-12 text-center">
					       <img class="card-img-top" src="https://peasi.app/assets/img/clock_in.png" alt="Card image cap" style="width: 200px; height:200px;">
					    </div>
					</div>
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->
        </a>
    </div>
    <div class="col-xl-6">
        <a data-toggle="modal" data-target="#narcoticOutModal">
            <!-- begin card -->
			<div class="card border-0 bg-primary text-white mb-3 overflow-hidden">
				<!-- begin card-body -->
				<div class="card-body">
					<div class="row">
					    <div class="col-xl-12 text-center">
					       <strong><h2>Narcotic Sign Out / In</h2> </strong>
					    </div>
					</div>
					<div class="row">
					    <div class="col-xl-12 text-center">
					       <img class="card-img-top" src="https://peasi.app/assets/img/NarcoticTracking.png" alt="Card image cap" style="width: 200px; height:200px;">
					    </div>
					</div>
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->
        </a>
    </div>
    <div class="col-xl-6">
        <a>
            <!-- begin card -->
			<div class="card border-0 bg-primary text-white mb-3 overflow-hidden">
				<!-- begin card-body -->
				<div class="card-body">
					<div class="row">
					    <div class="col-xl-12 text-center">
					       <strong><h2>Log Used Narcotics</h2> </strong>
					    </div>
					</div>
					<div class="row">
					    <div class="col-xl-12 text-center">
					       <img class="card-img-top" src="https://peasi.app/assets/img/NarcoticTracking.png" alt="Card image cap" style="width: 200px; height:200px;">
					    </div>
					</div>
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->
        </a>
    </div>
</div>

@endsection

@include('kiosk.partials.modalNarcoticOut')
@include('kiosk.partials.modalTimeClock')

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="/assets/plugins/parsleyjs/dist/parsley.js"></script>
<script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>

<script>
    $('#smartwizard').smartWizard();
</script>


<script src="/assets/js/kiosk/rfidScan.js"></script>

@endpush
