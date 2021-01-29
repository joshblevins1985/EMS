@extends('layouts.default')

@section('page-title', trans('Mechanic Tasks'))
@section('page-heading', trans('Maintanance Tasks'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Mechanic Tasks')
</li>
@stop

@section('content')

@include('partials.toastr')

<div class="row">
    <div class="col-xl-5 mr-4">
        <div class="col-xl-12 mb-4">
            <div class="card" style="height:500px">
              <div class="card-header bg-danger text-center">
                 <h3>UNITS ASSIGNED TO ME</h3>
              </div>
              <div class="card-body">
                  <div class="col-xl-12">
                    <ul class="list-group" id="myPending">
                        
                    </ul>
                  </div>
              </div>
            </div>
        </div>
        
        <div class="col-xl-12">
          <div class="card" style="height:500px">
              <div class="card-header bg-warning text-center">
                 <h3> PENDING UNITS NOT ASSIGEND TO ME</h3>
              </div>
              <div class="card-body">
                <div class="col-xl-12">
                  <ul class="list-group" id="pending">
                      
                  </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="col-xl-12 mb-4">
          <div class="card" style="height:500px">
              <div class="card-header bg-danger text-center">
                 <h3> MY SERVICE TICKETS </h3>
              </div>
              <div class="card-body">
                <div class="col-xl-12">
                  <ul class="list-group" id="service">
                      
                  </ul>
                </div>
            </div>
            </div>
        </div>
        
        <div class="col-xl-12">
          <div class="card" style="height:500px">
              <div class="card-header bg-success text-dark text-center">
                 <h3> MY COMPLETED SERVICE TICKETS</h3>
              </div>
              <div class="card-body">
                <div class="col-xl-12">
                  <ul class="list-group" id="closedService">
                      
                  </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@stop
@include('mechanic.partials.modalServiceTicket')
@section('styles')

@stop

@push('scripts')
<script>
  function loadlink(){
    $('#myPending').load('/garageMyPending',function () {
         $(this).html();
    });
}
function loadpending(){
  $('#pending').load('/garagePending',function () {
       $(this).html();
  });
}

function loadserviceTickets(){
  $('#service').load('/garageMyServiceTickets',function () {
       $(this).html();
  });
}

function loadOldServiceTickets(){
  $('#closedService').load('/garageAllMyServiceTickets',function () {
       $(this).html();
  });
}

loadlink(); // This will run on page load
loadpending();
loadserviceTickets();
loadOldServiceTickets();

setInterval(function(){
    loadlink();
    loadpending();// this will run after every 5 seconds
    loadserviceTickets();
}, 60000);

jQuery(function ($) {
  $(document).on('change', 'input:radio[id^="option"]', function (event) {
      selected_value = $("input[name='service_ticket']:checked").val();
      if(selected_value == 1){
        console.log('clicked add to current')
        $('#my_service_tickets').show();
        $('#my_service_tickets').load('/myServiceTickets',function () {
          $(this).html();
        });
      }else{
        $('#my_service_tickets').hide();
      }
  });
});

  $('#modalServiceTicket').on('show.bs.modal', function(e) {
      var unitId = $(e.relatedTarget).data('unit_id');
      $('#service_ticket_form').attr('action', '/newServiceTicket/'+ unitId);
  });

</script>

@endpush

