@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
<link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="/assets/css/dragula.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Mechanic</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">Mechanic Task Overview</h1>
<!-- end page-header -->

<div class="row mt-5">
    <!-- begin col-4 -->
    <div class="col-xl-4">
        @include('mechanic.partials.pending')
    </div>
    <!-- end col-4 -->

    <!-- begin col-4 -->
    <div class="col-xl-4">
        @include('mechanic.partials.assigned')
    </div>
    <!-- end col-4 -->

    <!-- begin col-4 -->
    <div class="col-xl-4">
        @include('mechanic.partials.complete')
    </div>
    <!-- end col-4 -->
</div>

@endsection

@include('mechanic.partials.modelAddNotes')
@include('mechanic.partials.modelRemoveParts')

@push('scripts')
<script src="/assets/plugins/d3/d3.min.js"></script>
<script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="/assets/plugins/moment/moment.js"></script>
<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/demo/dashboard-v3.js"></script>
<script src="/assets/js/dragula.js"></script>
<script src="/assets/js/pages/mechanicDrag.js"></script>
<script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script>$.fn.selectpicker.Constructor.BootstrapVersion = '4';</script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>


<script>
        $(document).ready(function() {
        var counter = 0;

        $("#addPart").on("click", function() {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select name="part[pid][]" id="part'+ counter +'" class="selectpicker" data-width="fit" data-style="btn-dark" data-parsley-required="true" title="Choose Part Used" data-live-search="true"> @foreach($availableparts as $row) <option value="{{$row->id}}">{{$row->name}} 1</option> @endforeach </select></td>';
            cols += '<td><input type="text" class="form-control" name="part[qty][]" id="qty" data-parsley-required="true" /></td>'
            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
            newRow.append(cols);
            $("#removePartsTable").append(newRow);
            $('#part'+counter).selectpicker();
            counter++;
        });



        $("#removePartsTable").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            counter -= 1
        });


    });
</script>

<script>
$('#removePartsModal').on('show.bs.modal', function(e) {
    var used_on = $(e.relatedTarget).data('used_on');
    $("#used_on").val( used_on );
});
</script>
<script>
$('#modalAddNote').on('show.bs.modal', function(e) {
    var taskid = $(e.relatedTarget).data('taskid');
    $("#task_id").val( taskid );
});
</script>




@endpush
