@csrf
<div class="col-sm-12 col-12">
    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="policy_number" name="policy_number" value="@if($edit == true) {{$policy->policy_number}} @endif" class="form-control">
            <label for="policy_number">Policy Number</label>
        </div>
    </div>
    
        <select class="mdb-select md-form" name="company">
      <option value="" disabled selected>Choose your option</option>
      <option value="1" @if($edit == true) @if($policy->company == 1){{$policy->company}} selected @endif @endif>Portsmouth Ambulance</option>
      <option value="2" @if($edit == true) @if($policy->company == 2){{$policy->company}} selected @endif @endif>Portsmouth Ambullete</option>
      <option value="3" @if($edit == true) @if($policy->company == 3){{$policy->company}} selected @endif @endif>Portsmouth Management Firm</option>
      <option value="4" @if($edit == true) @if($policy->company == 4){{$policy->company}} selected @endif @endif>Portsmouth Communications</option>
      <option value="5" @if($edit == true) @if($policy->company == 5){{$policy->company}} selected @endif @endif>Transportation Billing Network</option>
      <option value="6" @if($edit == true) @if($policy->company == 6){{$policy->company}} selected @endif @endif>Portsmouth Repair and Towing</option>
    </select>
    
    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="title" name="title" value="@if($edit == true) {{$policy->title}}  @endif" class="form-control">
            <label for="title">Policy Title</label>
        </div>
    </div>
    
    <div class="md-form">
        <input placeholder="Effective Date" type="text" id="date_effective" name="date_effective" class="form-control datepicker" @if($edit == true) data-value="{{date('Y-m-d',strtotime($policy->date_effective))}}"  @endif>
        <label for="date_effective">Effective Date</label>
    </div>
    
    <div class="md-form">
        <input placeholder="Last Reviewed" type="text" id="last_reviewed" name="last_reviewed" class="form-control datepicker" @if($edit == true) data-value="{{date('Y-m-d',strtotime($policy->last_reviewed))}}"  @endif>
        <label for="last_reviewed">Last Reviewed</label>
    </div>
    
    <div class="md-form">
        <input placeholder="Terminated Date" type="text" id="date_terminated" name="date_terminated" class="form-control datepicker" @if($edit == true) @if($policy->date_terminated) data-value="{{date('Y-m-d',strtotime($policy->date_terminated))}}" @else  @endif  @endif>
        <label for="date_terminated">Terminated Date</label>
    </div>

    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="approved_by" name="approved_by" value="@if($edit == true) {{$policy->approved_by}}  @endif" class="form-control">
            <label for="approved_by">Approved By</label>
        </div>
    </div>
    
    <div class="md-form">
        <div class="md-form">
            <textarea  id="purpose" name="purpose" value="@if($edit == true)  @endif" class="form-control">@if($edit == true) {!!$policy->purpose!!} @endif</textarea>
            <label for="purpose">Policy Purpose</label>
        </div>
    </div>
    
    <div class="md-form">
        <div class="md-form">
            <textarea  id="scope" name="scope" value="@if($edit == true)  @endif" class="form-control">@if($edit == true) {!!$policy->scope!!} @endif</textarea>
            <label for="scope">Policy Scope</label>
        </div>
    </div>
    
    <div class="md-form">
        <div class="md-form">
            <textarea  id="policy" name="policy" value="@if($edit == true)  @endif" class="form-control">@if($edit == true) {!!$policy->policy!!} @endif</textarea>
            <label for="policy">Policy</label>
        </div>
    </div>
    <div></div>
    <div class="md-form">
        <div class="md-form">
            <textarea  id="policy" name="procedure" value="" class="form-control">@if($edit == true) {!!$policy->procedure!!}  @endif</textarea>
            <label for="procedure">Procedure</label>
        </div>
    </div>
    <button class="btn btn-info btn-block my-4" type="submit">Add New Policy</button>
</div>

<div class="col-sm-6 col-6">
    
</div>

