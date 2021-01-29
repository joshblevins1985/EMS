<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Quality Assurance - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-8">
            
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td>Title</td>
                    <td>Employee Turn Over Report</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td></td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Requested By:</td>
                    <td>Auto Generated</td>
                </tr>
                </tbody>
            </table>

        </div>
        <hr>
    </div>
    
    <section>
    <div class="row">
        <h2>Portsmouth Emergency Ambulance Service</h2>
        <hr>
    </div>
    
    <div class="row">
        <table class="table table-striped">
            <thead>
                <th>Date</th>
                <th>Levels</th>
                <th>Count</th>
                <th>New Hire</th>
                <th>ReHire</th>
                <th>Self Term</th>
                <th>Term</th>
                <th>Turn Over</th>
            </thead>
            <tbody>
                
                <? 
                $start = "2019-11-08";
        
                $end = "2019-11-14";
                
                function getDatesFromRange($start, $end, $format = 'Y-m-d') {
                    $array = array();
                    $interval = new DateInterval('P7D');
                
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval);
                
                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                    
                    foreach($period as $date) { 
                        $array[] = $date->format($format); 
                    }
                    
                    return $array;
                }

                ?>
                
                <?
                
                ?>

               
                    <tr>
                    <td rowspan="5"> {{$start}} to {{$end}} </td>
                </tr>
                <tr>
                    <td>WC</td>
                    <td>@foreach($employee->where('primary_position', 11) as $row) {{$row->count_active}}  @endforeach</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>@foreach($employee->where('primary_position', 11) as $row) {{$row->count_term}}  @endforeach</td>
                    
                    <td> @foreach($employee->where('primary_position', 11) as $row) <? $total = $row->count_active + $row->count_all; $average = $total/ 2 ;   $to = $row->count_term / $average * 100; echo round($to); ?> % @endforeach </td>
                </tr>
                <tr>
                    <td>EMT</td>
                    <td>@foreach($employee->where('primary_position', 3) as $row) {{$row->count_active}}  @endforeach</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>@foreach($employee->where('primary_position', 3) as $row) {{$row->count_term}}  @endforeach</td>
                    <td>@foreach($employee->where('primary_position', 3) as $row) <? $total = $row->count_active + $row->count_all; $average = $total/ 2 ;   $to = $row->count_term / $average * 100 ; echo round($to); ?> % @endforeach</td>
                </tr>
                <tr>
                    <td>AEMT</td>
                    <td>@foreach($employee->where('primary_position', 4) as $row) {{$row->count_active}}  @endforeach</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>@foreach($employee->where('primary_position', 4) as $row) {{$row->count_term}}  @endforeach</td>
                    <td>@foreach($employee->where('primary_position', 4) as $row) <? $total = $row->count_active + $row->count_all; $average = $total/ 2 ;   $to = $row->count_term / $average *100 ; echo round($to); ?> % @endforeach</td>
                </tr>
                <tr>
                    <td>MEDIC</td>
                    <td>@foreach($employee->where('primary_position', 5) as $row) {{$row->count_active}}  @endforeach</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>@foreach($employee->where('primary_position', 5) as $row) {{$row->count_term}}  @endforeach</td>
                    <td>@foreach($employee->where('primary_position', 5) as $row) <? $total = $row->count_active + $row->count_all; $average = $total/ 2 ;   $to = $row->count_term / $average *100; echo round($to); ?> % @endforeach</td>
                </tr>
                    
                          
                
               
                
            </tbody>
        </table>
    </div>
    <div style="page-break-after: always; page-break-inside: avoid;"></div>
</section>



@foreach($station as $sta)
<div class="row">
        <div class="col-8">
            
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td>Title</td>
                    <td>Employee Turn Over Report</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>xxx</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>xxx</td>
                </tr>
                <tr>
                    <td>Requested By:</td>
                    <td>Auto Generated</td>
                </tr>
                </tbody>
            </table>

        </div>
        <hr>
    </div>




<section>
    <div class="row">
        <h2>{{$sta->station}}</h2>
        <hr>
    </div>
    
    <div class="row">
        <table class="table table-striped">
            <thead>
                <th>Date</th>
                <th>Levels</th>
                <th>Count</th>
                <th>New Hire</th>
                <th>ReHire</th>
                <th>Self Term</th>
                <th>Term</th>
                <th>Turn Over</th>
            </thead>
            <tbody>
                <?
                $start = "2019-11-08";
        
                $end = "2019-11-14";
                ?>
               
                    <?
                    
                    $es = Vanguard\Employee::where('primary_station', $sta->id)->groupBy('primary_position')->get(array(
                //DB::raw('sum(if(primary_position = 11, 1,0)) as wc'),
                DB::raw('primary_position'),
                DB::raw('count(*) as count_all'),
                DB::raw('sum(if(status = 5, 1,0)) count_active'),
                DB::raw("sum(if(status = 8 AND updated_at BETWEEN '$start' AND '$end', 1,0)) count_term"),
                )) ;
                    ?>
                    
                    <tr>
                    <td rowspan="5"> {{$start}} to {{$end}} </td>
                </tr>
                <tr>
                    <td>WC</td>
                    <td>@foreach($es->where('primary_position', 11) as $row) {{$row->count_active}}  @endforeach</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>@foreach($es->where('primary_position', 11) as $row) {{$row->count_term}}  @endforeach</td>
                    
                    <td> @foreach($es->where('primary_position', 11) as $row) <? $total = $row->count_active + $row->count_all; $average = $total/ 2 ;   $to = $row->count_term / $average * 100; echo round($to); ?> % @endforeach </td>
                </tr>
                <tr>
                    <td>EMT</td>
                    <td>@foreach($es->where('primary_position', 3) as $row) {{$row->count_active}}  @endforeach</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>@foreach($es->where('primary_position', 3) as $row) {{$row->count_term}}  @endforeach</td>
                    <td>@foreach($es->where('primary_position', 3) as $row) <? $total = $row->count_active + $row->count_all; $average = $total/ 2 ;   $to = $row->count_term / $average * 100 ; echo round($to); ?> % @endforeach</td>
                </tr>
                <tr>
                    <td>AEMT</td>
                    <td>@foreach($es->where('primary_position', 4) as $row) {{$row->count_active}}  @endforeach</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>@foreach($es->where('primary_position', 4) as $row) {{$row->count_term}}  @endforeach</td>
                    <td>@foreach($es->where('primary_position', 4) as $row) <? $total = $row->count_active + $row->count_all; $average = $total/ 2 ;   $to = $row->count_term / $average *100 ; echo round($to); ?> % @endforeach</td>
                </tr>
                <tr>
                    <td>MEDIC</td>
                    <td>@foreach($es->where('primary_position', 5) as $row) {{$row->count_active}}  @endforeach</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>@foreach($es->where('primary_position', 5) as $row) {{$row->count_term}}  @endforeach</td>
                    <td>@foreach($es->where('primary_position', 5) as $row) <? $total = $row->count_active + $row->count_all; $average = $total/ 2 ;   $to = $row->count_term / $average *100; echo round($to); ?> % @endforeach</td>
                </tr>
               
                
            </tbody>
        </table>
    </div>
    <div style="page-break-after: always; page-break-inside: avoid;"></div>
</section>
@endforeach


</div>
</body>
</html>