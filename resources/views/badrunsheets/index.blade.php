@extends('layouts.sidebar-fixed')

@section('title', 'Managed Tables - Buttons')

@push('css')
	<link href="assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="javascript:;">Runsheets</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Held for Addendum</a></li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Held for Addendum <small>Patient care reports held for employee addendum. </small></h1>
	<!-- end page-header -->
	<!-- begin row -->
	<div class="row">

		<!-- begin col-10 -->
		<div class="col-xl-12">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<h4 class="panel-title">Bad Run Sheets</h4>
					<div class="col-1 pull-right">
                        <a class="btn btn-primary" href="badrunsheets/create"><i class="fa fa-plus"></i> Add New </a>
                    </div>

				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<!--
				<div class="alert alert-warning fade show">
					<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				-->
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="data-table-buttons" class="table table-striped table-td-valign-middle">
						<thead>
							<tr>
								<th>Incident Date</th>
                                <th>Employee</th>
                                <th>PCR #</th>
                                <th>Status</th>
                                <th>Billing Complete</th>
                                <th>File</th>
                                <th></th>
							</tr>
						</thead>
						<tbody>
							@if(count($brs))
                            @foreach($brs as $row)
                            @include('badrunsheets.partials.row')
                            @endforeach
                            @else
                            <tr><td colspan=5><h2>No Bad Run Sheets Found</h2></td></tr>
                            @endif
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->
		</div>
		<!-- end col-10 -->
	</div>
	<!-- end row -->
@endsection

@push('scripts')
	<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="assets/plugins/pdfmake/build/pdfmake.min.js"></script>
	<script src="assets/plugins/pdfmake/build/vfs_fonts.js"></script>
	<script src="assets/plugins/jszip/dist/jszip.min.js"></script>
	<script src="assets/js/demo/table-manage-buttons.demo.js"></script>
@endpush
