<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <tr class="text-center">
                <th>Shift</th>
                <th>Start Time</th>
                <th>Total Hours</th>
                <th>Avg Busy Hours</th>
                <th>UHU</th>
            </tr>
            @foreach($units as $u)
                <?php
                if(\Carbon\Carbon::parse($start) == \Carbon\Carbon::parse($end)){
                    $schedule = \Vanguard\UnitSchedule::whereDate('startTime', $start)->where('repeatId', $u->id)->get();
                }else{
                    $schedule = \Vanguard\UnitSchedule::whereBetween('startTime', [$start, $end])->where('repeatId', $u->id)->get();
                }


                    //dd($start);
                    $hours= 0;
                    $transports = 0;
                    foreach($schedule as $row)
                        {
                            $totalShift = \Carbon\Carbon::parse($row->endTime)->diffInHours($row->startTime);
                            $hours = $hours + $totalShift;

                            if(\Carbon\Carbon::parse($start) == \Carbon\Carbon::parse($end)){
                                $incidents = \Vanguard\DispatchIncident::whereDate('pickUpTime', $start)->where('primaryUnitId', $row->id)->get();
                            }else{
                                $incidents = \Vanguard\DispatchIncident::whereBetween('pickUpTime', [$start, $end])->where('primaryUnitId', $row->id)->get();
                            }

                            $transports =  $transports + count($incidents);

                        }

                    $uhu = round($transports / max($hours, 1) * 100);

                ?>
            <tr class="text-center">
                <td>{{$u->level->identifier ?? ''}} {{$u->description}}</td>
                <td>{{\Carbon\Carbon::parse($u->startTime)->format('H:i')}} - {{$u->totalHours ?? '0'}} Hours</td>
                <td>{{$hours ?? '0'}}</td>
                <td>
                    <?php $busy = $uhu / 100 * $hours; ?>
                    {{$busy ?? ''}}
                </td>
                <td>
                    <div class="progress">
                        <div class="progress-bar @if($uhu <= 25) bg-danger @elseif($uhu >= 26 && $uhu <= 35 ) bg-warning @elseif($uhu >= 36 ) bg-success @endif " role="progressbar" aria-valuenow="{{$uhu}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$uhu}}%;">
                            <span style="color: black">{{$uhu}}% Utilization</span>
                        </div>
                    </div>
                    </td>
            </tr>

            @endforeach
        </table>
    </div>

</div>
