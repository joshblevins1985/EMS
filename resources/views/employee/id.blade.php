<html>
<head>
    <title>User list - PDF</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
    body {
     margin: 0;
     background: url('{{public_path($employees->company->background)}}');
     background-repeat:no-repeat;
      background-size: 110% 110%; //stretch resize
    display: compact;

}
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row-fluid" style="height:5px" ></div>
    <div class="row-fluid" >

           <p style="text-align:center; ;"><span style="   margin-bottom: 0;  color: black; font-size: 20px; -webkit-text-fill-color: {{$employees->company->text_color}}; /* Will override color (regardless of order) */ -webkit-text-stroke-width: 4px; -webkit-text-stroke-color: black; ">{{$employees->company->badge_line_1}}</span></p>

    </div>
    <div class="row-fluid" style="border-bottom: 5px solid black;" ></div>
    <div class="row-fluid">

           <p style="text-align:center;"><span style="color: black; font-size: 26 px; -webkit-text-fill-color: {{$employees->company->text_color}}; /* Will override color (regardless of order) */ -webkit-text-stroke-width: 4px; -webkit-text-stroke-color: black; ">{{$employees->company->badge_line_2}}</span></p>

    </div>

    <div class="row-fluid">
        <div class="col-lg-12" style="margin-top: 15px">
            <p style="text-align:center;"><img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('storage/'.$employees->photo)))}}"  style="border:5px solid #021a40;" alt="Smiley face"  width="175" height="150"></p>
        </div>
    </div>
    <div class="row-fluid">
        <div class="col-12">
            <h4 style="text-align: center"><strong>{{$employees->first_name}} {{$employees->last_name}}</strong></h4>

        </div>

    </div>




    </div>


    <div class="row-fluid" style="{{$employees->employeepositions->color}}">
        <h5 align="center" style="color: linen">{{$employees->employeepositions->label}}</h5>
    </div>

    <div class="row-fluid">
        <div class="col-12" style="text-align: center">
             <small><strong>Employee ID: {{$employees->eid}}</strong></small>
        </div>

    </div>



</div>

</body>
</html>
