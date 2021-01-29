<!-- Modal -->
<div class="modal fade" id="modalSafetyReport" tabindex="-1" role="dialog" aria-labelledby="SafetyReportModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SafetyReportModalLabel">Add New Safety Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/safetyReportSave/{{ $ticket->id }}" method="POST">
                    @csrf
                    <input type="hidden" id="safety_unit_id" name="unit_id" value="">  
                    <div id="safeyReport">

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