
<!-- Modal -->
<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-primary">
                <h5 class="modal-title" id="unitModalLabel">Add New Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/unit" id="formValidate" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Unit Identification Number</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <input type="text" class="form-control" name="unitNumber" required>
                    </div>
                    <div class="form-group">
                        <label>Level of Care</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <select class="form-control select2" style="width: 100%" name="stationId" required >
                            @foreach($stations as $row)
                                <option value="{{$row->id}}"> {{$row->description}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Vehicle Identification Number</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <input type="text" class="form-control" name="vin" required>
                    </div>
                    <div class="form-group">
                        <label>Make</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <input type="text" class="form-control" name="make" required>
                    </div>
                    <div class="form-group">
                        <label>Model</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <input type="text" class="form-control" name="model" required>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <input type="text" class="form-control" name="year" required>
                    </div>
                    <div class="form-group">
                        <label>License Plate Number</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <input type="text" class="form-control" name="licensePlate" >
                    </div>
                    <div class="form-group">
                        <label>License Plate Expiration</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <div class='input-group datetime' >
                            <input type='text' class="form-control datetime" name="licensePlateExpiration" required />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Odometer</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <input type="text" class="form-control" name="odometer" >
                    </div>
                    <div class="form-group">
                        <label>Last Date Odometer Read</label>
                        <div class="help-block form-text with-errors form-control-feedback"></div>
                        <div class='input-group datetime' >
                            <input type='text' class="form-control datetime" name="odometerDate" />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-success">Add New Unit</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


