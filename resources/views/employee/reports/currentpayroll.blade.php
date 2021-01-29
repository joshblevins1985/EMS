<div class="row-fluid" id="payrollReport" >
    
<div class="row-fluid">
    <div class="col-sm-4 float-left"><h1>Employee Payroll Report</h1></div>

    <div class="col-sm-4 float-right">
        <div class="row">
            <div class="col-6">
                Employee ID:
            </div>
            <div class="col-6 ">
                {{$employees->eid}}
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Employee Name:
            </div>
            <div class="col-6 ">
                {{$employees->first_name}}. {{$employees->last_name}}
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Report Start Date:
            </div>
            <div class="col-6 ">
                {{$start}}
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Report End Date:
            </div>
            <div class="col-6 ">
                {{$end}}
            </div>
        </div>
    </div>
    <div class="col-sm-4 float-right">
        <div class="col-12">
            Time Clock = TC
        </div>
        <div class="col-12">
            Edit = E
        </div>
        <div class="col-12">
            Manual = M
        </div>
        <div class="col-12">
            Mobile = MO
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="col-sm-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Clock In</th>
                <th>Method</th>
                <th>Clock Out</th>
                <th>Method</th>
                <th>Punch Total Hours</th>
                <th>Running Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $wk1tot = 0;
            $wk2tot = 0;

            $wk1st = 0;
            $wk2st = 0;
            $wk1ot = 0;
            $wk2ot = 0;
            $ppst = 0;
            $ppot = 0;
            $comp = 0;
            ?>
            @if(count($employees->timepunch))
                <?php

                $ppstart = $start;
                $wk1end = strtotime($ppstart . '+ 6 days');

                $ppend = $end;
                $wk2start = strtotime($ppend . '- 6 days');

                $ppstart = strtotime($ppstart);
                $ppend = strtotime($ppend);


                ?>
                @foreach($employees->timepunch as $add)
                    <?php
                    if ($add->time_out === NULL) {

                    } else {
                        $time_in = strtotime($add->time_in);
                        $time_out = strtotime($add->time_out);
                        if ($time_in >= $ppstart && $time_in <= $wk1end) {

                            $shifthours = $time_out - $time_in;

                            $wk1tot = $wk1tot + $shifthours / (60 * 60);

                            if ($wk1tot > 40) {
                                $wk1st = 40;
                                $wk1ot = $wk1tot - 40;
                            } elseif ($wk1tot <= 0) {
                                $wk1ot = 0;
                                $wk1st = $wk1tot;
                            } else {
                                $wk1ot = 0;
                                $wk1st = $wk1tot;
                            }

                        } elseif ($time_in >= $wk2start && $time_in <= $ppend) {

                            if ($add->time_out === NULL) {
                                $shifthours = 0;
                            } else {
                                $shifthours = $time_out - $time_in;

                                $wk2tot = $wk2tot + $shifthours / (60 * 60);


                                if ($wk2tot > 40) {
                                    $wk2st = 40;
                                    $wk2ot = $wk2tot - 40;
                                } elseif ($wk2tot <= 0) {
                                    $wk2ot = 0;
                                    $wk2st = $wk1tot;
                                } else {
                                    $wk2ot = 0;
                                    $wk2st = $wk2tot;
                                }
                            }

                        }
                    }


                    ?>
                @endforeach

                <?php
                $ppst = $wk1st + $wk2st;
                $ppot = $wk1ot + $wk2ot;



                ?>
            @endif
            <?php $comb = 0;
            $runningtotal = 0 ;
            ?>
            @foreach($employees->timepunch as $row)
                <?php
                if($row->time_out === NULL){
                    $tothours = 0;
                    
                }else{
                    $time_in = strtotime($row->time_in);
                    $time_out = strtotime($row->time_out);
                    $shifthours = $time_out - $time_in;
                    $tothours = $shifthours / (60*60);
                    
                    $total = $tothours + $runningtotal;
                }
               
                
                ?>
                <tr>
                    <td>{{$row->time_in}}</td>
                    <td>{{$row->how_in}}</td>
                    <td>{{$row->time_out}}</td>
                    <td>{{$row->how_out}}</td>
                    <td>{{number_format((float)$tothours,2,'.','')}}</td>
                    <td>{{number_format((float)$total,2,'.','')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>