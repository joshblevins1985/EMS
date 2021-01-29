<html>
<head>
	<title>{{$encounter->Employee->first_name}} {{$encounter->Employee->last_name}} Encounter {{$encounter->id}}</title>
	<link rel="stylesheet" type="text/css" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
<html>
<head>
	<title>{{$encounter->Employee->first_name}} {{$encounter->Employee->last_name}} Encounter {{$encounter->id}}</title>
	<link rel="stylesheet" type="text/css" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-sm-12">
                <div class="row justify-content-center">
                    <h1 class="text-center">{{$encounter->company->name}}</h1>


                </div>


                <div class="row border-bottom border-dark" style=" padding: 10px;">

                    <span class=" font-weight-bold ">Employee  Notice
                    @if($encounter->encounter_type == 1)
                            File Notation
                        @elseif($encounter->encounter_type == 2)
                            Corrective Counciling
                        @elseif($encounter->encounter_type == 3)
                            Verbal Warning
                        @elseif($encounter->encounter_type == 4)
                            Written Warning
                        @elseif($encounter->encounter_type == 5)
                            Suspension
                        @elseif($encounter->encounter_type == 6)
                            Termination
                        @elseif($encounter->encounter_type == 7)
                            Resignation
                        @elseif($row->encounter_type == 8)
                            Deemed Non-Driver
                        @elseif($row->encounter_type == 9)
                            Last Chance Agreement
                        @endif
                    </span>

                </div>
                <div class="row border-bottom border-dark report" style=" padding: 10px;">
                    <div class="col-lg-12">
                        <table class="table table-borderless">
                            <tr>
                                <td>Employee:</td>
                                <td>{{$encounter->employee->first_name}} {{$encounter->employee->middle_name}}.  {{$encounter->employee->last_name}}</td>
                                <td>Job Title</td>
                                <td>{{$encounter->employee->employeepositions->label}}</td>
                                <td>Date of Incident</td>
                                <td>{{$encounter->doi}}</td>
                            </tr>
                        </table>

                    </div>

                </div>
                <div class="row border-bottom border-dark report" style=" padding: 10px;">
                    <div class="col-md-12">
                        <span class="font-weight-bold ">Policy Violated: {{$encounter->policies->policy_number}} -- {{$encounter->policies->title}}</span>
                    </div>

                </div>
                <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
                    <div class="col-md-12">
                        <span class="font-weight-bold ">Description of Incident:</span>
                    </div>
                    <div class="col-md-12">
                        {!!$encounter->incident_report!!}
                    </div>
                </div>
                <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
                    <div class="col-md-12">
                        <span class="font-weight-bold ">Plan of Action / Further Consequences:</span>
                    </div>
                    <div class="col-md-12">
                        {!!$encounter->plan!!}
                    </div>
                </div>
                <div class="row border-bottom border-dark report">
                    <div class="col-md-12">
                        <span class="font-weight-italic">By signing this form, you confirm that you understand the incident and warning that you are receiving.  You also understand the plan for improvement.  Signing this form does not necessarily indicate that you agree with this warning.</span>
                    </div>
                </div>
                <div class="row report" >
                    <div class="col-12" >
                        <table class="table table-borderless"> <tr><td>Employee Signature:__________________________________________________</td><td>Date:_____________</td></tr> </table>

                    </div>

                </div>
                <div class="row " >
                    <div class="col-12" >
                        <table class="table table-borderless"> <tr><td>Management Signature:__________________________________________________</td><td>Date:_____________</td></tr> </table>
                    </div>

                </div>
                <div class="row border-bottom border-dark report" >
                    <div class="col-12" style="margin-top: 5px; margin-bottom: 5px">
                        <table class="table table-borderless"> <tr><td>Witness Signature if employee refuses to sign:__________________________________________________</td></tr> </table>
                    </div>

                </div>
                <div class="row report">
                    <div class="col-12"><span class="font-weight-bold ">If suspension is warranted please detail dates and time:</span></div>
                    <div class="col-12"><span> </span></div>
                </div>
                <div class="row border-bottom border-dark report">
                    <div class="col-12"><span class="font-weight-bold ">List any attachments provided to the employee (policies, or other documents)</span></div>
                    <div class="col-12"><span >{{$encounter->associated}}</span></div>
                </div>

            </div>
    </div>

</div>
</body>
</html>
</div>
</body>
</html>
