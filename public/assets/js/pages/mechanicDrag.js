var draggableElements = document.querySelectorAll('[draggable="true"]');

var id = '';
var start_div = '';
var user_id = '';

[].forEach.call(draggableElements, function(element) {
    element.addEventListener('dragstart', handleDragStart, false);
    element.addEventListener('dragenter', handleDragEnter, false);
    element.addEventListener('dragover', handleDragOver, false);
    element.addEventListener('dragleave', handleDragLeave, false);
    element.addEventListener('drop', handleDrop, false);
    element.addEventListener('dragend', handleDragEnd, false);
});

function handleDragStart(event) {


    id = event.target.dataset.id;
    start_div = event.target;
    //user_id = '';

    console.log('The ID of the task is:', id);
    console.log('The div selected to move is: ', start_div)
    console.log(user_id);
    event.dataTransfer.setData("text/plain", event.target);
}


function handleDragOver(event) {
    event.preventDefault();
    event.dataTransfer.dropEffect = 'move';
    return false;
}

function handleDragEnter(event) {
    this.classList.add('over');

    console.log('dragged element ', start_div , ' on element ', event.target ,'the id of the item is', id)
}

function handleDragLeave(event) {
    this.classList.remove('over');
}

function handleDrop(event) {
    event.stopPropagation();
    event.preventDefault();

    var drop = $(this).data("drop");
    var user_id = $(this).data("user_id");
    var status = $(this).attr("data-status");
    startdiv = 'status_'+status;
                    console.log(startdiv);
    

    if(drop == true){
        if(user_id === null || user_id == ''){
            console.log('The userid is null');
            console.log("the status is", status);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            $.ajax({
                url:"/mechanic/"+ id,
                method:"PUT",
                data:{status: status},
                success: function( data ) {
                    console.log(data);
                    
                    $('.row').filter('[data-id="'+id+'"]').remove();
                    
                    document.getElementById(startdiv).prepend(start_div);
                }
            });
        }else{
            console.log('The user id is', user_id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            $.ajax({
                url:"/mechanic/"+ id,
                method:"PUT",
                data:{employee: user_id, status: status},
                success: function( data ) {
                    console.log(data);
                    $('.row').filter('[data-id="'+id+'"]').remove();
                    document.getElementById(user_id).prepend(start_div);
                    
                }
            });

        }
    }else{
        alert('The drop effect is not allowed in this area try again.')
    }
}

function handleDragEnd(event) {
    [].forEach.call(draggableElements, function (element) {
        element.classList.remove('over');
    });
}