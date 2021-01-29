<!-- Modal -->
<div class="modal fade" id="narcoticOutModal" tabindex="-1" role="dialog" aria-labelledby="narcoticOutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ftoDateModalLabel">Scan the Narcotic Box RFID badge.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form>
          <div class="row mb-2">
              <div class="col-xl-12">
                  <input type="text" id="box_rfid" class="form-control" placeholder="Scan Box Here" />
              </div>
          </div>

          <div id="box_confirm">
              
          </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" disabled>Sign Out This Box</button>
      </div>
    </div>
  </div>
</div>
