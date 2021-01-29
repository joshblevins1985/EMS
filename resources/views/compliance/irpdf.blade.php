<html>
<head>
	<title>User list - PDF</title>
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="row">
    <div class="col-lg-8">
        <div class="row justify-content-center">
            <h1 align="center">Portsmouth Emergency Ambulance Service Inc</h1>
            <p><h3 align="center">2796 Gallia Street Portsmouth, Ohio 45562</h3></p>

        </div>
        <div class="row justify-content-center "><h5 align="center">Phone: (740)351-3122  <image src="{{ url('public/assets/img/solrpt.jpg') }}"> Fax:(740)354-7100</h5></div>

        <div class="row border-bottom border-dark" style=" padding: 10px;">

                <span class=" font-weight-bold ">Employee  Report/Addendum

                </span>
        <hr>
        </div>
        <div class="row border-bottom border-dark report" style=" padding: 10px;">
            <div class="col-3">
                <span class="font-weight-bold report">Employee: {{$ir->employee->first_name}} {{$ir->employee->last_name}} EID: {{$ir->employee->eid}}</span>
            </div>
            <div class="col-3">
                <span class="font-weight-bold report">Job Title: {{$ir->employee->employeepositions->label}} </span>
            </div>
            <div class="col-3">
                <span class="font-weight-bold report">Date of Report: {{date('m-d-Y H:i', strtotime($ir->created_at))}}</span>
            </div>
            <div class="col-3">
                <span class="font-weight-bold report">Report ID: IR-{{date('y', strtotime($ir->created_at))}}-{{sprintf('%05d', $ir->id )}}</span>
            </div>
    <hr>
        </div>

        <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
            <div class="col-md-12">
                <span class="font-weight-bold ">Employee Statement:</span>
            </div>
            <div class="col-md-12">
                {!!$ir->report!!}
            </div>
            <hr>
        </div>
        
        
        <div style" position:fixed; bottom:0;">
           
           <div class="row border-bottom border-dark report">
            <div class="col-md-12">
                <span class="font-weight-italic">By signing this form, you attest that this is your true and accurate recall of the events. </span>
            </div>
            <hr>
        </div>
        <div class="row report" style=" padding: 10px;">
            <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                Employee Signature: Electronically Signed by: {{$ir->employee->first_name}} {{$ir->employee->last_name}} EID: {{$ir->employee->eid}}
            </div>
            <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
               Date: {{date('m-d-Y H:i', strtotime($ir->created_at))}} 
            </div>
            <hr>
        </div>
        <div class="row " style=" padding: 10px;">
            <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                Management Signature:__________________________________________________
            </div>
            <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                Date:_______________________
            </div>
        </div> 
            
        </div>
        
        

    </div>



</div>
</div>
</body>
</html>