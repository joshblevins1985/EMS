$('#modalDispatch').on('show.bs.modal', function (event) {
        
      console.log('Modal Opened');
      var button = $(event.relatedTarget); // Button that triggered the modal
      var title = button.data('title'); // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var search = window.location.search;
      var incident = $(event.relatedTarget).data('incident');
      var display = data();
      var modal = $(this);
      
      modal.find('.modal-title').text(title);
      modal.find('.modal-body input').val(title);
      

        function data(){

            $('#au').load('/available_units/'+ incident + search, function(){

            });
        }
        

           
    })