
<div class="md-form">
  <input placeholder="Selected date" type="text" id="date_to_send" name="date_to_send" class="form-control datepicker">
  <label for="date_to_send">Date to Send</label>
</div>

<div class="row mb-3">
  <div class="col-md-12">
    <select class="multiple-select2 md-form" id="employees" multiple="multiple"  name="send_to[]" style="width: 100%">
      <optgroup label="Road Crew">
        @foreach($ep->where('group', 1) as $row)
          <option value="{{$row->id}}">{{$row->label}}</option>
        @endforeach
      </optgroup>
      <optgroup label="Groups">
        @foreach($ep->where('group', 9) as $row)
          <option value="{{$row->id}}">{{$row->label}}</option>
        @endforeach
      </optgroup>
      <optgroup label="PCI Employees">
        @foreach($ep->where('group', 2) as $row)
          <option value="{{$row->id}}">{{$row->label}}</option>
        @endforeach
      </optgroup>
      <optgroup label="PRT">
        @foreach($ep->where('group', 3) as $row)
          <option value="{{$row->id}}">{{$row->label}}</option>
        @endforeach
      </optgroup>
      <optgroup label="TBN">
        @foreach($ep->where('group', 4) as $row)
          <option value="{{$row->id}}">{{$row->label}}</option>
        @endforeach
      </optgroup>
      <optgroup label="PEASI">
        @foreach($ep->where('group', 4) as $row)
          <option value="{{$row->id}}">{{$row->label}}</option>
        @endforeach
      </optgroup>
        <optgroup label="PMF">
            @foreach($ep->where('group', 5) as $row)
                <option value="{{$row->id}}">{{$row->label}}</option>
            @endforeach
        </optgroup>
      <optgroup label="PEASI">
        @foreach($ep->where('group', 6) as $row)
          <option value="{{$row->id}}">{{$row->label}}</option>
        @endforeach
      </optgroup>
    </select>
  </div>



</div>

<div class="row">
    <div class="col-md-12">
        <select class="multiple-select2 md-form" id="companies" multiple="multiple"  name="companies[]" style="width: 100%">

                @foreach($companies as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach

        </select>
    </div>



</div>

<div class="row">
    <div class="col-md-12">
        <select class="multiple-select2 md-form" id="stations" multiple="multiple"  name="stations[]" style="width: 100%">

            @foreach($stations as $row)
                <option value="{{$row->id}}">{{$row->station}}</option>
            @endforeach

        </select>
    </div>



</div>


<!-- Material input -->
<div class="md-form">
  <i class="fal fa-running"></i>
  <input type="text" id="title" name="title" class="form-control">
  <label for="title">Title</label>
</div>

<!-- Material input -->
<div class="md-form">
  <i class="fal fa-running"></i>
  <input type="text" id="author" name="author" class="form-control">
  <label for="author">Author</label>
</div>

<div class="form-group">
  <label for="content">Large textarea</label>
  <textarea class="form-control rounded-0" id="content" name="blog" rows="20"></textarea>
</div>

<input type="file" id="file" class="form-control mt-3" name="pdf[]" multiple />
<label for="file">Attachment Upload</label>

<button class="btn btn-info btn-block my-4" type="submit">Add Blog Entry</button>



