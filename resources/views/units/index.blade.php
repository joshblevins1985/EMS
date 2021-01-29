@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')

<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Unit Management</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Unit Table</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Company Units  </h1>
    <!-- end page-header -->

    <div class="row">
        <!-- begin col-3 -->
		<div class="col-xl-2 col-md-6">
			<div class="widget widget-stats bg-dark">
				<div class="stats-icon stats-icon-lg"><i class="fad fa-stretcher fa-fw"></i></div>
				<div class="stats-content">
					<div class="stats-title">Ambulances</div>
					<div class="stats-number">{{ count($units->where('type', '<', 5)) }}</div>
				</div>
			</div>
		</div>
		<!-- end col-3 -->

		<!-- begin col-3 -->
		<div class="col-xl-2 col-md-6">
			<div class="widget widget-stats bg-dark">
				<div class="stats-icon stats-icon-lg"><i class="fad fa-wheelchair fa-fw"></i></div>
				<div class="stats-content">
					<div class="stats-title">Wheel Chair</div>
					<div class="stats-number">{{ count($units->where('type', 5)) }}</div>
				</div>
			</div>
		</div>
		<!-- end col-3 -->

		<!-- begin col-3 -->
		<div class="col-xl-2 col-md-6">
			<div class="widget widget-stats bg-dark">
				<div class="stats-icon stats-icon-lg"><i class="fad fa-cars fa-fw"></i></div>
				<div class="stats-content">
					<div class="stats-title">Cars</div>
					<div class="stats-number">{{ count($units->where('type', 6)) }}</div>

				</div>
			</div>
		</div>
		<!-- end col-3 -->

		<!-- begin col-3 -->
		<div class="col-xl-2 col-md-6">
			<div class="widget widget-stats bg-warning">
				<div class="stats-icon stats-icon-lg"><i class="fad fa-engine-warning fa-fw"></i></div>
				<div class="stats-content">
					<div class="stats-title">Units Over 200 K</div>
					<div class="stats-number">{{ count($units->where('odometer', '>' , 200000)) }}</div>

				</div>
			</div>
		</div>
		<!-- end col-3 -->

		<!-- begin col-3 -->
		<div class="col-xl-2 col-md-6">
			<div class="widget widget-stats bg-danger">
				<div class="stats-icon stats-icon-lg"><i class="fad fa-engine-warning fa-fw"></i></div>
				<div class="stats-content">
					<div class="stats-title">Total Out of Service</div>
					<div class="stats-number">{{ count($units->where('status', 0)) }}</div>

				</div>
			</div>
		</div>
		<!-- end col-3 -->
    <div class="col-xl-2 col-md-6">
      <div class = "row">
        <a href="/unit/mileageWeekly" target="_blank"><button type="button" class="btn btn-primary">Vehicle Mileage Report</button></a>
      </div>
    </div>


    <div class="row mb-2">
        <div class="pull-right">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal"> <i class="fad fa-plus-circle"></i> Add New Unit</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            @include('units.partials.tableIndex')
        </div>
    </div>







@endsection

@include('units.partials.modalUnitInfo')
@include('units.partials.modalUnitMileageUpdate')

@push('scripts')
<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/plugins/select2/dist/js/select2.min.js"></script>

<script>
        $('#unitInfoModal').on('show.bs.modal', function(e) {
            var unitId = $(e.relatedTarget).data('unit_id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            // AJAX request
            $.ajax({
                url: '/unit/modal/' + unitId,
                type: 'get',
                data: {},
                success: function(response){
                    // Add response in Modal body
                    $('#unit_info').html(response);
                }
            });

        });
    </script>

<script>
        $('#unitMilesUpdateModal').on('show.bs.modal', function(e) {
            var unitId = $(e.relatedTarget).data('unit_id');
            console.log(unitId);

            $("#unit_id").val(unitId);


        });
    </script>

<script>

    // this is the id of the form
    $("#mileageUpdateForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
               type: "POST",
               url: 'unit/Mileage',
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                   alert('You have updated the mileage for this unit.'); // show response from the php script.
                   $( "#last_reported_mileage" ).text( data.odometer );
               }
             });


    });
</script>

<script>
    var handleDataTableDefault = function() {
	"use strict";

	if ($('#data-table-default').length !== 0) {
		$('#data-table-default').DataTable({
			responsive: true
		});
	}
};

var handleSelect2 = function() {
	$(".default-select1").select2();
	$(".default-select2").select2();
    $(".default-select3").select2();
    $(".default-select4").select2();
    $(".default-select5").select2();
};

var TableManageDefault = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableDefault();
		}
	};
}();

var FormPlugins = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleSelect2();
		}
	};
}();

$(document).ready(function() {
	FormPlugins.init();
});

$(document).ready(function() {
	TableManageDefault.init();
});
</script>


@endpush
