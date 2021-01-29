<div class = "panel panel-default">
   <div class = "panel-heading bg-dark">
       <div class="col-xl-10">
           Asset Support Requests
       </div>
       <div class="col-xl-1 pull-right">
           <span class="text-success pull-right"><a data-toggle="modal" data-target="#supportRequest" ><i class="far fa-plus-square"></i></a></span>
       </div>
   </div>
   
   <div class = "panel-body">
      <div class="row">
          <table class="table table-striped">
              <thead>
                  <tr>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                  @if($asset->assetSupport)
                  @foreach($asset->assetSupport as $row)
                  <tr @if($row->priority == 1) class="bg-danger" @elseif($row->priority == 2) class="bg-warning" @elseif($row->priority == 3) class="bg-primary" @elseif($row->priority == 4) class="bg-success"  @endif>
                      <td>{{ Carbon\Carbon::parse($row->created_at)->format('m-d-Y H:i') }}</td>
                      <td>@if($row->status == 1) Pending @elseif($row->status == 2) Working @elseif($row->status == 3) Completed @endif</td>
                  </tr>
                  <tr>
                      <td colspan="2">{!! $row->description !!}</td>
                  </tr>
                  <tr>
                      <td colspan="2" class="text-center">
                          <span class="col">
                              <a data-toggle="modal" data-target="#supportNoteInfo" data-ticketId="{{ $row->id }}">
                                  Total Notes: {{ count($row->notes) }}
                              </a>
                            </span>
                          <span class="col text-primary"><a data-toggle="modal" data-target="#supportNote" data-ticketId="{{ $row->id }}"><i class="fas fa-sticky-note" data-toggle="tooltip" title="Add note to support ticket."></i></a></span>
                          @if(!$row->user_id) <span class="col text-warning"><a href="/ticketAssignMe/{{ $row->id }}"><i class="fas fa-user" data-toggle="tooltip" title="Assign the ticket to you."></i></a></span> @endif
                          @if(!$row->user_id) <span class="col text-primary"><a data-toggle="modal" data-target="#assignTicket" data-ticketid="{{ $row->id }}" ><i class="fas fa-users" data-toggle="tooltip" title="Assign the ticket to another user."></i></a></span> @endif
                          @if($row->status != 2) <span class="col text-primary"><a class="text-primary"  href="/ticketWorking/{{ $row->id }}"><i class="far fa-house-leave" data-toggle="tooltip" title="Mark the ticket as workin in progress."></i></a></span> @endif
                          @if($row->status != 3) <span class="col text-success"><a class="text-success" href="/ticketComplete/{{ $row->id }}"><i class="fad fa-check-double" data-toggle="tooltip" title="Mark the ticket complete."></i></a></span> @endif
                      </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                      <td col-span="3">No Support Request Recieved for This Asset</td>
                  </tr>
                  @endif
              </tbody>
          </table>
      </div>
   </div>
</div>