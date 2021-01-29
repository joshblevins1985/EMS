$("#box_rfid").keyup(function(){

    var rfid = $("#box_rfid").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    // AJAX request
    $.ajax({
        url: '/narcotic/boxCheck/' + rfid,
        type: 'get',
        data: {},
        success: function(response){
            // Add response in Modal body
            $('#box_confirm').html(response);

        }
    });

});