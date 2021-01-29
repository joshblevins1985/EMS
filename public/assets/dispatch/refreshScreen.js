$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
    var search = window.location.search;        
    var auto_refresh = setInterval(
        function(){
            $('#pending').load('/pending/' + search);
        },1000)