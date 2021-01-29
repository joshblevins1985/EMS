<!-- Modal -->
<div class="modal fade" id="unitMilesUpdateModal" tabindex="-1" role="dialog" aria-labelledby="unitMilesUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unitMilesUpdateModalLabel">Unit Mileage Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="unit/Mileage" id="mileageUpdateForm" method="post">
    
            @csrf
            <input type="hidden" id="unit_id" name="unit_id" />
           
            
            <div class="form-group">
                <input type="type" class="form-control" name="odometer" placeholder="Enter New Mileage" />
            </div>
         
        	
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Update Mileage</button>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>