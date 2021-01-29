<div class="row">
    <div class="col-lg-6">
        <select class="mdb-select" id="unit" name="unit" searchable="Search Employee">
            <option value="" disabled selected>Choose Unit</option>
            @foreach($units as $unit)
                <option value="{{$unit}}"> {{$unit}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <div class="md-form">
            <input type="text" id="mileage" name="mileage"  class="form-control">
            <label for="incident_date" >Vehicle Mileage</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <label for="comments">Provide a brief description of the problem.</label>
        <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" name="comments" rows="10" ></textarea>
    </div>
</div>

<div class="row">

    <table  class="table table-hover small-text" id="item_table">
<tr class="tr-header">
<th>Problem List</th>
<th>Comment</th>

<th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="fa fa-plus"></span></button></th>
<tr>
<td>
    <select class="mdb-select" id="problem" name="problem[]" searchable="Select Problem">
            <option value="" disabled selected>Choose Unit</option>
            @foreach($malfunctions as $malfunction)
                <option value="{{$malfunction->id}}"> {{$malfunction->label}}</option>
            @endforeach
        </select>
 </td>
<td><input type="text" name="pcomment[]" class="form-control"></td>
<td></td>
</tr>
</table>
</div>

<button class="btn btn-info btn-block my-4" type="submit">Add Report</button>