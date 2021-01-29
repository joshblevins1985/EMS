
    <label class="col-lg-4 col-form-label">Select the Service Ticket to Add work to.</label>
    <div class="col-lg-8">
        <select class="default-select2 form-control" name="service_ticket_id">
            @foreach ($tickets as $ticket)
                <option value="{{ $ticket->id }}">  {{ $ticket->unit_id }}  </option>
            @endforeach
            
        </select>
    </div>


