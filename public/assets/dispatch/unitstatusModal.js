
$('#unitstatusModal').on('show.bs.modal', function(e) {
    var unit = $(e.relatedTarget).data('unit');
    var status = $(e.relatedTarget).data('status');
    var message = $(e.relatedTarget).data('message');
    var call = $(e.relatedTarget).data('call');
    $("#unit").text("unit number is").html(call);
    $("#message").html(message);
    $("#unitInput").val(unit);
    $("#statusInput").val(status);
});
