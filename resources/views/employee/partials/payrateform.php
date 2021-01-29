

<div class="md-form">

    <select class="mdb-select" id="pay_type" name="pay_type">
        <option value="" disabled selected>Choose your option</option>
        <option value="1" @if($edit == false) @elseif($employees->payrate->pay_type == 1) selected @endif>Straight Time</option>
        <option value="1" @if($edit == false) @elseif($employees->payrate->pay_type == 2) selected @endif>Over Time</option>
        <option value="1" @if($edit == false) @elseif($employees->payrate->pay_type == 3) selected @endif>VAMC</option>
    </select>
    <label>Pay Type</label>

    <div class="md-form">
        <input type="text" id="rate" name="rate" value="{{ $edit ? $employees->rate : '' }}" class="form-control">
        <label for="rate" >Pay Rate</label>
    </div>

<!-- Group of material radios - option 1 -->
<div class="form-check">
  <input type="radio" class="form-check-input" id="status" name="status" @if($edit == false) @elseif($employees->payrate->status == 0) checked @endif>
  <label class="form-check-label" for="materialGroupExample1">Not Active</label>
</div>

<!-- Group of material radios - option 2 -->
<div class="form-check">
  <input type="radio" class="form-check-input" id="status" name="status" @if($edit == false) @elseif($employees->payrate->status == 1) checked @endif>
  <label class="form-check-label" for="materialGroupExample2">Active</label>
</div>


<button class="btn btn-info btn-block my-4" type="submit">Add New Pay Rate for {{$employees->first_name}}</button>



