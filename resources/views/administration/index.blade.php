@extends('layouts.app')

@section('page-title', trans('Addministration'))
@section('page-heading', trans('Addministration'))

@section('Administration')
<li class="breadcrumb-item active">
    @lang('Administration')
</li>
@stop

@push('css')
	<link href="/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
@endpush

@section('content')

@include('partials.toastr')

<div class="row">
    <div class="col-lg-3">
        <div class="row">
            <blockquote class="blockquote bq-primary">
              <p class="bq-title">PCR Statistics</p>
              </p>
            </blockquote>
            @include('administration.partials.pcritems')
        </div>
    </div>
        
    <div class="col-lg-3">
         <div class="row">
             <blockquote class="blockquote bq-primary">
              <p class="bq-title">Daily Run Statistics</p>
              </p>
            </blockquote>
            @include('administration.partials.runitems')
        </div>
    </div>
    
    <div class="col-lg-3">
        <div class="row">
            <blockquote class="blockquote bq-primary">
              <p class="bq-title">Daily Maintainance Statistics</p>
              </p>
            </blockquote>
            @include('administration.partials.maintananceitems')
        </div>
    </div>
    
    <div class="col-lg-3">
        <div class="row">
            <blockquote class="blockquote bq-primary">
              <p class="bq-title">Daily Compliance Statistics</p>
              </p>
            </blockquote>
            @include('administration.partials.complianceitems')
        </div>
    </div>
		
	
</div>


@stop

@section('styles')
<style>
    body{
        background:#000000;
	font-family: 'Lato', sans-serif;
}
.main-section{
	width:80%;
	margin:0 auto;
}
.dashbord{
	margin-top:30px;
	margin-right: 10px;
	display: inline-block;

	color:#fff;
	border-radius: 3px;
}
.title-section{
	border-radius: 5px 5px 0px 0px;
	text-align: center;
	background-color:#7CD6F8;
	padding:7px 0px;
}
.title-section p{
	margin:0px;
	font-size:13px;
}
.icon-text-section{
	background-color:#5BCCF6;
	padding:5px 10px;
}
.icon-section{
	font-size:50px;
	float:left;
	width:20%;
	color:#8BDBF8;
}
.text-section{
	width:80%;
	float:right;
	text-align: right;
}
.text-section h1{
	margin:0px;
	font-size:25px;
}
.detail-section{
	background-color: #52B8DE;
	cursor: pointer;
	border-radius: 0px 0px 5px 5px;
}
.detail-section a{
	color:#fff;
}
.detail-section a p{
	display: inline-block;
	margin: 0px;
	font-size: 12px;
	padding:10px;
}
.detail-section a i{
	float:right;
	padding: 10px 5px 0px 0px;
}
.dashbord .detail-section:hover{
	background-color:#5a5a5a;
}
.download-content .title-section{
	background-color:#B0DA7A;
}
.download-content .icon-text-section{
	background-color: #9CD159;
}
.download-content .detail-section{
	background-color: #8DBC50;
}
.download-content .icon-section{
	color:#B9DE8A;
}
.product-content .title-section{
	background-color:#FF7979;
}
.product-content .icon-text-section{
	background-color:#FF5757;
}
.product-content .icon-section{
	color:#FF8989;
}
.product-content .detail-section{
	background-color:#E64F4F;
}
</style>
@stop

@section('scripts')

<script>
    // Data Picker Initialization
    $('.datepicker').pickadate();
</script>
@stop