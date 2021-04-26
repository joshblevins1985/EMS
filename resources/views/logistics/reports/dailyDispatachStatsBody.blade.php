<div class="row mb-3">

    <div class="col-3">
        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
            <div class="value">
                {{count($incidents)}}
            </div>
            <div class="label">
                Scheduled Transports
            </div>

            <?php
            $lastWeek = \Vanguard\DispatchIncident::whereDate('pickUpTime', \Carbon\Carbon::today()->subDay(7))->get();
            $all = count($lastWeek);
            $allDifference = count($incidents) - $all;
            $allpercent = count($incidents) / max($all, 1) * 100;
            $txp = count($lastWeek->where('statusId', 10));
            $txpDifference = count($incidents->where('statusId', 10)) - $txp;
            $txppercent = count($incidents->where('statusId', 10)) / max($txp, 1) * 100;
            $cxl = count($lastWeek->where('statusId', 999));
            $cxlDifference = count($incidents->where('statusId', 999)) - $cxl;
            $cxlpercent = count($incidents->where('statusId', 999)) / max($cxl, 1) * 100;
            $incidents = \Vanguard\DispatchIncident::whereDate('pickUpTime', \Carbon\Carbon::today())->where('statusId', 10)->get();
            $totalUnitHours = 0;
            foreach($units as $u)
                {
                    $total = \Carbon\Carbon::parse($u->endTime)->diffInHours($u->startTime);
                    $totalUnitHours = $totalUnitHours + $total;
                }

                    $uhu= max(count($incidents), 0) / max($totalUnitHours, 1) * 100;
            ?>
            @if($allpercent <= 0)
                <div class="trending trending-down-basic">
                    <span>{{abs($allpercent)}}%</span><i class="fas fa-sort-down"></i>
                </div>
            @else
                <div class="trending trending-up-basic">
                    <span>{{abs($allpercent)}}%</span><i class="fas fa-sort-up"></i>
                </div>
            @endif


        </a>
    </div>

    <div class="col-3">
        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
            <div class="value">
                {{count($incidents->where('statusId', 10))}}
            </div>
            <div class="label">
                Transported
            </div>

            @if($txppercent <= 0)
                <div class="trending trending-down-basic">
                    <span>{{abs($txppercent)}}%</span><i class="os-icon os-icon-arrow-down"></i>
                </div>
            @else
                <div class="trending trending-up-basic">
                    <span>{{abs($txppercent)}}%</span><i class="os-icon os-icon-arrow-2"></i>
                </div>
            @endif


        </a>
    </div>

    <div class="col-3">
        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
            <div class="value">
                {{count($incidents->where('statusId', 999))}}
            </div>
            <div class="label">
                Canceled Transports
            </div>

            @if($cxlpercent >= 0)
                <div class="trending trending-down-basic">
                    <span>{{abs($cxlpercent)}}%</span><i class="os-icon os-icon-arrow-down"></i>
                </div>
            @else
                <div class="trending trending-up-basic">
                    <span>{{abs($cxlpercent)}}%</span><i class="os-icon os-icon-arrow-2"></i>
                </div>
            @endif


        </a>
    </div>

    <div class="col-3">
        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
            <div class="value">
                {{round($uhu)}}%
            </div>
            <div class="label">
                UHU
            </div>

            <?php
            $percent = 0;
            ?>
            @if($percent <= 0)
                <div class="trending trending-down-basic">
                    <span>{{abs($percent)}}%</span><i class="os-icon os-icon-arrow-down"></i>
                </div>
            @else
                <div class="trending trending-up-basic">
                    <span>{{abs($percent)}}%</span><i class="os-icon os-icon-arrow-2"></i>
                </div>
            @endif


        </a>
    </div>

</div>

<div class="row mb-3">

    <div class="col-4">
        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
            <div class="value">
                {{$milesDriven ?? '0'}}
            </div>
            <div class="label">
                Billable Miles
            </div>

                <div class="trending trending-up-basic">
                    <span>0%</span><i class="os-icon os-icon-arrow-2"></i>
                </div>

        </a>
    </div>

    <div class="col-4">
        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
            <div class="value">
                {{$milesBillable ?? '0'}}
            </div>
            <div class="label">
                Est Billable Miles Income
            </div>

            <div class="trending trending-up-basic">
                <span>0%</span><i class="os-icon os-icon-arrow-2"></i>
            </div>

        </a>
    </div>

    <div class="col-4">
        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
            <div class="value">
               {{$totalIncome ?? '0'}}
            </div>
            <div class="label">
                Est Income
            </div>

            <div class="trending trending-up-basic">
                <span>0%</span><i class="os-icon os-icon-arrow-2"></i>
            </div>

        </a>
    </div>


</div>

<div class="row mb-3">
    <div class="col-12">
        <h2 class="text-center">Canceled Runs By Hour</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Time</th>
                <th>Canceled</th>
                <th>Time</th>
                <th>Canceled</th>
                <th>Time</th>
                <th>Canceled</th>
                <th>Time</th>
                <th>Canceled</th>
                <th>Time</th>
                <th>Canceled</th>
                <th>Time</th>
                <th>Canceled</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>00:00</td>
                <td>0</td>
                <td>04:00</td>
                <td>0</td>
                <td>08:00</td>
                <td>0</td>
                <td>12:00</td>
                <td>0</td>
                <td>16:00</td>
                <td>0</td>
                <td>20:00</td>
                <td>0</td>
            </tr>
            <tr>
                <td>01:00</td>
                <td>0</td>
                <td>05:00</td>
                <td>0</td>
                <td>09:00</td>
                <td>0</td>
                <td>13:00</td>
                <td>0</td>
                <td>17:00</td>
                <td>0</td>
                <td>21:00</td>
                <td>0</td>
            </tr>
            <tr>
                <td>02:00</td>
                <td>0</td>
                <td>06:00</td>
                <td>0</td>
                <td>10:00</td>
                <td>0</td>
                <td>14:00</td>
                <td>0</td>
                <td>18:00</td>
                <td>0</td>
                <td>22:00</td>
                <td>0</td>
            </tr>
            <tr>
                <td>03:00</td>
                <td>0</td>
                <td>07:00</td>
                <td>0</td>
                <td>11:00</td>
                <td>0</td>
                <td>15:00</td>
                <td>0</td>
                <td>19:00</td>
                <td>0</td>
                <td>23:00</td>
                <td>0</td>
            </tr>

            </tbody>
        </table>

    </div>
</div>

<div class="row mb-3">
    <div class="col-12 ">
        <h2 class="text-center">Canceled Runs By Facility</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Facility</th>
                <th>Total Canceled</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Facility</td>
                <td class="text-center">5</td>
            </tr>


            </tbody>
        </table>

    </div>
</div>

<div class="row">
    <div class="col-3">
        <div class="element-wrapper">
            <div class="element-header"><h3>Employees Late For Shift</h3></div>
        </div>
        <ul class="list-group list-group-accent">
            <li class="list-group-item"> No Late Employees</li>
        </ul>
    </div>
    <div class="col-3">
        <div class="element-wrapper">
            <div class="element-header"><h3>Complaints Reported</h3></div>
        </div>
        <ul class="list-group list-group-accent">
            <li class="list-group-item"> No Complaints Filed</li>
        </ul>
    </div>
    <div class="col-6">
        <div class="element-wrapper">
            <div class="element-header"><h3>Vehicle Report</h3></div>
            <table class="table table-striped">
                <tr class="text-center">
                    <th>Unit</th>
                    <th>Total Miles Driven</th>
                    <th>Est Fuel Cost</th>
                    <th>Actual Fuel Cost</th>
                    <th>Notes</th>
                </tr>
                @if($units)

                    @foreach($units as $row)
                        <?php
                        $incidents = \Vanguard\DispatchIncident::where('primaryUnitId', $row->id)->where('statusId', 10)->get();
                        $miles = 0;
                        $fuelCost = 0;
                        foreach ($incidents as $i)
                        {
                            $miles = $miles + $i->txpDistance;

                        }
                        $fuelCost =  $miles * .25 ;

                        ?>
                        <tr class="text-center">
                            <td>{{$row->level->identifier ?? ''}} {{$row->description ?? ''}}</td>
                            <td>{{$miles }}</td>
                            <td>${{number_format($fuelCost, 2) }}</td>
                            <td>TBD</td>
                            <td>None</td>
                        </tr>
                    @endforeach
                @else

                @endif
            </table>
        </div>
    </div>
</div>
