<html>
<head>
	<title>Dispatch Card</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    if($message){
        echo $message;
    }else{?>
        
        <div class="row">
        <div class="card">
          <div class="card-body">
            
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header bg-warning">
                        <strong>Incident Information <h5 class="card-title">{{$i->incident_number}}</h5></strong>
                      </div>
                      <div class="card-body">
                          
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <strong>Pick Up Time:</strong> {{ Carbon\Carbon::parse($i->pick_up)->format('m-d-Y H:i') }}
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <strong>Appointment Time:</strong> @if($i->apt_time) {{ Carbon\Carbon::parse($i->apt_time)->format('m-d-Y H:i') }} @else Not Applicapable @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <strong>Incident Type:</strong> {{$i->type->description or 'Unknown'}}
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <strong>Incident Priority:</strong> @if($i->priority == 1) Immediate @elseif($i->priority == 2) High @elseif($i->priority == 3) Medium @elseif($i->priority == 4) Low @else Unknown @endif
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <address>
                                       
                                      <strong>Pick Up Location</strong><br>
                                       {{$i->pick_up_facility->name or ''}} <br>
                                      {{$i->house_number}} {{ucwords($i->incident_address)}}<br>
                                      {{ucwords($i->incident_city)}} {{ucwords($i->incident_state)}} {{$i->incident_zip}}<br>
                                      
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    
                                    <address>
                                      <strong>Drop Off Location</strong><br>
                                      {{$i->destination_facility_id or 'Destination Location Pending'}}<br>
                                      {{$i->destination_house_number or ''}} {{ucwords($i->destination_address)}}<br>
                                      {{ucwords($i->destination_city)}} {{ucwords($i->destination_state)}} {{$i->destination_zip or ''}}<br>
                                      
                                    </address>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header bg-primary">
                        <strong>Patient Demographic Information</strong>
                      </div>
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <strong>Patient Name</strong>
                            </div>
                            <div class="col-md-10 col-sm-12">
                                {{$i->patient->first_name or ''}} {{$i->patient->last_name or ''}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 col-sm-12">
                                <strong>DOB</strong>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                {{ Carbon\Carbon::parse($i->patient->dob)->format('m-d-Y') }}
                            </div>
                            <div class="col-md-1 col-sm-12">
                                <strong>Age</strong>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <strong>Phone</strong>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                {{ print preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $i->patient->phone_mobile). "\n"}}
                            </div>
                        </div>
                      </div>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header bg-danger">
                        <strong>Medical Necessity Statement</strong>
                      </div>
                      <div class="card-body">
                           @foreach($i->patient->qualification as $row)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        {{$row->qualification}}
                                    </div>
 
                                </div>
                                
                            </li>
                                
                            @endforeach
                        </div>
                      </div>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header bg-primary">
                        <strong>Patient Medical Insurance Information</strong>
                      </div>
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <strong>Policy Name</strong>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <strong>Policy Number</strong>
                                    </div>
                                </div>
                                
                            </li>
                            @foreach($i->patient->insurance as $row)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        {{$row->insur->label}}
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        {{$row->policy_id}}
                                    </div>
                                </div>
                                
                            </li>
                                
                            @endforeach
                            
                          </ul>
                      </div>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header bg-primary">
                        <strong>Patient Medical History</strong>
                      </div>
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <strong>Condition</strong>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <strong>Medical Qualifier</strong>
                                    </div>
                                </div>
                                
                            </li>
                            @foreach($i->patient->medical as $row)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        {{$row->condition->label}}
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        @if($row->qualifier == 1)
                                            <i class="far fa-check-circle"></i>
                                        @else
                                        
                                        @endif
                                    </div>
                                </div>
                                
                            </li>
                                
                            @endforeach
                            
                          </ul>
                      </div>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header bg-primary">
                        <strong>Patient Medication Allergies</strong>
                      </div>
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <strong>Medication</strong>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <strong>Reaction</strong>
                                    </div>
                                </div>
                                
                            </li>
                            
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        NKDA
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        
                                    </div>
                                </div>
                                
                            </li>
                                
                            
                            
                          </ul>
                      </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header bg-primary">
                        <strong>Patient Medications</strong>
                      </div>
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <strong>Medication</strong>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <strong>Dose</strong>
                                    </div>
                                </div>
                                
                            </li>
                            
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        NKRX
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        
                                    </div>
                                </div>
                                
                            </li>
                                
                            
                            
                          </ul>
                      </div>
                    </div>
                </div>

            </div>
            
            
            
          </div>
        </div>
    </div>
        
    <?php }
    ?>
</div>
</body>
</html>