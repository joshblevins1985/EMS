@extends('layouts.default')

@section('page-title', trans('Billing Dashboard'))
@section('page-heading', trans('Billing Dashboard'))

@push('styles')

@endpush

@section('content')

<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="javascript:;">Patients</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Dashboard <small>Complete insight to patient management.</small></h1>
	<!-- end page-header -->

<div class="row">
    <!-- begin col-3 -->
		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon"><i class="fas fa-file-certificate"></i></div>
				<div class="stats-info">
					<h4>Expiring Certifications</h4>
					<p>{{ count($certs) }}</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		
		<!-- begin col-3 -->
		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon"><i class="fas fa-heart-rate"></i></div>
				<div class="stats-info">
					<h4>Expiring Qualifiers</h4>
					<p>xxx</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon"><i class="fad fa-head-side-medical"></i></div>
				<div class="stats-info">
					<h4>Expiring Medical Conditions</h4>
					<p>xxx</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon"><i class="fad fa-notes-medical"></i></div>
				<div class="stats-info">
					<h4>Incomplete Patient Care Reports</h4>
					<?
					$b = count($brs);
					$d = count($drug);
					$h = $b - $d;
					?>
					<p>{{ $b }}</p>
					
					
					<p><small>Holding {{ $h }}</small> </p>
					<p><small>Drug Forms {{ $d }}</small></p>
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
</div>

<div class="row">
    <!-- begin col-3 -->
	<div class="col-xl-3 col-md-6">
		
	    @include('patients.partials.expiredCerts')
		
	</div>
	<!-- end col-3 -->
	
	<!-- begin col-3 -->
	<div class="col-xl-3 col-md-6">
		<div class="widget widget-stats bg-black">
			
		</div>
	</div>
	<!-- end col-3 -->
	
	<!-- begin col-3 -->
	<div class="col-xl-3 col-md-6">
		<div class="widget widget-stats bg-black">
			
		</div>
	</div>
	<!-- end col-3 -->
	
	<!-- begin col-3 -->
	<div class="col-xl-3 col-md-6">
	    <div class="row">
	        <input type="text" class="form-control" id="myInput" placeholder="Enter keyword" />
	    </div>
	    
	    
	    <ul class="list-group" id="myList">
	        @foreach($employees as $row)
	        <li class="list-group-item mb-2">
	            <div class="row">
		        <div class="col-xl-10">
		            <div class="row">
    		        <div class="col-xl-12">
    		        {{ $row->last_name }}, {{ $row->first_name }} <span class="pull-right">Total <span class="badge bg-danger">{{ count($row->BadRunSheets) }}</span></span>
    		        </div>
    		        
    		        
    		    </div>
    		    @foreach($row->BadRunSheets as $brs)
		        <div class="row" > {{ Carbon\Carbon::parse($brs->pcr->created_at)->format('m-d-y') }} {{ $brs->pcr->pcr_number ?? '1' }} </div>
		        @endforeach
		        </div>
		        <div class="col-xl-2 text-center">
		            <div class="row mb-2">
		                <i class="far fa-clipboard-list-check fa-2x" data-toggle="tooltip" data-placement="top" title="Print report of all addendums."></i>
		            </div>
		            <div class="row mb-2">
		                <i class="fas fa-print fa-2x" data-toggle="tooltip" data-placement="top" title="Print all addendums."></i>
		            </div>
		            <div class="row mb-2">
		               <span class="text-success"><a href="/brsCompleteAll/{{$row->user_id}}"><i class="fad fa-check-double fa-2x" data-toggle="tooltip" data-placement="top" title="Complete all listed addendums."></i></a></span> 
		            </div>
		        </div>
		    </div>
	        </li>
	        @endforeach
	    </ul>
		
	</div>
	<!-- end col-3 -->
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endpush