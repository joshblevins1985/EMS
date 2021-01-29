<!-- Modal -->
<div class="modal fade" id="employeeSignatureModal" tabindex="-1" role="dialog" aria-labelledby="employeeSignatureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeSignatureModalLabel">Employee Signature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12">
                    <p>Application: For personal respiratory protection in Airborne Precaution Isolatiion Rooms. not for use for any application other than the use for which individual trained for which is:</p>

                    <p>
                        Personal Respiratory Protection in EMS Airborne Isolation. I understand that I must wear the size
                        and brand of N-95 / K-95 / Other respirator listed on this certificate, for my personal respiratory protection. If I enter
                        an AIRBORNE isolation area, and the N-95 / K-95 / Other Respirtor is disposable and is not to be reused(*).
                    </p>

                    <p>
                        I understand that a bear and or mustache will interfere with respirator-to-face seal and therefore I am required to remove any facial hair that inhibits the proper seal of the N-95 / K95 / Other Respirator for personal respiratory protection in order to fulfill my job requirements.
                    </p>
                </div>
                <div class="col-xl-12">
                    <button type="button" class="btn btn-primary btn-sm btn-block" id="employeeSign" data-id="{{$fit->id}}"  >I've read the above statement and agree that I have been tested.</button>

                </div>
            </div>
        </div>
    </div>
</div>