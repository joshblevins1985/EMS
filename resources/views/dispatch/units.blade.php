@extends('layouts.sidebar-fixed')

@section('page-title', trans('Dispatch'))
@section('page-heading', trans('Dispatch'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Dispatch')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="row pb-3">
    <div class="col-lg-6">
        
            <form class="form-inline" role="search" method="GET" action="{{url('dispatch/units')}}">

          <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here.." index="station" name="station[]">
            <option value="" disabled selected>Choose your stations</option>
            @foreach($stations as $row)
            <option value="{{$row->id}}">{{$row->station}}</option>
            @endforeach
          </select>
        
        <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here.." index="care" name="care[]">
            <option value="" disabled selected>Choose your levels</option>
            <option value="1">Ambulette / Car</option>
            <option value="2">Basic</option>
            <option value="3">Advanced</option>
            <option value="4">Medic</option>
            <option value="5">MICU</option>
          </select>
        
    </div>

    
    <div class="col-lg-2">
        <div class="col-md-12">

          <button class="btn btn-primary" type="submit"><i class="fab fa-searchengin"></i>Set Preference</button>
            
        </div>
    </div>
    </form>
    <div class="col-lg-2" onload="startTime()">
        <div id="txt"></div>
    </div>
    <div class="col-lg-2">
        <button type="button" class="btn btn-danger btn-rounded" data-toggle="modal" data-target="#modalIncident">New Response</button>
    </div>
</div>
<div class="row">

    <div class="col-lg-12 col-md-12 border border-primary scrollBar" style="height: 1000px;">
        <div class="col-sm-12">
                <h3 class="note note-primary text-center"><strong>Units</strong></h3>

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h4 class="note note-success text-center"><strong>ACTIVE UNITS</strong></h4>
                            <div id="units_area">
                            
                                @include('dispatch.partials.card_avail_units')
                            
                            </div>
                        </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>


@include('dispatch.partials.modalunitstatus')
@include('dispatch.partials.modalunit')


@stop

@section('styles')
 <style>

.scrollBar {
  overflow-y: scroll;
}

 </style>
@stop
 
@section('scripts')
<script>
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
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    var search = window.location.search;
    var auto_refresh = setInterval(
        function(){
            $('#units_area').load('{{url('active_units')}}/' + search);
        },5000)
</script>

<script>

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


</script>


<script>
    $('#unitModal').on('show.bs.modal', function (event) {
        
        console.log('Modal Opened')
      var button = $(event.relatedTarget) // Button that triggered the modal
      var title = button.data('title') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var unitid = $(event.relatedTarget).data('uuid');
      var display = data();
      var modal = $(this)
      modal.find('.modal-title').text(title)
      modal.find('.modal-body input').val(title)
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
    
        function data(){
            $('#ubody').load('/unit_modal/' + unitid);
        }
        
        document.getElementById("ubody").innerHTML = display;
           
    
    })
</script>


<script>
    $('html').bind('keypress', function(e)
{
   if(e.keyCode == 13)
   {
      return false;
   }
});
</script>
@stop