@extends('layouts.sidebar-fixed')

@section('title', 'Support Tickets')

@push('css')

<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>


@endpush

@section('content')

    <!-- begin page-header -->
    <h1 class="page-header mb-3">Company Support Tickets </h1>
    <!-- end page-header -->

    <div class="row mb-2">
        <div class="pull-right">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#supportRequest"> <i class="fad fa-plus-circle"></i> Add New Support Ticket</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            @include('assets.partials.tableSupportTickets')
        </div>
    </div>


@endsection
@include('assets.partials.modalIndexNewSupportRequest')
@include('assets.partials.modalAddSupportNote')
@include('assets.partials.modalSupportNotesInfo')
@include('assets.partials.modalAssignTask')
@include('assets.partials.modalEditSupportRequest')

@push('scripts')
<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/plugins/select2/dist/js/select2.min.js"></script>

<script>
        $('#editTicketModal').on('show.bs.modal', function(e) {
            var ticketId = $(e.relatedTarget).data('ticket_id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            // AJAX request
            $.ajax({
                url: '/support/ticket/' + ticketId,
                type: 'get',
                data: {},
                success: function(response){
                    // Add response in Modal body
                    $('#ticket_info').html(response);
                }
            });

        });
    </script>

<script>
    $(document).ready(function() {
        $('#support-tickets').DataTable({
            responsive: true
        });
    } );
</script>

<script>
    var handleSelect2 = function() {
	$(".default-employee").select2();
	$(".default-assignEmployee ").select2();
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
$('#assignTicket').on('show.bs.modal', function(e) {
    var ticketId = $(e.relatedTarget).data('ticketid');

    console.log("id = " + ticketId); // this shows that I have the id
    $(this).find("#ticketId").val(ticketId)


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
