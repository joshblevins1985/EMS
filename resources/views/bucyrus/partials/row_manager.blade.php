
    
    <div class="col-xl-12">
        <!-- begin card -->
        <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
            <!-- begin card-body -->
            <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-md-12">
                   <h2>Incident Type: {{$row->call_type->description}}</h2>
                   </div>
                   <div class="col-lg-6 col-md-12">
                       <h3> Scene Address: {{$row->street_number or ''}} {{$row->street or ''}} {{$row->address2 or ''}} {{$row->city or ''}} {{$row->state or ''}} {{$row->zip or ''}}</h3>
                       <h3> Destination Address: @if($row->txp_facility) {{$row->facility->name or 'Unknown'}} @else {{$row->street_number_txp or ''}} {{$row->street_txp or ''}} {{$row->address2_txp or ''}} {{$row->city_txp or ''}} {{$row->state_txp or ''}} {{$row->zip_txp or ''}} @endif</h3>
                   </div>
                   <div class="col-lg-3 col-md-12">
                       <h3> Disposition: 
                       @if($row->incident_disposition == 1)
                       Treated and Tranported
                       @elseif($row->incident_disposition == 2)
                       No Patient Found
                       @elseif($row->incident_disposition == 3)
                       Patient Refusal AMA
                       @elseif($row->incident_disposition == 4)
                       Public Assist
                       @elseif($row->incident_disposition == 5)
                       Disregaurd
                       @endif
                       </h3>
                   </div>
                   <div class="col-lg-6 col-md-12">
                       <div class="col-xl-12 text-centered">
                            <h3>Crew Information</h3>
                        </div>
                       @if($row->crew) 
                       @foreach($row->crew as $crew)
                       <div class="col-xl-12">
                           {{$crew->employee->first_name or ''}} {{$crew->employee->last_name or ''}} -- @if($crew->level ==1) EMT @elseif($crew->level == 2) AEMT @elseif($crew->level == 3) MEDIC @endif  @if($crew->assignment == 1) (Driver) @elseif($crew->assignment == 2) (Attendant) @elseif($crew->assignment == 3) (Assistant) @elseif($crew->assignment == 4) (Student) @endif   
                       </div>
                        @endforeach 
                        @endif
                   </div>
                   <div class="col-lg-6 col-md-6">
                        <div class="col-xl-12 text-centered">
                            <h3>Variance Information</h3>
                        </div>
                        <div class="col-xl-12 text-centered">
                            Variance Entered: @if($row->variance == 1) <span class="text-danger">Yes</span> @elseif($row->variance == 0) No @endif
                            
                        </div>
                        <div class="col-xl-12 text-centered">
                            Variance Reason: 
                            
                        </div>
                        <div class="col-xl-12 text-centered">
                            Variance Description: 
                            
                        </div>
                        <div class="col-xl-12 text-centered">
                            Variance Apporved: 
                            
                        </div>
                    </div>
                    <div class="col-xl-12 table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                <th>CALL RCVD</th>
                                <th>DISP</th>
                                <th>ENROUTE</th>
                                <th>ON-SCENE</th>
                                <th>TRANSPORT</th>
                                <th>TXP COMP</th>
                                <th>CLEAR</th>
                                <th>INSERVICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{Carbon\Carbon::parse($row->call_time)->format('H:i') }}</td>
                                    <td>{{Carbon\Carbon::parse($row->dispatch_time)->format('H:i') }}</td>
                                    <td>{{Carbon\Carbon::parse($row->enroute_time)->format('H:i') }}</td>
                                    <td>{{Carbon\Carbon::parse($row->onscene_time)->format('H:i') }}</td>
                                    <td>{{Carbon\Carbon::parse($row->txp_time)->format('H:i') }}</td>
                                    <td>{{Carbon\Carbon::parse($row->txp_complete_time)->format('H:i') }}</td>
                                    <td>{{Carbon\Carbon::parse($row->clear_time)->format('H:i') }}</td>
                                    <td>{{Carbon\Carbon::parse($row->inservice_time)->format('H:i') }}</td>
                                </tr>
                                <tr>
                                   
                                    <td colspan="2">
                                        Chute Time
                                    </td>
                                    <td>Response ({{ $row->twp->response_time or '' }})</td>
                                    <td>On Scene</td>
                                    <td colspan="2">Txp Time</td>
                                    <td>Clear</td>
                                    <td>Total</td>
                                </tr>
                                <tr>
                                    
                                    <td @if($row->chute_calc > 2) class="bg-danger" @endif colspan="2">
                                        {{$row->chute_calc or ''}} Min
                                    </td>
                                    <td @if($row->response_calc > $row->twp->response_time) class="bg-danger" @endif >  {{$row->response_calc or ''}} Min</td>
                                    <td> {{$row->onscene_calc or ''}} Min </td>
                                    <td colspan="2"> {{$row->txptime_calc or ''}} Min </td>
                                    <td>{{ $row->toctxp_calc or '' }} Min</td>
                                    <td>{{ $row->total_calc or '' }} Min</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col-6 -->
