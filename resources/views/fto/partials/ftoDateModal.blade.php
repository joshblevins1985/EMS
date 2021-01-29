<!-- Modal -->
<div class="modal fade" id="ftoDateModal" tabindex="-1" role="dialog" aria-labelledby="ftoDateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ftoDateModalLabel">Add New Training Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         {!! Form::open(['route' => 'orientation.store', 'id' => 'ftoForm']) !!}
         <div id="ftoFomr">
             
         </div>
         
         {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
