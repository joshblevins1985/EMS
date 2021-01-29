<!-- begin fieldset -->
					<fieldset>
						<!-- begin row -->
						<div class="row">
							<!-- begin col-8 -->
							<div class="col-xl-8 offset-xl-2">
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 ">Please insert your transport information</legend>
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Incident Call Type <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<select class="form-control selectpicker" name="incident_call_type" data-size="10" data-parsley-group="step-5" data-parsley-required="true" data-live-search="true" data-style="btn-inverse " >
        									<option value="" disabled selected>Select a Incident Type</option>
        									@foreach($incidenttype as $row)
        									<option value="{{$row->id}}">{{$row->description}}</option>
        									@endforeach
        								</select>
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Incident Type <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<select class="selectpicker form-control" name="incident_type" data-parsley-group="step-5" data-parsley-required="true" data-style="btn-inverse ">
                                            <option value="1">Emergency</option>
                                            <option value="2">Non-Emergency</option>
                                            <option value="3">Stand By</option>
                                          </select>
									</div>
								</div>
								<!-- end form-group -->
								
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Incident Level <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<select class="selectpicker form-control" name="incident_level" data-parsley-group="step-5" data-style="btn-inverse ">
                                            <option value="1">Basic Life Support</option>
                                            <option value="2" selected>Advanced Life Support</option>
                                          </select>
									</div>
								</div>
								<!-- end form-group -->
								<!-- begin form-group -->
								<div class="form-group row m-b-10">
									<label class="col-lg-3 text-lg-right col-form-label">Incident Disposition <span class="text-danger">*</span></label>
									<div class="col-lg-9 col-xl-6">
										<select class="selectpicker form-control" name="incident_disposition" data-parsley-group="step-5" data-style="btn-inverse ">
                                            <option value="1" selected>Treated and Transported</option>
                                            <option value="2">No Patient Found</option>
                                            <option value="3">Refusal AMA</option>
                                            <option value="4">Public Assist </option>
                                            <option value="5">Disregaurd</option>
                                          </select>
									</div>
								</div>
								<!-- end form-group -->
								
								
							</div>
							<!-- end col-8 -->
						</div>
						<!-- end row -->
					</fieldset>
					<!-- end fieldset -->