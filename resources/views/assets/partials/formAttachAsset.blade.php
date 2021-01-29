<form action="/attachAsset" method="post">
    
    @csrf
    <input type="hidden" id="assetId" name="assetId" value="">
   
    
    <div class="form-group">
        <label for="location">Select Asset</label>
        <select class="default-employee form-control" name="attachedId">
            @foreach($assets as $row)
			<option value="{{$row->id}}" > {{ $row->asset_tag ?? $row->model }} </option>
			@endforeach
		</select>
    </div>
 
	
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Attach Asset</button>
    </div>
    
</form>