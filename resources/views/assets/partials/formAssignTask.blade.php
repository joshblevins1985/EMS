<form action="/assignTicket" method="post">
    
    @csrf
    <input type="hidden" id="ticketId" name="ticketId" value="">
   
    
    <div class="form-group">
        <label for="location">Select Asset</label>
        <select class="default-assignEmployee form-control" name="userId">
            @foreach($employees as $row)
			<option value="{{$row->user_id}}" > {{ $row->last_name }} {{ $row->first_name }} </option>
			@endforeach
		</select>
    </div>
 
	
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Assign Ticket</button>
    </div>
    
</form>