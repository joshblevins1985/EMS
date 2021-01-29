

<div class="md-form">
        <input placeholder="Incident Date" type="text" id="incident_date" name="incident_date" value="@if($edit) {{$brs->incident_date}} @else{{old('incident_date')}}@endif" class="form-control datepicker">
        <label for="last_reviewed">Incident Date</label>
    </div>

<select class="mdb-select colorful-select dropdown-primary md-form" id="employee" name="employee[]" multiple searchable="Search here..">
    <option value="" disabled selected>Choose Employee</option>
    @foreach($employees as $option)
        <option value="{{$option->user_id}}" @if($edit == false) @if($option->user_id == old('employee')) selected @endif  @elseif($option->user_id == $brs->employee) selected   @endif > {{$option->last_name.', '.$option->first_name}}</option>
    @endforeach
</select>
<label>Employee</label>

<div class="md-form">
    <input type="text" id="pcr_number" name="pcr_number" value="@if($edit == false) {{old('pcr_number')}} @elseif($edit == true) {{$brs->pcr_number}} @endif" class="form-control">
    <label for="incident_date" >PCR Number</label>
</div>

<div></div>
<div class="md-form">
        <div class="md-form">
            <textarea  id="comments" name="comments" value="@if($edit == true) {{old('comments')}}   @endif" class="form-control">@if($edit == false) {{old('comments')}} @elseif($edit == true) {!!$brs->comments!!}@endif</textarea>
            <label for="comments">Comments</label>
        </div>
    </div>


<select class="mdb-select" id="status" name="status" searchable="Search Employee">
    <option value="" disabled selected>Choose your option</option>
    <option value="1" @if($edit == false && old('status') == 1) selected @elseif($edit == false) selected @elseif($edit == true && $brs->status == 1) selected @endif>Uploaded</option>
    <option value="2" @if($edit == false && old('status') == 2) @elseif($edit == true && $brs->status == 2) selected @endif>Notified</option>
    <option value="3" @if($edit == false && old('status') == 3) @elseif($edit == true && $brs->status == 3) selected @endif>Acknowledged</option>
    <option value="4" @if($edit == false && old('status') == 4) @elseif($edit == true && $brs->status == 4) selected @endif>To Billing</option>
    <option value="5" @if($edit == false && old('status') == 5) @elseif($edit == true && $brs->status == 5) selected @endif>Completed</option>

</select>
<label>Status</label>

<table id="problem_table" align=center class="table table">
            <thead>
            <tr>
                <th>PCR Error / Problem</th>
                <th>Billing Note</th>

            </tr>
            </thead>
            <tbody>
                
            </tbody>
            <tfoot>
    <tr>
      <td colspan="5" style="text-align: left;">
        <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
      </td>
    </tr>
    <tr>
    </tr>
  </tfoot>
        </table>




<input type="file" id="file" class="form-control mt-3" name="pdf[]" multiple />
<label for="file">PCR Upload</label>
<button class="btn btn-info btn-block my-4" type="submit">Add Report</button>



