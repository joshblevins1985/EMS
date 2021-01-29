    var draggableElements = document.querySelectorAll('[draggable="true"]');

    [].forEach.call(draggableElements, function(element) {
        element.addEventListener('dragstart', handleDragStart, false);
        element.addEventListener('dragenter', handleDragEnter, false);
        element.addEventListener('dragover', handleDragOver, false);
        element.addEventListener('dragleave', handleDragLeave, false);
        element.addEventListener('drop', handleDrop, false);
        element.addEventListener('dragend', handleDragEnd, false);
    });

    function handleDragStart(event) {
        localStorage.setItem('currentDragElement', event.target.dataset.uuid);
        event.dataTransfer.setData("text/plain", event.target.dataset.uuid);
    }


    function handleDragOver(event) {
        event.preventDefault();
        event.dataTransfer.dropEffect = 'move';
        return false;
    }

    function handleDragEnter(event) {
        this.classList.add('over');
        currentDragElement = document.querySelector('[data-uuid="'+localStorage.getItem('currentDragElement')+'"]');

        console.log('dragged element ', currentDragElement , ' on element ', event.target)
    }

    function handleDragLeave(event) {
        this.classList.remove('over');
    }

    function handleDrop(event) {
        event.stopPropagation();
        event.preventDefault();

        if(localStorage.getItem('currentDragElement') == event.target.dataset.uuid) {
            return;
        }

        currentDragElement = document.querySelector('[data-uuid="'+localStorage.getItem('currentDragElement')+'"]');

        console.log('dragged element ', currentDragElement , ' on element ', event.target)

        localStorage.setItem('currentDragElement', null);

        return false;
    }

    function handleDragEnd(event) {
        [].forEach.call(draggableElements, function (element) {
            element.classList.remove('over');
        });
    }