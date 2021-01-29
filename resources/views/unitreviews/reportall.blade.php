<html>
<head>
    <title>User list - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/rowiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="container-fluid">
    
    @foreach($da as $row)

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="row justify-content-center">
                <h1>Portsmouth Emergency Ambulance Service Inc</h1>


            </div>
            <div class="row justify-content-center">

                <h3>2796 Gallia Street Portsmouth, Ohio 45562</h3>

            </div>
            <div class="row justify-content-center "><h5>Phone: (740)351-3122  <image src="{{ url('public/assets/img/solrpt.jpg') }}"> Fax:(740)354-7100</h5></div>

            <div class="row border-bottom border-rowrk" style=" padding: 10px;">

                        <span class=" font-weight-bold ">Emergency Medical Services Driving Assessment Report.

                        </span>

            </div>
            <div class="row border-bottom border-rowrk report" style=" padding: 10px;">
                <div class="col-4">
                    <span class="font-weight-bold report">Employee Name: {{$row->employee->first_name}} {{$row->employee->last_name}}</span>
                </div>
                <div class="col-4">
                    <span class="font-weight-bold report">Job Title: {{$row->employee->employeepositions->label}}  </span>
                </div>
                <div class="col-4">
                    <span class="font-weight-bold report">date of Evaluation: {{date('d-m-Y', strtotime($row->start_time))}} </span>
                </div>
            </div>
            <div class="row border-bottom border-rowrk report" style=" padding: 10px;">

                <div class="col-2">
                    <span class="font-weight-bold ">row-{{date('y', strtotime($row->date_of_evaluation))}}-{{sprintf('%05d', $row->id )}}</span>
                </div>
                <div class="col-6">
                    <span class="font-weight-bold ">Total Time Viewed: {{$row->total_time}}</span>
                </div>
                <div class="col-4">
                    <span class="font-weight-bold "> Grade: {{round($row->performance_rating)}} </span>

                </div>

            </div>
            <div class="row border-bottom border-rowrk report" style="min-height: 350px; padding: 10px;">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>Evaluation</th>
                        <th>Score</th>
                        <th>Avl Points</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dq as $dqrow)
                    <?php $score = 'q'.$dqrow->id ?>
                    
                    <tr>
                        <td>{{$dqrow->question}}</td>

                            @if($row->$score < $dqrow->p)
                                <td class="bg-danger">{{$row->$score}}</td>
                            @else
                                <td>{{$row->$score}}</td> 
                            @endif
                           
                        <td>{{$dqrow->p}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="row border-bottom border-dark report" style="min-height: 25px; padding: 10px;">
                <div class="row">
                    <div class="col-12">
                        <strong>Attachments:</strong>
                        @foreach($row->attachments as $at)
                            {{$at->file}},
                        @endforeach
                    </div>
                </div>

            </div>


            <div style="position: fixed;  width: 100%;">
                <div class="row border-bottom border-dark report">
                    <div class="col-12">
                        By signing this form, you confirm that you understand the notations that have been communicated to you.
                    </div>
                </div>

                <div class="row report" style=" padding: 10px;">
                    <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                        @if($row->signature)
                        Employee Signature:  <img src="{{ url('https://emscomplete.app/storage/app/'.$row->signature)  }}" alt="Employee Signature" style="width:150px;height:50px;"> 
                        @else

                        Employee Signature:__________________________________________________
                        
                        @endif
                        


                    </div>
                    <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                        @if($row->date_signed)
                        date:{{Carbon::parse($row->date_signed)->format('m-d-Y')}}
                        @else
                        date:____________________
                        @endif
                    </div>
                </div>
                <div class="row border-bottom border-dark report" style=" padding: 10px;">
                    <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                        @if(empty($row->evaluator))
                        Administration Signature:__________________________________________________
                        @else
                        Administration Signature: Electronically signed by {{$row->admin->first_name}} {{$row->admin->last_name}} {{$row->admin->eid}}
                        @endif
                    </div>
                    <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                        date: {{ date('m-d-Y', strtotime($row->created_at))}}
                    </div>
                </div>

            </div>



        </div>

    </div>
    <div style="page-break-after: always;"></div>
    @endforeach



</div>

</body>
</html>