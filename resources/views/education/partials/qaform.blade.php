<div class="row">

    <div class="col-lg-6 col-md-12">
        <div class="md-form">
            <label for="doi">Date of Run</label>
            <input placeholder="Date of Run" type="text" id="date" name="date" class="form-control datepicker"
                   value="@if($edit) {{$qa->date}} @else{{old('date')}}@endif">
        </div>
        <div class="md-form">
            <label >Employee</label>
            <select class="select2 form-control" id="employee_id" name="employee_id" searchable="Search here..">
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
            <label >Pick Up Location</label>
            <input type="text" id="location" name="location"
                   value="@if($edit){{$qa->location}} @else{{old('location')}}@endif" class="form-control"
                   placeholder='Enter pick up location of run.'>

        </div>

        <label >Protocol </label>
        <select class="select2 form-control" name="protocol">
            <option value="" disabled selected>Select Protocol</option>
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

        <div class="co-lg-12 col-md-12" >
            <label class="radio-inline text-success">
                <input type="radio" value="1" name="grade"
                       @if($edit)
                       @if($qa->grade == 1) checked
                       @endif
                       @else
                       @if(old('grade') == 1) checked @else checked @endif

                        @endif
                >Suffcient
            </label>

            <label class="radio-inline text-danger">
                <input type="radio" value="2" name="grade"
                       @if($edit)
                       @if($qa->grade == 2) checked
                       @endif
                       @else
                       @if(old('grade') == 2) checked @endif
                        @endif
                >Insufficent
            </label>
        </div>

        <div class="co-lg-12 col-md-12" >
            <label class="radio-inline text-success">
                <input type="radio" value="1" name="eresponse" checked>No Response Needed
            </label>

            <label class="radio-inline text-danger">
                <input type="radio" value="2" name="eresponse">Request for Incident Report
            </label>
        </div>

        <div class="form-group">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Comments</h4>

                </div>
                <div class="panel-body">
                    <textarea class="textarea form-control" style="color:black" id='editor' name="comments" rows="12">
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
            </div>
            <!-- end panel -->


        </div>

        <div class="co-lg-12 col-md-12" >
            <label class="radio-inline text-success">
                <input type="radio" id="minus0" value="0" name="minus" checked>None (-0%)
            </label>
            <label class="radio-inline text-success">
                <input type="radio" id="minus5" value="5" name="minus">Minor (-5%)
            </label>
            <label class="radio-inline text-warning">
                <input type="radio" id="minus10" value="10" name="minus">Moderate (-10%)
            </label>
            <label class="radio-inline text-danger">
                <input type="radio" id="minus15" value="15" name="minus">Moderate (-15%)
            </label>
            <label class="radio-inline text-danger">
                <input type="radio" id="minus20" value="20" name="minus">Severe (-20%)
            </label>
        </div>

        <table id="employee_table" align=center class="table table">
            <tr>
                <th>Select All Opportunity Found</th>
            </tr>
            <tr id="row1">
                <td>
                    <div class="md-form"><input type='text' class='form-control' name='deficiencies[]' value="NA"
                                                placeholder='Describe Opportunity'></div>
                </td>
            </tr>
        </table>
        <input type="button" class="btn btn-block btn-primary" onclick="add_row();" value="ADD ROW">

    </div>

    <div class="col-lg-6 col-md-12">
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            1. Were the crew's full names, certifications, unit info, and patient demographics
                            completed?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q1_1" value="10" name="q1"
                                       @if($edit)
                                       @if($qa->q1 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q1') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q1_2" value="5" name="q1"
                                       @if($edit)
                                       @if($qa->q1 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q1') == 2) checked  @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q1_3" value="0" name="q1"
                                       @if($edit)
                                       @if($qa->q1 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q1') == 3) checked  @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            2. Was the patient evaluation clearly and fully documented?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q2_1" value="20" name="q2"
                                       @if($edit)
                                       @if($qa->q2 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q2') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q2_2" value="10" name="q2"
                                       @if($edit)
                                       @if($qa->q2 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q2') == 2) checked
                                        @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q2_3" value="0" name="q2"
                                       @if($edit)
                                       @if($qa->q2 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q2') == 3) checked
                                        @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            3. Was the method used to transfer patient to the stretcher clearly documented?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q3_1" value="10" name="q3"
                                       @if($edit)
                                       @if($qa->q3 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q3') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q3_2" value="5" name="q3"
                                       @if($edit)
                                       @if($qa->q3 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q3') == 2) checked
                                        @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q3_3" value="0" name="q3"
                                       @if($edit)
                                       @if($qa->q3 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q3') == 3) checked
                                        @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">

            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            4. Was the reason the patient requires stretcher clearly documented?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q4_1" value="20" name="q4"
                                       @if($edit)
                                       @if($qa->q4 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q4') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q4_2" value="10" name="q4"
                                       @if($edit)
                                       @if($qa->q4 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q4') == 2) checked
                                        @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q4_3" value="0" name="q4"
                                       @if($edit)
                                       @if($qa->q4 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q4') == 3) checked
                                        @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            5. Was the treatment appropriate, justified, and clearly documented?
                        </div>
                        <div class="co-lg-12 col-md-12">
                        <label class="radio-inline text-success">
                            <input type="radio" id="q5_1" value="30" name="q5"
                                   @if($edit)
                                   @if($qa->q5 == 1) checked
                                   @endif
                                   @else
                                   @if(old('q5') == 1) checked @else checked @endif
                                    @endif
                            >Sufficient
                        </label>
                        <label class="radio-inline text-warning">
                            <input type="radio" id="q5_2" value="15" name="q5"
                                   @if($edit)
                                   @if($qa->q5 == 2) checked
                                   @endif
                                   @else
                                   @if(old('q5') == 2) checked
                                    @endif
                                    @endif
                            >Needs Improvement
                        </label>

                        <label class="radio-inline text-danger">
                            <input type="radio" id="q5_3" value="0" name="q5"
                                   @if($edit)
                                   @if($qa->q5 == 3) checked
                                   @endif
                                   @else
                                   @if(old('q5') == 3) checked
                                    @endif
                                    @endif
                            >Insufficient
                        </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            6. Were all protocols followed during transport?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q6_1" value="10" name="q6"
                                       @if($edit)
                                       @if($qa->q6 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q6') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q6_2" value="5" name="q6"
                                       @if($edit)
                                       @if($qa->q6 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q6') == 2) checked
                                        @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q6_3" value="0" name="q6"
                                       @if($edit)
                                       @if($qa->q6 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q6') == 3) checked
                                        @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            7. Were all times clearly documented?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q7_1" value="10" name="q7"
                                       @if($edit)
                                       @if($qa->q7 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q7') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q7_2" value="5" name="q7"
                                       @if($edit)
                                       @if($qa->q7 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q7') == 2) checked
                                        @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q7_3" value="0" name="q7"
                                       @if($edit)
                                       @if($qa->q7 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q7') == 3) checked
                                        @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            8. Was the writing legible?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q8_1" value="10" name="q8"
                                       @if($edit)
                                       @if($qa->q8 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q8') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q8_2" value="5" name="q8"
                                       @if($edit)
                                       @if($qa->q8 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q8') == 2) checked
                                        @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q8_3" value="0" name="q8"
                                       @if($edit)
                                       @if($qa->q8 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q8') == 3) checked
                                        @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            9. Were all required signatures for crew and patient completed?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q9_1" value="10" name="q9"
                                       @if($edit)
                                       @if($qa->q9 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q9') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q9_2" value="5" name="q9"
                                       @if($edit)
                                       @if($qa->q9 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q9') == 2) checked
                                        @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q9_3" value="0" name="q9"
                                       @if($edit)
                                       @if($qa->q9 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q9') == 3) checked
                                        @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="co-lg-12 col-md-12">
                            10. Is all associated documentation attached to the PCR ie. Facesheet, Doctor Cert?
                        </div>

                        <div class="co-lg-12 col-md-12">
                            <label class="radio-inline text-success">
                                <input type="radio" id="q10_1" value="20" name="q10"
                                       @if($edit)
                                       @if($qa->q10 == 1) checked
                                       @endif
                                       @else
                                       @if(old('q10') == 1) checked @else checked @endif
                                        @endif
                                >Sufficient
                            </label>
                            <label class="radio-inline text-warning">
                                <input type="radio" id="q10_2" value="10" name="q10"
                                       @if($edit)
                                       @if($qa->q10 == 2) checked
                                       @endif
                                       @else
                                       @if(old('q10') == 2) checked
                                        @endif
                                        @endif
                                >Needs Improvement
                            </label>

                            <label class="radio-inline text-danger">
                                <input type="radio" id="q10_3" value="0" name="q10"
                                       @if($edit)
                                       @if($qa->q10 == 3) checked
                                       @endif
                                       @else
                                       @if(old('q10') == 3) checked
                                        @endif
                                        @endif
                                >Insufficient
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>


    </div>

</div>

<div class="row">
    <input type="file" id="file" class="form-control mt-3" name="pdf[]" multiple/>
    <label for="file">PCR Upload</label>
</div>

<div class="row">
    <div class="col-xl-12">
        <input type="submit" class="btn btn-block btn-success" name="submit_row" id="qa-submit" value="SUBMIT">
    </div>

</div>