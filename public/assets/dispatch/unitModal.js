$('#unitModal').on('show.bs.modal', function (e) {
    var uid = $(e.relatedTarget).data('uuid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    // AJAX request
    $.ajax({
        url: '/dispatch/units',
        type: 'post',
        data: {uid: uid},
        success: function (response) {
            // Add response in Modal body
            $('.modal-body').html(response);

            // Display Modal
            $('#unitModal').modal('show');
        }
    });

});