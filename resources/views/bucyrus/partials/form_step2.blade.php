<!-- begin fieldset -->
					<fieldset>
						<!-- begin row -->
						<div class="row">
						    
							<!-- begin col-8 -->
							<div class="col-xl-8 offset-xl-2">
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 ">Please insert your response information</legend>
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Select Responding Unit Number <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<select class="form-control selectpicker" name="unit_id" data-size="10" data-parsley-group="step-2" data-parsley-required="true" data-live-search="true" data-style="btn-inverse " >
        									<option value="" disabled selected>Select Responding Unit</option>
        									@foreach($units as $row)
        									<option value="{{$row->unit_number}}">{{$row->unit_number}}</option>
        									@endforeach
        								</select>
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Type Address to Search <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="address_search" id="autocomplete" onFocus="geolocate()" placeholder="Begin Typing Address" data-parsley-group="step-2"   class="form-control" />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">House Number <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="street_number" id="street_number" placeholder="House Number" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Street Name <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" id="route" name="route"  placeholder="Street Name"  class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Additional Address Info <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="address2" placeholder="Additional Address Info" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">City <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="city" id="locality" placeholder="City" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Township <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
											<select class="form-control selectpicker" id="township" name="township" data-size="10" data-live-search="true" data-style="btn-inverse" data-parsley-group="step-2" data-parsley-required="true" >
        									<option value="" disabled selected>Select a Township</option>
        									@foreach($townships as $row)
        									<option value="{{$row->id}}">{{$row->name}} - {{$row->response_time}}</option>
        									@endforeach
        								</select>
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">State <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="state" id="administrative_area_level_1" placeholder="State" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Zip Code <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="zip" id="postal_code" placeholder="Zip Code" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Patient Last Name <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" name="patient"  placeholder="Patient Last Name" data-parsley-group="step-2" data-parsley-required="true" class="form-control" data-parsley-group="step-2"  />
									</div>
								</div>
								<!-- end form-group -->
							</div>
							<!-- end col-8 -->
						</div>
						<!-- end row -->
					</fieldset>
					<!-- end fieldset -->