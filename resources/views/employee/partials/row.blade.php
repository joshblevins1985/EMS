
        <div class="col-lg-4 col-md-12">
            <!--Card-->
            <div class="card card-cascade narrower mb-4" style="margin-top: 28px">

                @permission('view.photo')

                <!--Card image-->
                <div class="view view-cascade top rounded-circle">
                    <a href="/employee/id/{{$employee->id}}"> <img src="{{asset('employee_photos/'.$employee->eid.'.png')}}" class="card-img-top rounded-circle"
                                                             onerror="this.src='/employee_photos/nouser.png'"  alt="" style="height:300px;"> </a>
                    <a href="/employee/id/{{$employee->id}}">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                @endpermission
                <!--/.Card image-->

                <!--Card content-->
                <div class="card-body card-body-cascade">
                    <h5 class="pink-text"><i class="fa fa-user"></i> {{$employee->last_name}}, {{$employee->first_name}} - {{$employee->eid}}</h5>
                    <!--Title-->
                    <h4 class="card-title">@if(!$employee->station) Unknown Station  @else{{$employee->station->station}}@endif</h4>
                    <!--Text-->
                    <p class="card-text">{{ $employee->employeepositions->label or 'Unknown'}}</p>
                    <p class="card-text"> @if($employee->driver == 0) Non-Driver @elseif($employee->driver = 1 ) Driver @endif </p>
                    <small>{{ $employee->email }}</small>
                    <p class="card-text">{{ '('.substr($employee->phone_mobile, 0, 3).') '.substr($employee->phone_mobile, 3, 3).'-'.substr($employee->phone_mobile,6)  }}</p>

                    @if ($employee->status == 1)
                        <span class="badge badge-dark">Applicant </span>
                    @elseif($employee->status == 2)
                        <span class="badge badge-primary">Pre-Hire</span>
                    @elseif($employee->status == 3)
                        <span class="badge badge-warning">Company Orientation</span>
                    @elseif($employee->status == 4)
                        <span class="badge badge-warning">Field Orientation</span>
                    @elseif($employee->status == 10)
                        <span class="badge badge-warning">Driver Orientation</span>
                    @elseif($employee->status == 5)
                        <span class="badge badge-success">Active</span>
                    @elseif($employee->status == 6)
                        <span class="badge badge-info">FMLA</span>
                    @elseif($employee->status == 7)
                        <span class="badge badge-danger">COMP</span>
                    @elseif($employee->status == 8)
                        <span class="badge badge-danger">Terminated</span>
                    @endif


                    <hr>
           @permission('employee.view') <a href="employees/{{$employee->id}} " class="card-meta"><span><i class="fa fa-user"></i>View</span></a> @endpermission
           @permission('employee.edit') <a href="employees/{{$employee->id}}/edit"><span><i class="fa fa-edit"></i>Edit</span></a> @endpermission


                </div>
                <!--/.Card content-->

            </div>
            <!--/.Card-->
        </div>
