<!-- Modal -->
<div class="modal fade" id="modalServiceTicket" tabindex="-1" role="dialog" aria-labelledby="modalServiceTicketLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalServiceTicketLabel">Service Ticket Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="service_ticket_form" method="post">
            @csrf
        <div class="row mb-1">
          <div class="btn-group btn-group-toggle" id="my_radio_box" data-toggle="buttons">
              <label class="btn btn-secondary active">
                <input type="radio" name="service_ticket" id="option_1" autocomplete="off" value="0" checked> Start New
              </label>
              <label class="btn btn-secondary">
                <input type="radio" name="service_ticket" id="option_2" autocomplete="off" value="1"> Add to Current Ticket
              </label>
            </div>
        </div>

        <div class="row" id="my_service_tickets">
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    
</script
