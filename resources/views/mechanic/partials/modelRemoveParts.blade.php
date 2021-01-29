<!-- Modal -->
<div class="modal fade" id="removePartsModal" tabindex="-1" role="dialog" aria-labelledby="removePartsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removePartsModalLabel">Add Parts Used to Unit Repair</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/garage/remove/parts/multi" method="POST" class="form-horizontal" data-parsley-validate="true" name="demo-form">
                    @csrf
                    <input type="hidden" name="used_on" id="used_on" value="" />
                    <table class="table table" id="removePartsTable">
                        <thead>
                        <tr>
                            <th>Part</th>
                            <th>Qty</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: left;">
                                <input type="button" class="btn btn-lg btn-block " id="addPart" value="Add Row"/>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                        </tfoot>
                        </tbody>

                    </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>