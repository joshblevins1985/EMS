<html>
    <head>
        <title>Certificate of Completion</title>
        <meta charset="windows-1252">
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



                  <p><h1 style="text-align: center">{{$enrolled->student->first_name}} {{$enrolled->student->last_name}}</h1>

            </div>

            <div style=" margin-bottom: 25px">
                <div  align="left" style="float: left; width: 25%" >
                    <img style="width:150px; height: 150px" src="{{ asse('/assets/img/sol.jpg') }}" class="img-fluid flex-center">
                    </div>
                <div align="center" style="float: left; text-align: center; width: 50%"> <h3>Has successfully completed  {{$class->course->hours}}  hours in {{$class->course->topic->label}} on the following topic:</h3> </div>
                <div   style="float: right; clear: right; width: 25% " align="right" ><img style="width:150px; height: 150px" src="{{ asset('/assets/img/sol.jpg') }}" class="img-fluid flex-center"></div>
            </div>

            <div id="header" style="clear: both">

                <p><h2 style="text-align: center"> {{$class->course->title}} -- Course ID: {{$class->iid}} </h2>
                <hr>
            </div>
            <div id="header" style="clear: both">
                <p><h3 style="text-align: center">On: {{date('M d, Y', strtotime($enrolled->completed))}}</h3>
                <hr>
            </div>

            <div style="font-style: italic; font-weight: bolder; text-align: center; margin-bottom: 30px">OHIO DEPARTMENT OF PUBLIC SAFETY APPROVAL #1327</div>

            <div style="float: left">
                <div style="margin-bottom: 20px">Instructor: {{$class->lead->first_name}} {{$class->lead->last_name}}</div>
                <div style="margin-bottom: 20px">Program Director:
                <img style="width:150px; height: 75px" src="{{ asset('/assets/img/josh_signature.PNG') }}" class="img-fluid flex-center">
            </div>
            </div>
            <div style="float: right">
                <img style="width:250px; height: 150px" src="{{ asset('/assets/img/ambulance.PNG') }}" class="img-fluid flex-center">
                </div>
        </div>
    </body>
</html>
