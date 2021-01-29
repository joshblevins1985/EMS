
    <table class="table table-striped" id="support-tickets" style="width: 100%">
        <thead>
        <tr>
            <th>Priority</th>
            <th>Date Added</th>
            <th >Description</th>
            <th>Reported By</th>
            <th>Tech Assigned</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach($supportTickets as $row)
            <tr>
                <td>
                    @if($row->priority == 1)
                        <span class="text-danger"><i class="fad fa-siren-on"></i></span>
                    @elseif($row->priority == 2)
                        <span class="text-warning"><i class="fas fa-exclamation-triangle"></i></span>
                    @elseif($row->priority == 3)
                        <span class="text-primary"><i class="far fa-engine-warning"></i></span>
                    @elseif($row->priority == 4)
                        <span class="text-success"><i class="fas fa-exclamation"></i></span>
                    @endif
                </td>
                <td>
                    <a data-toggle="modal"
                       href="javascript;"
                       data-ticket_id="{{ $row->id }}"
                       data-target="#editTicketModal">
                        {{ Carbon\Carbon::parse($row->created_at)->format('m-d-Y') }}</a>
                </td>
                <td class="text-wrap" width="25%">{!! $row->description !!}</td>
                <td> {{ $row->requester->first_name ?? '' }} {{ $row->requester->last_name ?? '' }} </td>
                <td>{{ $row->tech->first_name ?? 'Not Assigned'  }}</td>
                <td>@if($row->status == 1) Pending @elseif($row->status == 2) Working @elseif($row->status == 3) On Hold 30
                    Days @elseif($row->status == 4) On Hold 60 Days @elseif($row->status == 5) On Hold 90
                    Days @elseif($row->status == 97) Admin Denied Request @elseif($row->status == 98)
                        Duplicate @elseif($row->status == 99) Completed @endif
                </td>
                <td>
                    <a data-toggle="modal" href="javascript;" data-target="#supportNoteInfo" data-ticketId="{{ $row->id }}"
                       data-toggle="tooltip" data-placement="top" title="Click to view all notes.">
                        Total Notes: {{ count($row->notes) }}
                    </a>
                </td>
                <td class="text-center">
                    <!-- Example split danger button -->
                    <div class="btn-group mb-2">
                        <button type="button"
                                class="@if($row->status == 1) btn btn-danger @elseif($row->status >= 2) btn btn-success  @endif">
                            Action
                        </button>
                        <button type="button"
                                class="@if($row->status == 1) btn btn-danger @elseif($row->status >= 2) btn btn-success  @endif dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" href="#" data-ticket_id="{{ $row->id }}"
                               data-target="#editTicketModal"> Edit Ticket</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#supportNote"
                               data-ticketId="{{ $row->id }}"> Add Note</a>
                            @if(!$row->user_id) <a class="dropdown-item" href="/ticketAssignMe/{{ $row->id }}"> Assign to
                                Me</a> @endif
                            @if(!$row->user_id)<a class="dropdown-item" href="#" data-toggle="modal"
                                                  data-target="#assignTicket" data-ticketid="{{ $row->id }}"> Assign
                                Ticket </a> @endif
                            @if($row->status != 2) <a class="dropdown-item" href="/ticketWorking/{{ $row->id }}"> Work in
                                Progress</a> @endif
                            @if($row->status != 99) <a class="dropdown-item" href="/ticketComplete/{{ $row->id }}"> Mark
                                Complete</a> @endif

                        </div>
                    </div>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
