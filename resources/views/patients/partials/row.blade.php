
<div class="col-lg-4 col-md-12">
    <!--Card-->
    <div class="card card-cascade narrower mb-4" style="margin-top: 28px">

        @permission('view.photo')

        <!--Card image-->
        <div class="view view-cascade top rounded-circle">
            <a href="/employee/id/{{$row->id}}"> <img src="/storage/app/employee_photos/{{$row->eid}}.png" class="card-img-top rounded-circle"
                                                           onerror="this.src='/storage/app/employee_photos/nouser.png'"  alt="" style="height:300px;"> </a>
            <a href="/employee/id/{{$row->id}}">
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        @endpermission
        <!--/.Card image-->

        <!--Card content-->
        <div class="card-body card-body-cascade">
            <h5 class="pink-text"><i class="fa fa-user"></i> {{decrypt($row->last_name)}}, {{decrypt($row->first_name)}} - P-{{sprintf('%08d', $row->ptid )}}</h5>
            <!--Title-->
            <h4 class="card-title">Primary Response Station: @if(!$row->station) Unknown Station  @else{{$row->station->station}}@endif</h4>
            <!--Text-->
            <p class="card-text">
            <address>

                {{$row->street_number or ''}} {{decrypt($row->route)}}<br>
                {{decrypt($row->locality)}}, {{decrypt($row->state)}} {{decrypt($row->postal_code)}}<br>
               <?php $phone = decrypt($row->phone_mobile); ?> <abbr title="Phone">P:{{ '('.substr($phone, 0, 3).') '.substr($phone, 3, 3).'-'.substr($phone,6)  }}</abbr>
            </address>
            </p>
            <small>{{ decrypt($row->email) }}</small>
            <p class="card-text"></p>

            @if ($row->status == 1)
                <span class="badge badge-success">Active </span>
            @elseif($row->status == 2)
                <span class="badge badge-danger">Deactive</span>
            @elseif($row->status == 3)
                <span class="badge badge-dark">Deceased</span>
            @endif


            <hr>
            <a href="patients/{{$row->id}} " class="card-meta"><span><i class="fa fa-user"></i>View</span></a>
            <a href="patients/{{$row->id}}/edit"><span><i class="fa fa-edit"></i>Edit</span></a>


        </div>
        <!--/.Card content-->

    </div>
    <!--/.Card-->
</div>

