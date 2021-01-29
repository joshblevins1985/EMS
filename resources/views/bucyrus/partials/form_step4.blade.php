<!-- begin fieldset -->
					<fieldset>
						<!-- begin row -->
						<div class="row">
							<!-- begin col-8 -->
							<div class="col-xl-8 offset-xl-2">
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 ">Please insert your transport information</legend>
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Select Facility Transported To <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<select class="form-control selectpicker" name="txp_facility" data-size="10" data-live-search="true" data-style="btn-inverse " >
        									<option value="" disabled selected>Select a facility</option>
        									@foreach($facilities as $row)
        									<option value="{{$row->id}}">{{$row->abbreviation}}-{{$row->name}}</option>
        									@endforeach
        								</select>
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">House Number <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="street_number_txp" id="street_number_txp" placeholder="House Number" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Street Name <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" id="route_txp" name="route_txp"  placeholder="Street Name" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Additional Address Info <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="address2_txp" placeholder="Additional Address Info" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">City <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="city_txp" id="locality_txp" placeholder="City" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
						
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">State <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="state_txp" id="administrative_area_level_1_txp" placeholder="State" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Zip Code <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="zip_txp" id="postal_code_txp" placeholder="House Number" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								
							</div>
							<!-- end col-8 -->
						</div>
						<!-- end row -->
					</fieldset>
					<!-- end fieldset -->