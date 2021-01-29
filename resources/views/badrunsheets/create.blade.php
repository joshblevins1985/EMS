@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.messages')
<div class="row-fluid" style="height: 100%; overflow:visible;">
<form action="/badrunsheets" method="post" enctype="multipart/form-data">

    @csrf

    @include('badrunsheets.partials.form')

</form>
</div>
@stop

@section('styles')

@stop
 
@section('scripts')
<script type="text/javascript">
        $(document).ready(function() {
        var counter = 0;

        $("#addrow").on("click", function() {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="mdb-select md-form" name="p[problem][]" id="mb-select'+ counter +'"> <option value="" disabled selected>Choose a problem from list.</option> @foreach($problems as $p) <option value="{{ $p->id }}">{{ $p->description }}</option> @endforeach </select>';
            cols += '<td><div class="md-form"><input type="text" class="form-control" name="p[note][]"  placeholder="Note"></div></td>';
            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
            newRow.append(cols);
            $("#problem_table").append(newRow);
            $('#mb-select'+ counter).materialSelect();
            counter++;
        });



        $("#problem_table").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            counter -= 1
        });


    });
</script>
@stop