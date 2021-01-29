<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Certificate of Completion</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="container" style="margin: 20px">
            <div id="header" style=" margin-bottom: 25px">
                <hr>
                <h1 style="text-align: center">PORTSMOUTH EMERGENCY AMBULANCE SERVICE TRAINING</h1>
                <hr>
                <p style="font-size: 18pt; font-style: italic; text-align: center"> Continuing Education Certificate of Completion</p>
            </div>

            <div id="header" style="clear: both">



                  <p><h1 style="text-align: center">{{$student->employee->first_name}} {{$student->employee->last_name}}</h1>

            </div>

            <div style=" margin-bottom: 25px">
                <div  align="left" style="float: left; width: 25%" >
                    <img style="width:150px; height: 150px" src="{{ url('public/assets/img/sol.jpg') }}" class="img-fluid flex-center">
                    </div>
                <div align="center" style="float: left; text-align: center; width: 50%"> <h3>Has successfully completed  {{$student->course->hours}}  hours in {{$student->course->topic}} on the following topic:</h3> </div>
                <div   style="float: right; clear: right; width: 25% " align="right" ><img style="width:150px; height: 150px" src="{{ url('public/assets/img/sol.jpg') }}" class="img-fluid flex-center"></div>
            </div>

            <div id="header" style="clear: both">

                <p><h2 style="text-align: center"> {{$student->course->lable}} </h2>
                <hr>
            </div>
            <div id="header" style="clear: both">
                <p><h3 style="text-align: center">On: {{date('M d, Y', strtotime($student->completed))}}</h3>
                <hr>
            </div>

            <div style="font-style: italic; font-weight: bolder; text-align: center; margin-bottom: 30px">OHIO DEPARTMENT OF PUBLIC SAFETY APPROVAL #1327</div>

            <div style="float: left">
                <div style="margin-bottom: 20px">Instructor: Joshua Blevins</div>
                <div style="margin-bottom: 20px">Program Director:
                <img style="width:150px; height: 75px" src="{{ url('public/assets/img/josh_signature.PNG') }}" class="img-fluid flex-center">
            </div>
            </div>
            <div style="float: right">
                <img style="width:250px; height: 150px" src="{{ url('public/assets/img/ambulance.PNG') }}" class="img-fluid flex-center">
                </div>
                 

      
            
                
        </div>
    </body>
</html>
