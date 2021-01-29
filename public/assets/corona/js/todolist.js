(function($) {
  'use strict';
  $(function() {
    var todoListItem = $('.todo-list');
    var todoListInput = $('.todo-list-input');
    $('.todo-list-add-btn').on("click", function(event) {
      event.preventDefault();

      var item = $(this).prevAll('.todo-list-input').val();
      var data = $("#task").serialize();
      console.log(data);
      $.post(
          '/todo',
          data,
          function(result) {
            var response = jQuery.parseJSON(result);
            toastr.success(response[0].message);
            //console.log(response[0].message);

              todoListItem.append("<li>" +
                  "<div class='form-check'>" +
                    "<label class='form-check-label'>" +
                    "<input class='checkbox' type='checkbox' data-id='" +response[0].id+ "'/>" + item +
                    "<i class='input-helper'></i>" +
                    "</label>" +
                  "</div>" +
                  "<div class='remove btn-group'>" +
                    "<i class='fad fa-ellipsis-v' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' ></i>" +
                    "<div class='dropdown-menu'>" +
                    "<a class='dropdown-item' id='task-remove' data-id='" +response[0].id+ "' ><span class='text-danger'> Remove Task </span> </a>" +
                    "<div class='dropdown-divider'></div>" +
                    "</div>" +
                  "</div>" +
                  "</li>");

              todoListInput.val("");

          }
      );



    });

    todoListItem.on('change', '.checkbox', function() {
      if ($(this).attr('checked')) {
        $(this).removeAttr('checked');
        console.log('uncomplete logic goes here');
        var id = $(this).data('id');
        $.get(
            'task/uncomplete/'+ id,
            function(result) {
              var response = jQuery.parseJSON(result);
              toastr.success(response[0].message);
              //console.log(response[0].message);

            }
        );
      } else {
        $(this).attr('checked', 'checked');
       // console.log('completed logic goes here');
        var id = $(this).data('id');
        $.get(
            'task/complete/'+ id,
            function(result) {
              var response = jQuery.parseJSON(result);
              toastr.success(response[0].message);
              //console.log(response[0].message);

            }
        );
      }

      $(this).closest("li").toggleClass('completed');

    });

    todoListItem.on('click', '#task-remove', function() {
      var id = $(this).data('id');
      var remove = $(this).closest("li").remove();
      $.ajax({
        url: '/todo/'+ id,
        type: 'DELETE',
        success: function(result) {
          remove;
          var response = jQuery.parseJSON(result);
          toastr.success(response[0].message);
          //console.log('success');
        }
      });

    });

    todoListItem.on('click', '#task-working', function() {
      var id = $(this).data('id');
      $.get(
          '/task/active/'+ id,
          function(result) {
            var response = jQuery.parseJSON(result);
            toastr.success(response[0].message);
            $('#task-status_'+ id).append('<span class=\'text-warning\'> <i class=\'fal fa-snowboarding\'></i>< </span>');
            //console.log(response[0].message);

          }
      );
    });

  });
})(jQuery);