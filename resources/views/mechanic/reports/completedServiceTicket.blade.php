<html>
<head>
    <title>PR&T Maintenance Report</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<div class="container">

    <div class="row">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td><strong> Date : </strong> {{ Carbon\Carbon::parse($ticket->created_at)->format('m-d-Y H:i') }}</td>
                <td><strong> Unit / Type : </strong> {{ $ticket->unit_id }} / @if($ticket->unit->type <= 4)
                        Ambulance @elseif($ticket->unit->type == 5) Wheel Chair @elseif($ticket->unit->type == 6)
                        Car @endif</td>
                <td><strong> Service Mileage : </strong> {{ $ticket->unit->service }} </td>
            </tr>
            <tr>
                <td><strong> License Plate / Expiration : </strong> {{ $ticket->license_plate }}
                    / {{ Carbon\Carbon::parse($ticket->unit->tag_expiration)->format('m-d-Y')   }}</td>
                <td><strong> Model : </strong> {{ $ticket->unit->model }} </td>
                <td><strong> State ID : </strong>
                    {{ $ticket->unit->odps_number ? 'OH /'. $ticket->unit->odps_number : 'OH None'}}
                    <p>{{ $ticket->unit->ky_number ? 'KY /'. $ticket->unit->ky_number : 'KY None'}}</p>
                </td>
            </tr>
            <tr>
                <td><strong> Last Odometer Reading
                        : </strong> {{$ticket->unit->odometer }}  {{   Carbon\Carbon::parse($ticket->unit->odometer_date)->format('m-d-Y')   }}
                </td>
                <td><strong> Engine : </strong> {{  $ticket->unit->engine ?? 'Engine Not on Record'}} </td>
                <td><strong> VIN Number : </strong> {{ $ticket->unit->vin ?? 'No VIN number on Record'}} </td>
            </tr>
            <tr>
                <td><strong> Year : </strong> {{ Carbon\Carbon::parse($ticket->created_at)->format('m-d-Y H:i') }}</td>
                <td><strong> Primary Station : </strong> {{ $ticket->unit->location->station }} </td>
                <td><strong> Stretcher : </strong> @if($ticket->unit->last_stretcher_inspection < Carbon\Carbon::now())
                        <span class="text-danger"> Stretcher Inspection Required / SN: {{ $ticket->unit->stretcher  ?? 'No Stretcher Found'}}</span> @else
                        SN: {{ $ticket->unit->stretcher  ?? 'No Stretcher Found'}}
                        / {{ Carbon\Carbon::parse($ticket->unit->last_stretcher_inspection)->format('m-d-Y')  }}  @endif
                </td>
            </tr>
            <tr>

                <td><strong> Safety Inspection Due : @if($ticket->unit->odometer > $ticket->unit->safety_report + 25000)
                            <a data-toggle="modal" data-target="#modalSafetyReport"
                               data-unitid="{{$ticket->unit_id}}"><span class="text-danger"> Safety Inspection Due {{ $ticket->unit->odometer - ($ticket->unit->safety_report + 25000) }} miles overdue.</span>
                            </a> @else  {{  $ticket->unit->safety_report     }} @endif </strong></td>
                <td colspan="2"><strong> Company : </strong> {{ $ticket->unit->company->name ?? 'Unknown'}}  </td>

            </tr>
            </thead>
        </table>

    </div>
    <div class="row">

        <div class="col-4">
            <h2> Mechanic Inspection </h2>
            <table class="table table-bordered table-striped">
                <tr>
                    <td> Check Wipers</td>
                    <td>
                        @if($ticket->wipers == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Head Lights</td>
                    <td>
                        @if($ticket->head_lights == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Turn Signals</td>

                    <td>
                        @if($ticket->turn_signals == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Lube Hinges</td>

                    <td>
                        @if($ticket->lube_higes == 0)
                            Not Completed
                        @else
                            Completed
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Emergency Lights</td>

                    <td>
                        @if($ticket->emergency_lights == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Rear Dome Lights</td>

                    <td>
                        @if($ticket->rear_domes == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif

                    </td>
                </tr>
                <tr>
                    <td> Washer Fluid</td>

                    <td>
                        @if($ticket->washer_fluid == 0)
                            Low
                        @else
                            Level Ok
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Check Air Filter</td>

                    <td>
                        @if($ticket->air_filter == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Oil Level</td>

                    <td>
                        @if($ticket->oil_level == 0)
                            Low
                        @else
                            Level Ok
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Power Steering Fluid</td>

                    <td>
                        @if($ticket->power_steering_level == 0)
                            Low
                        @else
                            Level Ok
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Brake Fluid</td>

                    <td>
                        @if($ticket->brake_fluid_level == 0)
                            Low
                        @else
                            Level Ok
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Coolant Level</td>

                    <td>
                        @if($ticket->coolant_level == 0)
                            Low
                        @else
                            Level Ok
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Test/Clean Batteries</td>

                    <td>
                        @if($ticket->batteries == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Spare Tire</td>

                    <td>
                        @if($ticket->spare_tire == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Brakes</td>

                    <td>
                        @if($ticket->brakes == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Rotors</td>

                    <td>
                        @if($ticket->rotors == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Tires</td>

                    <td>
                        @if($ticket->tires == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>

                </tr>
                <tr>
                    <td> Torque Wheels 70/100/150</td>
                    <td>
                        @if($ticket->tourque_wheels == 0)
                            Incomplete
                        @else
                            Completed
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Check/Lube Front End</td>
                    <td>
                        @if($ticket->front_end == 0)
                            Incomplete
                        @else
                            Completed
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Backup Beeper</td>
                    <td>
                        @if($ticket->backup_beeper == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Check / Lube Stretcher</td>
                    <td>
                        @if($ticket->stretcher == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Check E-Brake</td>
                    <td>
                        @if($ticket->ebrake == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Body Damage</td>
                    <td>
                        @if($ticket->body_damage == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Check HVAC</td>
                    <td>
                        @if($ticket->hvac == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Check Camera</td>
                    <td>
                        @if($ticket->camera == 0)
                            Repair Needed
                        @else
                            Passed Inspection
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-8">

            <div class="card" style="height:950px">
                <div class="card-header bg-danger text-center">
                    <h3> JOBS COMPLETED ON THIS SERVICE TICKET </h3>
                </div>
                <div class="card-body">


                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th> Task / Job</th>
                            <th> Comment</th>
                            <th> Mechanic</th>
                            <th> Completed</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ticket->tasks as $job)
                            <tr>
                                <td> {{ $job->task_label->label ?? 'Unknown' }} </td>
                                <td> {{ $job->comments ?? 'No Comments' }} </td>
                                <td> {{ $job->mechanic->first_name }} {{ $job->mechanic->last_name }} </td>
                                <td> {{ Carbon\Carbon::parse($job->end_date)->format('m-d-Y') }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>


        </div>

    </div>

</div>
</body>
</html>