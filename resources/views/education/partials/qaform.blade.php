 <div class="row">

    <div class="col-lg-6 col-md-12">
        <div class="md-form">
            <input placeholder="Date of Run" type="text" id="date" name="date"  class="form-control datepicker" value="@if($edit) {{$qa->date}} @else{{old('date')}}@endif" >
            <label for="doi">Date of Run</label>
        </div>
        <div class="md-form">
            <select class="mdb-select" id="employee_id" name="employee_id" searchable="Search here.." >
                <option value="default" disabled selected>Select Authoring Employee</option>
                @foreach($employees as $id => $employee)
                <option value="{{$id}}" 
                        @if($edit) 
                        @if($qa->employee_id == $id) 
                        selected
                        @endif
                        @else
                        @if(old('employee_id') == $id) selected @endif 
                        @endif
                        >{{$employee}}</option>
                @endforeach          
            </select> 
            @if ($errors->has('employee_id')) 
            The date field is required.
            @endif

        </div>


        <div class="md-form">
            <input type="text" id="location" name="location" value="@if($edit){{$qa->location}} @else{{old('location')}}@endif"  class="form-control" placeholder='Enter pick up location of run.'>

        </div>


        <select class="mdb-select md-form" name="protocol">
            <option value="" disabled selected>Select Protocol </option>
            @foreach($protocols as $id => $protocol)
            <option value="{{$id}}"
                    @if($edit) 
                    @if($qa->protocol == $id) 
                    selected
                    @endif
                    @else
                    @if(old('protocol') == $id) selected @endif
                    @endif
                    >{{$protocol}}</option>
            @endforeach
        </select>

        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="defaultGroupExample1" value="1" name="grade"
                   @if($edit)
                   @if($qa->grade == 1) checked 
                   @endif
                   @else
                   @if(old('grade') == 1) checked @else checked @endif
                   
                   @endif
                   >
                   <label class="custom-control-label" for="defaultGroupExample1">Sufficient</label>
        </div>

        <!-- Group of default radios - option 2 -->
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" value="2" id="defaultGroupExample2" name="grade"
                   @if($edit)
                   @if($qa->grade == 2) checked
                   @endif
                   @else
                   @if(old('grade') == 2) checked  @endif
                   @endif
                   >
                   <label class="custom-control-label" for="defaultGroupExample2">Insufficient</label>
        </div>

        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="eresponse1" value="1" name="eresponse" checked>
            <label class="custom-control-label" for="eresponse1">No Response Needed</label>
        </div>
        <!-- Group of default radios - option 2 -->
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" value="2" id="eresponse2" name="eresponse">
            <label class="custom-control-label" for="eresponse2">Request for Incident Report</label>
        </div>

        <div class="form-group">
            <label for="comments">Comments</label>
            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" name="comments" rows="10" >
                                    @if($edit)
                                    {!!$qa->comments!!}

                                    @else
                                    @if(!old('comments')) 
                                <p><strong>Patient Initials: </strong> </p>
                                <p><strong>Reason for Transport: </strong> </p>
                                <p>Documentation for qualification for ambulance -- </p>
                                @else
                                {!!old('comments')!!}
                                @endif
                                    @endif

            </textarea>

        </div>
        
        <div class="co-lg-12 col-md-12">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="minus0" value="0" name="minus"
                                       checked >
                                       <label class="form-check-label text-success" for="minus0">None (-0%)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="minus5" value="5" name="minus"
                                       >
                                       <label class="form-check-label text-success" for="minus5">Minor (-5%)</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="10" id="minus10" name="minus"
                                       >
                                       <label class="form-check-label text-warning" for="minus10">Moderate (-10%)</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="15" id="minus15" name="minus"
                                       
                                       >
                                       <label class="form-check-label text-danger" for="minus15">Severe (-15%)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="20" id="minus20" name="minus"
                                      
                                       >
                                       <label class="form-check-label text-danger" for="minus20">Critical (-20%)</label>
                            </div>
                        </div>
        
        <table id="employee_table" align=center class="table table">
            <tr>
                <th>Select All Opportunity Found</th>
            </tr>
            <tr id="row1">
                <td> <div class ="md-form"><input type='text' class='form-control' name='deficiencies[]' placeholder='Describe Opportunity'></div> </td>
            </tr>
        </table>
        <input type="button" class="btn btn-primary" onclick="add_row();" value="ADD ROW">
        <input type="submit" class="btn btn-success" name="submit_row" id="qa-submit" value="SUBMIT">
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            1. Were the crew's full names, certifications, unit info, and patient demographics completed?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q1_1" value="10" name="q1"
                                       @if($edit)
                                       @if($qa->q1 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q1') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q1_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="5" id="q1_2" name="q1"
                                       @if($edit)
                                       @if($qa->q1 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q1') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q1_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q1_3" name="q1"
                                       @if($edit)
                                       @if($qa->q1 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q1') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q1_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            2. Was the patient evaluation clearly and fully documented?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q2_1" value="20" name="q2"
                                       @if($edit)
                                       @if($qa->q2 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q2') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q2_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="10" id="q2_2" name="q2"
                                       @if($edit)
                                       @if($qa->q2 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q2') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q2_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q2_3" name="q2"
                                       @if($edit)
                                       @if($qa->q2 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q2') == 2) checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q2_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            3. Was the method used to transfer patient to the stretcher clearly documented?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q3_1" value="10" name="q3"
                                       @if($edit)
                                       @if($qa->q3 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q3') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q3_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="5" id="q3_2" name="q3"
                                       @if($edit)
                                       @if($qa->q3 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q3') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q3_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q3_3" name="q3"
                                       @if($edit)
                                       @if($qa->q3 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q3') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q3_3">Insufficient</label>
                            </div>
                        </div> 
                    </div>

                </div>
            </div>

        </div>

        <div class="row">

            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            4. Was the reason the patient requires stretcher clearly documented?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q4_1" value="20" name="q4"
                                       @if($edit)
                                       @if($qa->q4 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q4') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q4_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="10" id="q4_2" name="q4"
                                       @if($edit)
                                       @if($qa->q4 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q4') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q4_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q4_3" name="q4"
                                       @if($edit)
                                       @if($qa->q4 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q4') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q4_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            5. Was the treatment appropriate, justified, and clearly documented?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q5_1" value="30" name="q5"
                                       @if($edit)
                                       @if($qa->q5 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q5') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q5_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="15" id="q5_2" name="q5"
                                       @if($edit)
                                       @if($qa->q5 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q5') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q5_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q5_3" name="q5"
                                       @if($edit)
                                       @if($qa->q5 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q5') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q5_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            6. Were all protocols followed during transport?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q6_1" value="10" name="q6"
                                       @if($edit)
                                       @if($qa->q6 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q6') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q6_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="5" id="q6_2" name="q6"
                                       @if($edit)
                                       @if($qa->q6 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q6') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q6_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q6_3" name="q6"
                                       @if($edit)
                                       @if($qa->q6 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q6') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q6_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            7. Were all times clearly documented?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q7_1" value="10" name="q7"
                                       @if($edit)
                                       @if($qa->q7 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q7') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q7_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="5" id="q7_2" name="q7"
                                       @if($edit)
                                       @if($qa->q7 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q7') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q7_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q7_3" name="q7"
                                       @if($edit)
                                       @if($qa->q7 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q7') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q7_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            8. Was the writing legible?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q8_1" value="10" name="q8"
                                       @if($edit)
                                       @if($qa->q8 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q8') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q8_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="5" id="q8_2" name="q8"
                                       @if($edit)
                                       @if($qa->q8 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q8') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q8_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q8_3" name="q8"
                                       @if($edit)
                                       @if($qa->q8 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q8') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q8_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            9. Were all required signatures for crew and patient completed?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q9_1" value="10" name="q9"
                                       @if($edit)
                                       @if($qa->q9 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q9') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q9_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="5" id="q9_2" name="q9"
                                       @if($edit)
                                       @if($qa->q9 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q9') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q9_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q9_3" name="q9"
                                       @if($edit)
                                       @if($qa->q9 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q9') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q9_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-6 col-md-6">
                            10. Is all associated documentation attached to the PCR ie. Facesheet, Doctor Cert?
                        </div>

                        <div class="co-lg-6 col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="q10_1" value="20" name="q10"
                                       @if($edit)
                                       @if($qa->q10 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q10') == 1) checked @else checked @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-success" for="q10_1">Sufficient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="10" id="q10_2" name="q10"
                                       @if($edit)
                                       @if($qa->q10 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q10') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-warning" for="q10_2">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" value="0" id="q10_3" name="q10"
                                       @if($edit)
                                       @if($qa->q10 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q10') == 2) checked  @endif
                                       @endif
                                       >
                                       <label class="form-check-label text-danger" for="q10_3">Insufficient</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        
        <div class="row">
            <input type="file" id="file" class="form-control mt-3" name="pdf[]" multiple />
            <label for="file">PCR Upload</label>
        </div>
    </div>

</div>