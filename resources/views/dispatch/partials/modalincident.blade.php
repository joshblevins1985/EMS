
<!-- Modal -->
<div class="modal fade right" id="modalIncident" tabindex="-1" role="dialog" aria-labelledby="modalIncidentLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalIncidentLabel">New Incident</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        {!! Form::open(['route' => 'dispatch.store', 'id' => 'badrunsheets-form', 'class' => 'needs-validation']) !!}    
        
        @include('dispatch.partials.incidentForm')
        
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<!-- Modal -->