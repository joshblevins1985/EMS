<!--Panel-->
        <div class="card text-center">
            <div class="card-header primary-color white-text">
                <h3>{{$employees->first_name}}'s Run Sheets</h3>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Incident Date</th>
                            <th>PCR Number</th>
                            <th>Status</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees->BadRunSheets as $brsrow)
                        <tr>
                            <td>{{$brsrow->incident_date}}</td>
                            <td>{{$brsrow->pcr_number}}</td>
                            <td>
                                 @if($brsrow->status == 1)
                                <span class="badge badge-pill red">Uploaded</span>
                                @elseif($brsrow->status == 2)
                                <span class="badge badge-pill yellow">Notified</span>
                                @elseif($brsrow->status == 3)
                                <span class="badge badge-pill blue">To Billing</span>
                                @elseif($brsrow->status == 4)
                                <span class="badge badge-pill green">Complete</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown show d-inline-block">
                                    <a class="btn btn-icon"
                                       href="#" role="button" id="dropdownMenuLink"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                        
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                       
                                        <a href="/badrunsheets/{{$brsrow->id}} " class="dropdown-item text-gray-500">
                                            <i class="fas fa-eye mr-2"></i>
                                            View Incident
                                        </a>
                                    </div>
                                </div>
                        
                                <a href="/badrunsheets/{{$brsrow->id}}/edit "
                                  class="btn btn-icon edit"
                                   title="Edit Incident"
                                   data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('badrunsheets.destroy', $brsrow->id) }}"
                                   class="btn btn-icon bg-danger"
                                   title="@lang('app.delete_user')"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   data-method="DELETE"
                                   data-confirm-title="@lang('app.please_confirm')"
                                   data-confirm-text="Are you sure you want to delete this incident"
                                   data-confirm-delete="@lang('app.yes_delete_him')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
<!--/.Panel-->