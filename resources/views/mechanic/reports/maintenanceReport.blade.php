<html>
<head>
    <title>PR&T Maintenance Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row mb-2 justify-content-center">
        <div class="col-12">
            <h2 class="text-center"> PR&T Maintenance Repair Report</h2>
        </div>

        <hr/>
    </div>

    <div class="row border-bottom-1">
        <h3>Malfunction Reported</h3>
    </div>
    <div class="row">
        <div class="col-3">
            <strong>Unit Number</strong>

        </div>
        <div class="col-3">
            {{$task->unit->unit_number or 'Unknown Unit Number'}}
        </div>
        <div class="col-3">
            <strong>Unit VIN:</strong>
        </div>
        <div class="col-3">
            {{$task->unit->vin or 'Uknown Unit VIN'}}
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-3">
            <strong>Reported By:</strong>
        </div>
        <div class="col-3">
            {{$task->report->reported_by->first_name or 'Unknown'}} {{$task->report->reported_by->last_name or 'Unknown'}}
        </div>
        <div class="col-3">
            <strong>Date Reported:</strong>
        </div>
        <div class="col-3">
            {{ Carbon\Carbon::parse($task->created_at)->format('M d, Y') }}
        </div>
    </div>

    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th colspan="2">Malfunction Being Repaired on This report</th>
            </tr>
            <tr>
                <th>Malfunction</th>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$task->task_label->label or ''}}</td>
                <td>{{$task->comments or 'No Comments Noted'}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th colspan="3">Other Malfunctions Reported With This Report</th>
            </tr>
            <tr>
                <th>Malfunction</th>
                <th>Comments</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $other_tasks = Vanguard\MechanicTask::where('pid', $task->pid)->where('id', '!=', $task->id)->get();

            //dd($other_tasks);
            ?>
            @if(count($other_tasks))
                @foreach($other_tasks as $row)
                    <tr>
                        <td>{{$row->task_label->label or ''}}</td>
                        <td>{{$row->comments or 'No Comments Noted'}}</td>
                        <td>
                            @if($row->status == 1)  <?php $color = 'bg-danger'; $status = 'Pending';?>
                            @elseif($row->status == 2) <?php $color = 'bg-warning'; $status = 'Assigned';?>
                            @elseif($row->status == 3) <?php $color = 'bg-primary'; $status = 'Working';?>
                            @elseif($row->status == 4) <?php $color = 'bg-info'; $status = 'Inspection';?>
                            @elseif($row->status == 5) <?php $color = 'bg-success'; $status = 'Completed';?>
                            @endif

                            {{$status}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">No Other Malfunctions Reported</td>
                </tr>
            @endif


            </tbody>
        </table>
    </div>

    <div class="row border-bottom-0">
        <div class="col-12">
            <h3>Repair Audit</h3>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <tbody>
            <tr>
                <td>Reported</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Started</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Inspected</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Completed</td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row border-bottom-0">
        <div class="col-12">
            <h3>Parts Used</h3>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>Part Name</th>
                <th>Cost</th>
                <th>Location</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $parts = Vanguard\Part::where('used_on', $task->id)->get();
            ?>
            @if($parts)
                @foreach($parts as $row)
                    <tr>
                        <td>{{$row->part->name}}</td>
                        <td>$ {{$row->part->cost or '0.00'}}</td>
                        <td></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center"> No Parts Used For This Repair</td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>

    <div class="row border-bottom-0">
        <div class="col-12">
            <h3>Total Costs Associated</h3>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <tbody>
            <tr>
                <td>Labor</td>
                <td>$0.00</td>
            </tr>
            <tr>
                <td>Parts</td>
                <td>$0.00</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>