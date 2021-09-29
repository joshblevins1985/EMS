<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Quality Assurance - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<tbody>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>QA Manager Report</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>QA Manager Report</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>{{date('m-d-Y', strtotime($start))}}</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>{{date('m-d-Y', strtotime($end))}}</td>
                </tr>
                <tr>
                    <td>Requested By:</td>
                    <td>{{ auth()->user()->present()->nameOrEmail }}</td>
                </tr>
                </tbody>
            </table>

        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Bad Run Sheet Counts</h2>
        </div>
        <div class="col-12">
            <table class="table table">
                <thead>
                <tr>
                    <th>Station</th>
                    <th>Total Pending</th>
                    <th>Manager</th>
                    <th>Regional</th>
                </tr>
                </thead>
                <thead>
                @foreach($brs as $row)
                    <tr>
                        <td> {{$row->station ?? ''}} </td>
                        <td> {{count($row->brs)}} </td>
                        <td> {{$row->mgr->first_name ?? ''}} {{$row->mgr->last_name ?? ''}} </td>
                        <td>{{$row->Regional->first_name ?? ''}} {{$row->Regional->last_name ?? ''}}</td>
                    </tr>
                @endforeach
                </thead>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">QA Concerns</h2>
        </div>
        <div class="col-12">
            <table class="table table">
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Qty</th>
                    <th>Total Insufficent</th>
                    <th>All QA Average</th>
                    <th>70%-80 %</th>
                    <th>60%-69 %</th>
                    <th>50%-59 %</th>
                    <th> < 50%</th>
                </tr>
                </thead>
                <thead>
                @foreach($concerns as $row)
                    <?php $avg = Vanguard\QaQi::where('employee_id', $row->employee_id)->avg('percent');
                    $count = Vanguard\QaQi::where('employee_id', $row->employee_id)->get();

                    ?>
                    <tr>
                        <td> {{$row->employee->last_name ?? ''}} {{$row->employee->first_name ?? ''}} </td>
                        <td>{{count($count)}}</td>
                        <td>{{ round($avg) }}</td>
                        <td>{{$row->count}}</td>
                        <td>{{$row->step1}}</td>
                        <td>{{$row->step2}}</td>
                        <td>{{$row->step3}}</td>
                        <td>{{$row->step4}}</td>

                    </tr>
                @endforeach
                </thead>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Manager Counts</h2>
        </div>
        <div class="col-12">
            <table class="table table">
                <thed>
                    <tr>
                        <th>Manager</th>
                        <th>Completed</th>
                        <th>Sufficient</th>
                        <th>Insufficient</th>
                    </tr>
                </thed>
                <tbody>
                @foreach($regionals as $row)
                    <?php
                    $qa = Vanguard\QaQi::whereBetween('created_at', [$start, $end])->where('added_by', $row->regional_manager)->get();


                    ?>

                    <tr>
                        <th><strong> {{$row->Regional->last_name ?? ''}}
                                , {{$row->Regional->first_name ?? ''}}</strong></th>
                        <th><strong></strong> {{count($qa)}} </th>
                        <th><strong></strong> {{count($qa->where('grade', 1))}}</th>
                        <th><strong></strong> {{count($qa->where('grade', 2))}} </th>
                    </tr>

                @endforeach
                @foreach($managers as $row)
                    <?php
                    $qa = Vanguard\QaQi::whereBetween('created_at', [$start, $end])->where('added_by', $row->manager)->get(); ?>
                    <tr>
                        <td><strong> {{$row->mgr->last_name ?? ''}}, {{$row->mgr->first_name ?? ''}}</strong></td>
                        <td><strong></strong> {{count($qa)}} </td>
                        <td><strong></strong> {{count($qa->where('grade', 1))}}</td>
                        <td><strong></strong> {{count($qa->where('grade', 2))}} </td>
                    </tr>


                @endforeach

                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Regional Managers</h2>
            </div>
            @foreach($regionals as $row)
                <?php
                $qa = Vanguard\QaQi::whereBetween('created_at', [$start, $end])->where('added_by', $row->regional_manager)->get();


                ?>
                <div class="col-12">
                    <table class="table table">
                        <thead>
                        <tr>
                            <th><strong>Manager: {{$row->Regional->last_name ?? ''}}
                                    , {{$row->Regional->first_name ?? ''}}</strong></th>
                            <th><strong>Completed:</strong> {{count($qa)}} </th>
                            <th><strong>Sufficient:</strong> {{count($qa->where('grade', 1))}}</th>
                            <th><strong>Insufficient:</strong> {{count($qa->where('grade', 2))}} </th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Employee</th>
                            <th>QA #</th>
                            <th>Grade</th>
                            <th>Percent</th>
                            <th>Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qa as $row)
                            <tr @if($row->grade == 2) class="bg-danger" @endif>
                                <td>
                                    <p>{{$row->employee->last_name ?? ''}} {{$row->employee->first_name ?? ''}}</p> {{\Carbon\Carbon::parse($row->created_at)->format('m-d-Y H:i')}}
                                </td>
                                <td>QA-{{date('y', strtotime($row->date))}}-{{sprintf('%05d', $row->id )}}</td>
                                <td>@if($row->grade == 1) S @elseif($row->grade == 2) I @endif</td>
                                <td>{{$row->percent}} %</td>
                                <td>{!! $row->comments !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Station Managers</h2>
            </div>
            @foreach($managers as $row)
                <?php
                $qa = Vanguard\QaQi::whereBetween('created_at', [$start, $end])->where('added_by', $row->manager)->get();


                ?>
                <div class="col-12">
                    <table class="table table">
                        <thead>
                        <tr>
                            <th><strong>Manager: {{$row->mgr->last_name ?? ''}}
                                    , {{$row->mgr->first_name ?? ''}}</strong></th>
                            <th><strong>Completed:</strong> {{count($qa)}} </th>
                            <th><strong>Sufficient:</strong> {{count($qa->where('grade', 1))}}</th>
                            <th><strong>Insufficient:</strong> {{count($qa->where('grade', 2))}} </th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Employee</th>
                            <th>QA #</th>
                            <th>Grade</th>
                            <th>Percent</th>
                            <th>Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qa as $row)
                            <tr @if($row->grade == 2) class="bg-danger" @endif>
                                <td>
                                    <p>{{$row->employee->last_name ?? ''}} {{$row->employee->first_name ?? ''}}</p> {{\Carbon\Carbon::parse($row->created_at)->format('m-d-Y H:i')}}
                                </td>
                                <td>QA-{{date('y', strtotime($row->date))}}-{{sprintf('%05d', $row->id )}}  </td>
                                <td>@if($row->grade == 1) S @elseif($row->grade == 2) I @endif</td>
                                <td>{{$row->percent}} %</td>
                                <td>{!! $row->comments !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>

    </div>
    </body>
</html>