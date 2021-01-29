<!-- Modal -->
<div class="modal fade right" id="modalAlertSearch" tabindex="-1" role="dialog" aria-labelledby="modalAlertSearchLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSendMessageLabel">Send Message to Crew</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

                <div class="row mb-2">
                    <div class="col-lg-12">

                        <!-- Material input -->

                        <input type="text" id="autocomplete" placeholder="Enter your address"
                               onFocus="geolocate()"  class="form-control validate" >


                    </div>
                </div>

                <div class="row mb-2">

                    <div class="col-lg-2">
                        <!-- Material input -->

                        <input type="text" id="street_number" name="house_number" class="form-control" disabled>
                        <label for="house_number"><span class="text-danger">House Number</span></label>

                    </div>
                    <div class="col-lg-4">
                        <!-- Material input -->

                        <input type="text" id="route" name="incident_address" class="form-control" disabled>
                        <label for="address"><span class="text-danger">Street Name</span></label>

                    </div>
                    <div class="col-lg-6">
                        <!-- Material input -->

                        <input type="text" id="address_2" name="address_2" class="form-control">
                        <label for="address_2"><span class="text-warning">If no valid address type address here.</span></label>

                    </div>

                </div>

                <div class="row mb-2">

                    <div class="col-lg-3">
                        <!-- Material input -->

                        <input type="text" id="locality" name="incident_city" class="form-control">
                        <label for="city"><span class="text-danger">City</span></label>

                    </div>
                    <div class="col-lg-3">
                        <!-- Material input -->

                        <input type="text" id="administrative_area_level_1" name="incident_state" class="form-control">
                        <label for="state"><span class="text-danger">State</span></label>

                    </div>
                    <div class="col-lg-2">
                        <!-- Material input -->

                        <input type="text" id="postal_code" name="incident_zip" class="form-control">
                        <label for="zip"><span class="text-danger">Zip</span></label>

                    </div>
                    <div class="col-lg-4">
                        <!-- Material input -->

                        <input type="text" id="phone" name="incident_phone" class="form-control" value="">
                        <label for="phone">Phone</label>

                    </div>


                </div>

                <div class="row">
                    <div class="col-xl-12" id="alerts">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->