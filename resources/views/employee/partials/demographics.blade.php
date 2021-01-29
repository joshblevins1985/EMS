<!-- Card -->
<div class="card">
    @permission('view.photo')
    <!-- Card image -->
    <img src="{{asset('storage/'.$employees->photo)}}" class="card-img-top rounded-circle"
         onerror="this.src='/storage/employee_photos/nouser.png'"  alt="" style="height:300px;">
    @endpermission
    <!-- Card content -->
    <div class="card-body">
    
    <div class="row ">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                <strong>Employee Name</strong>
            </div>
            <div class="col-lg-8 col-sm-12">
                {{$employees->first_name.' ' .$employees->middle_name.' '. $employees->last_name}}
                <hr>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                <strong>Station</strong>
            </div>
            <div class="col-lg-8 col-sm-12">
                {{$employees->station->station}}
                <hr>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                <strong>Position</strong>
            </div>
            <div class="col-lg-8 col-sm-12">
                {{$employees->employeepositions->label}}
                <hr>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                <strong>Phone Number</strong>
            </div>
            <div class="col-lg-8 col-sm-12">
                {{ '('.substr($employees->phone_mobile, 0, 3).') '.substr($employees->phone_mobile, 3, 3).'-'.substr($employees->phone_mobile,6)  }}
                <hr>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                <strong>Email</strong>
            </div>
            <div class="col-lg-8 col-sm-12">
                <a href="mailto:{{$employees->email}}">{{$employees->email}}</a>
                <hr>
            </div>
            </div>
            <div class="row">
                
            </div>
            
            
          </div>  
            
            
        
    </div>
       

    </div>

</div>
<!-- Card -->