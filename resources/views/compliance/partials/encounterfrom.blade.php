@csrf
<div class="row">
<div class="col-lg-6 col-sm-12 col-md-12">
    <div class="md-form">
        <input placeholder="Date of Incident" type="text" id="doi" name="doi" value="@if($edit == true) {{$encounter->doi}}  @endif" class="form-control datepicker">
        <label for="doi">Date of Incident</label>
    </div>
</div>

<div class="col-lg-6 col-sm-12 col-md-12">
    <div class="row">
  <div class="col-md-12">

    <select class="mdb-select colorful-select dropdown-primary md-form" id="user_id"  @if($edit == true ) name="user_id" @else name="user_id[]" @endif  multiple searchable="Search here..">
      <option value="" disabled selected>Choose your country</option>
      @foreach($employees as $id => $employee_name)
        <option value="{{$id}}" @if($edit == true && $id == $encounter->user_id) selected  @endif>{{$employee_name}}</option>
        @endforeach
    </select>
    <label class="mdb-main-label">Employee</label>
    

  </div>
</div>

    
</div>

</div>

<div class="row">
    <div class="col-lg-6 col-sm-12 col-md-12">
        
        <select class="mdb-select" id="encounter_type" name="encounter_type">
    <option value="" disabled selected>Choose your option</option>
    <option value="1" @if($edit == true && $encounter->encounter_type == 1) selected  @endif>File Notation</option>
    <option value="2"@if($edit == true && $encounter->encounter_type == 2) selected  @endif>Corrective Counciling</option>
    <option value="3"@if($edit == true && $encounter->encounter_type == 3) selected  @endif>Verbal Warning</option>
    <option value="4" @if($edit == true && $encounter->encounter_type == 4) selected  @endif>Written Warning</option>
    <option value="5" @if($edit == true && $encounter->encounter_type == 5) selected  @endif>Suspension</option>
    <option value="6"@if($edit == true && $encounter->encounter_type == 6) selected  @endif>Termination</option>
    <option value="7"@if($edit == true && $encounter->encounter_type == 7) selected  @endif>Resignation</option>
    <option value="8"@if($edit == true && $encounter->encounter_type == 8) selected  @endif>Deemed Non-Driver</option>
    <option value="9"@if($edit == true && $encounter->encounter_type == 9) selected  @endif>Last Chance Agreement</option>
</select>
<label>Encounter Type</label>
</div>
         
        
        
    
    <div class="col-lg-6 col-sm-12 col-md-12">
        
    <!-- Default inline 1-->
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d1" name="department" value="1" @if($edit == true && $encounter->department == 1) checked  @endif>
          <label class="custom-control-label" for="d1">Compliance</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d2" name="department" value="2" @if($edit == true && $encounter->department == 2) checked  @endif>
          <label class="custom-control-label" for="d2">Training</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d3" name="department" value="3" @if($edit == true && $encounter->department == 3) checked  @endif>
          <label class="custom-control-label" for="d3">Human Resources</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d4" name="department" value="4" @if($edit == true && $encounter->department == 4) checked  @endif>
          <label class="custom-control-label" for="d4">Email</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="d5" name="department" value="5" @if($edit == true && $encounter->department == 5) checked  @endif>
          <label class="custom-control-label" for="d5">Other</label>
        </div>
    </div>

</div>

<div class="row">
<div class="col-lg-6 col-sm-12 col-md-12">
    <select class="mdb-select" id="policy" name="policy" >
        <option value="" disabled selected>Choose Violated Policy</option>
        @foreach($policies as $id => $policy)
        <option value="{{$id}}" @if($edit == true && $id == $encounter->policy) selected  @endif>{{$policy}}</option>
        @endforeach
    </select>
</div>

<div class="col-lg-6 col-sm-12 col-md-12">
    <select class="mdb-select" id="company" name="company" >
        <option value="" disabled selected>Choose Company</option>
        @foreach($companies as $row)
        <option value="{{$row->id}}" @if($edit == true && $row->id == $encounter->company_id) selected  @endif>{{$row->name}}</option>
        @endforeach
    </select>
</div>

</div>

<div class="row">
<div class="col-lg-6 col-sm-12 col-md-12">
    <div class="md-form">
        <input placeholder="Follow up Date" type="text" id="fu_date" name="fu_date" @if($edit == true) value="{{$encounter->fu_date}}"  @endif class="form-control datepicker">
        <label for="fu_date">Follow up By</label>
    </div>
</div>

<div class="col-lg-6 col-sm-12 col-md-12">
    
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ir1" name="ir" value="1" >
          <label class="custom-control-label" for="ir1"><span style="color:red">Do not request incident report</span></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="ir2" name="ir" value="2">
          <label class="custom-control-label" for="ir2">Request Incident Report</label>
        </div>
    
        <!-- Default inline 1-->
    
</div>

</div>

<div class="row">
<div class="col-lg-6 col-sm-12 col-md-12">
    <div class="form-group">
        <label for="incident_report">Incident Reported</label>
        <textarea class="form-control rounded-0 ir" id="incident_report" name="incident_report" rows="10">@if($edit == true) {{$encounter->incident_report}} @endif</textarea>
    </div>
</div>

<div class="col-lg-6 col-sm-12 col-md-12">
    <div class="form-group">
        <label for="plan">Plan for Improvement</label>
        <textarea class="form-control rounded-0" id="plan" name="plan" rows="10">@if($edit == true) {{$encounter->plan}} @endif</textarea>
    </div>
</div>

</div>

<div class="row">
<div class="col-lg-6 col-sm-12 col-md-12">
    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="associated" name="associated" value="@if($edit == true) {{$encounter->associated}} @endif" class="form-control">
            <label for="follow_up">Associated Documents</label>
        </div>
    </div>
</div>

<div class="col-lg-6 col-sm-12 col-md-12">
    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="suspension_dates" name="suspension_dates" value="@if($edit == true) {{$encounter->suspension_dates}} @endif" class="form-control">
            <label for="suspension_dates">Suspension Dates</label>
        </div>
    </div>
</div>

</div>
<div class="row">


<div class="col-lg-6 col-sm-12 col-md-12">
    <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-light-blue form-check-label active">
                <input class="form-check-input" type="radio" name="status" id="s1"  value="1" autocomplete="off" @if($edit == true && $encounter->status == 1) checked @else checked @endif> Investigation
            </label>
            <label class="btn btn-light-blue form-check-label">
                <input class="form-check-input" type="radio" name="status" id="s2"  value="2" autocomplete="off" @if($edit == true && $encounter->status == 2) checked @endif> Contact
            </label>
            <label class="btn btn-light-blue form-check-label">
                <input class="form-check-input" type="radio" name="status" id="s3"  value="3" autocomplete="off" @if($edit == true && $encounter->status == 3) checked @endif> Admin / Training
            </label>
            <label class="btn btn-light-blue form-check-label">
                <input class="form-check-input" type="radio" name="status" id="s4"  value="4" autocomplete="off" @if($edit == true && $encounter->status == 4) checked @endif> Closed
            </label>
            
        </div>
</div>

</div>
{{ Form::hidden('added_by', Auth::User()->id)}}
<button class="btn btn-primary btn-block my-4" type="submit">Add New Encounter</button>