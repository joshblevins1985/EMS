<html>
<head>
    <title>User list - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <style> 
    body {
     margin: 0;
     background: url('{{$employees->company->background}}');
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
        <div class="col-lg-12" style="margin-top: 15px; margin: 0;
     background: url('https://emscomplete.app/storage/app/photos/american_flag.png');
     background-repeat:no-repeat; background-size: 110% 110%; //stretch resize
    display: compact;">
            <p style="text-align:center;"><img src="{{asset('storage/'.$employees->photo)}}" onerror="this.src='https://peasi.app/storage/app/employee_photos/nouser.png'" style="border:5px solid #021a40;" alt="Smiley face"  width="175" height="160"></p>
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
    
    <div class="row-fluid">
        <div class="col-3" >
             <img src="https://emscomplete.app/storage/app/photos/US-VETERAN-seal.png" onerror="this.src='https://emscomplete.app/storage/app/photos/US-VETERAN-seal.png'" alt="Smiley face"  width="40" height="40">
        </div>
        
        
        
    </div>



</div>

</body>
</html>