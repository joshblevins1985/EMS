@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
<link href="assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css" rel="stylesheet" />
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')

@include('partials.messages')

    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Asset Management</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Asset Table</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Company Asset Management </h1>
    <!-- end page-header -->


    <div class="row">
        <div class="col-xl-8">
            <div class="row mb-2">
                <div class="col-xl-2 float-right">
                    <button type="button"  class="btn btn-outline-light" data-toggle="modal" data-target="#myModal">Edit <i class="far fa-edit"></i></button>
                </div>

            </div>
            <div class="row">
                @include('assets.partials.showTable')
            </div>
            @if($asset->hasPorts)
            <div class="row">
                @include('assets.partials.showPortsConnected')
            </div>
            @endif
        </div>
        <div class="col-xl-4">
            <div class="row">
                <div class="col-xl-12">
                    @include('assets.partials.showNetworkInfo')
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    @include('assets.partials.showAttachedAssets')
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    @include('assets.partials.showAssetSupport')
                </div>
            </div>
        </div>
    </div>

@endsection

@include('assets.partials.modalNewSupportRequest')
@include('assets.partials.modalAddSupportNote')
@include('assets.partials.modalSupportNotesInfo')
@include('assets.partials.modalAttachAsset')
@include('assets.partials.modalNewAsset')

@push('scripts')

<script src="assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="assets/js/demo/form-wysiwyg.demo.js"></script>
	<script src="assets/plugins/select2/dist/js/select2.min.js"></script>

<script>
    var handleSelect2 = function() {
	$(".default-employee").select2();
};

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
</script>


<script>
$('#supportNote').on('show.bs.modal', function(e) {
    var ticketId = $(e.relatedTarget).data('ticketid');

    console.log("id = " + ticketId); // this shows that I have the id
    $(this).find("#ticketId").val(ticketId)


});
</script>

<script>
$('#attachAsset').on('show.bs.modal', function(e) {
    var assetId = $(e.relatedTarget).data('assetid');

    console.log("id = " + assetId); // this shows that I have the id
    $(this).find("#assetId").val(assetId)


});
</script>

<script>
    $('#supportNoteInfo').on('show.bs.modal', function (event) {

      var ticketId = $(event.relatedTarget).data('ticketid');
      var display = data();
      var modal = $(this)

      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

        function data(){
            $('#notes').load('/assetTicketNotes/' + ticketId);
        }

        document.getElementById("notes").innerHTML = display;


    })
</script>
@endpush
