
            
            
            <div class="col-lg-12">
                
    			<div class="card mdb-color lighten-1 text-white">
    
                  <!-- Card content -->
                  <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <!-- Title -->
                                <h4 class="card-title"><a href="brs/weekly">TOTAL PCR PENDING FIXES</a></h4>
                                <h1>Pending: {{$brs}}</h1>
                                <h1>Ack: {{$brsa}}</h1>
                            </div>
                            <div class="col-lg-2">
                                 <!-- Button -->
                                <i class="fa fa-paperclip fa-5x" aria-hidden="true"></i>
                            </div>
                        </div>
    
                  </div>
                
                </div>
                
    		</div>
    		
    		<div class="col-lg-12">
    			<div class="card deep-orange darken-1 text-white">
    
                  <!-- Card content -->
                  <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <!-- Title -->
                                <h4 class="card-title"><a>QA QI AVERAGE</a></h4>
                                <h1> {{round($qa)}} %</h1>
                            </div>
                            <div class="col-lg-2">
                                 <!-- Button -->
                                <i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i>
                            </div>
                        </div>
    
                  </div>
                
                </div>
    		</div>