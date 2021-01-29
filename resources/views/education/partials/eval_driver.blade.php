<div class="col-lg-6 col-md-6">

        <!--Panel-->
        <div class="card text-center">
            <div class="card-header success-color white-text">
               Employees Driver Evaluation
            </div>
            <div class="card-body">
               @if(!$eval)
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">All drivers have been evaluated.</h5>
                      
                    </div>
                    
                    
                  </a>
                  <hr>
                @else
                <div class="list-group">
                    @foreach($eval as $row)
                  <a href="employees/{{$row->id}}" target="_blank" class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{$row->last_name}} {{$row->first_name}}</h5>
                      <small></small>
                    </div>
                    </a>
                  <hr>
                  @endforeach
                </div>
                @endif
            </div>
            <div class="card-footer text-muted success-color white-text">
                <p class="mb-0"></p>
            </div>
        </div>
        <!--/.Panel-->

    </div>