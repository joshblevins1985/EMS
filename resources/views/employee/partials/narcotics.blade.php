<!--Panel-->
        <div class="card text-center">
            <div class="card-header primary-color white-text">
                <h3>{{$employees->first_name}}'s Narcotic Logs</h3>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date / Time Out</th>
                            <th>Box Number</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees->narcoticlog as $row)
                        <tr>
                            <td>{{date('m/d/Y H:i', strtotime($row->time_out))}}</td>
                            <td>
                                {{$row->narcoticbox->box_number or 'Unknown'}}
                                
                            </td>
                            <td>{{$row->narcoticbox->status or 'Unknown'}}</td>
                            <td>
                                <div class="dropdown show d-inline-block">
                                    <a class="btn btn-icon"
                                       href="#" role="button" id="dropdownMenuLink"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                        
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        
                                        <a href="/compliance/{{$row->id}} " class="dropdown-item text-gray-500">
                                            <i class="fas fa-eye mr-2"></i>
                                            View ??????
                                        </a>
                                    </div>
                                </div>
                        
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
<!--/.Panel-->