

<!-- Modal -->
<div class="modal fade" id="unitstatusModal" tabindex="-1" role="dialog" aria-labelledby="unitstatusModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unitstatusModalLabel">Changing Unit Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to asign unit &nbsp<span id="unit"></span> &nbsp to &nbsp <span id="message"></span>.
        {!! Form::open(['route' => 'dispatch.signon', 'id' => 'dispatch-signon']) !!}    
       
        <input type="hidden" id="unitInput" name="unit" value="" /> 
        <input type="hidden" id="statusInput" name="status" value="" /> 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Change Status</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>