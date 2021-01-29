@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')

<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Parts Inventory</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Available Parts</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">Garage Avaialble Parts</h1>
<!-- end page-header -->

<div class="row">
    <div class="col-xl-9"></div>
    <div class="col-xl-3 pull-right"><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-plus-hexagon text-primary fa-2x"></i> Add New Part
</button></div>
</div>

    <!-- begin panel -->
	<div class="panel panel-inverse">
		<!-- begin panel-heading -->
		<div class="panel-heading">
			<h4 class="panel-title">Data Table - Default</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
		</div>
		<!-- end panel-heading -->
		<!-- begin panel-body -->
		<div class="panel-body">
			<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
				<thead>
					<tr>
						<th width="1%"></th>
						<th width="1%" data-orderable="false"></th>
						<th >Part Name</th>
						<th>Part Number</th>
						<th >Minimum Qty</th>
						<th >Maximum Qty</th>
						<th >Cost</th>
						<th >Vendor</th>
						<th >Qty on Hand</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				    @foreach ($ap as $row)
				    <tr>
				        <td width="1%">{{ $row->id }}</td>
				        <td width="1%"> </td>
				        <td> {{ $row->name or ''}} </td>
				        <td>{{ $row->part_number or ''}}</td>
				        <td> {{ $row->min_qty or ''}} </td>
				        <td> {{ $row->max_qty or ''}} </td>
				        <td> {{ $row->cost or ''}} </td>
				        <td> {{ $row->vendor or ''}} </td>
				        <td @if($row->part_count < $row->min_qty) class="bg-danger text-center" @else class="text-center" @endif> <strong> {{ $row->part_count }} </strong> </td>
				        <td>
				        <a data-toggle="modal" data-target="#partModal" data-pid="{{$row->id}}" data-part_title="{{$row->name}}"><i class="fas fa-plus-hexagon text-primary fa-2x mr-2" data-toggle="tooltip" data-placement="top" title="Add Parts to Inventory" ></i></a>
				        <a data-toggle="modal" data-target="#rpartModal" data-pid="{{$row->id}}" data-part_title="{{$row->name}}"><i class="fas fa-minus-hexagon text-danger fa-2x" data-toggle="tooltip" data-placement="top" title="Remove Parts to Inventory" ></i></a>
				        </td>
				    </tr>
				    @endforeach

				</tbody>
			</table>
		</div>
		<!-- end panel-body -->
	</div>
	<!-- end panel -->


@endsection


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/garage/available_parts" method="POST" class="form-horizontal" data-parsley-validate="true" name="demo-form">
						@csrf
						<div class="form-group row m-b-15">
							<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Part Name :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="fullname" name="name" placeholder="Part Name" data-parsley-required="true" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-4 col-sm-4 col-form-label" for="email">Part Number * :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="part_number" name="part_number"  data-parsley-required="true" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-4 col-sm-4 col-form-label" for="email">Minimum Qaunity * :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="email" name="min_qty"  data-parsley-required="true" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-4 col-sm-4 col-form-label" for="website">Maximum Quanity :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="website" name="max_qty"  placeholder="Maxium Quanity" />
							</div>
						</div>

						<div class="form-group row m-b-15">
							<label class="col-md-4 col-sm-4 col-form-label" for="message">Cost :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="digits" name="cost"  placeholder="Cost" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-4 col-sm-4 col-form-label" for="message">Vendor :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="number" name="vendor"  placeholder="Vendor" />
							</div>
						</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="partModal" tabindex="-1" role="dialog" aria-labelledby="partModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="partModalLabel">Add Parts to Inventory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/garage/add/parts" method="POST" class="form-horizontal" data-parsley-validate="true" name="demo-form">
						@csrf
						<input type="hidden" name="pid" id="pid">
						<div class="form-group row m-b-15" />
							<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Qauanity to Add :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="qty" name="qty" placeholder="Qty to Add" data-parsley-required="true" />
							</div>
						</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rpartModal" tabindex="-1" role="dialog" aria-labelledby="rpartModalLabel" aria-hidden="true">
  <div class="modal-dialog bg-danger" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rpartModalLabel">Add Parts to Inventory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/garage/remove/parts" method="POST" class="form-horizontal" data-parsley-validate="true" name="demo-form">
						@csrf
						<input type="hidden" name="pid" id="rpid">
						<div class="form-group row m-b-15" />
							<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Qauanity to Add :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="rqty" name="qty" placeholder="Qty to Add" data-parsley-required="true" />
							</div>
						</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')

<script src="/assets/js/demo/dashboard-v3.js"></script>
<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="/assets/js/demo/table-manage-default.demo.js"></script>
	<script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script>
$('#partModal').on('show.bs.modal', function(e) {
    var pid = $(e.relatedTarget).data('pid');
    var part_title = $(e.relatedTarget).data('part_title');
    $("#partModalLabel").text("You are adding " + part_title + "to inventory.").html("You are adding " + part_title + " to inventory.");
    $("#pid").val( pid );
});
</script>

<script>
$('#rpartModal').on('show.bs.modal', function(e) {
    var pid = $(e.relatedTarget).data('pid');
    var part_title = $(e.relatedTarget).data('part_title');
    $("#rpartModalLabel").text("You are adding " + part_title + "to inventory.").html('You are <strong calss="text-danger">removing</strong> ' + part_title + ' to inventory.');
    $("#rpid").val( pid );
});
</script>



@endpush
