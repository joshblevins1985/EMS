<!--Panel-->
<div class="card">
    <h3 class="card-header bg-primary white-text text-uppercase font-weight-bold text-center py-5">Reports</h3>
    <div class="card-body">
        <div class="list-wrapper">
            <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                <a href="/employee/profile/{{$employees->user_id}}">
                <li>
                        Employee Profile
                </li>
                </a>
                <a href="/ceu/history/{{$employees->user_id}}">
                    <li>
                        Course Report
                    </li>
                </a>

                    <li data-toggle="modal" data-target="#modalNewCertificate">
                        Add New Certificate
                    </li>

                <li>
                    Certification Report
                </li>
                <li>
                    Attendance Report
                </li>
                <li>
                    Encounter Report
                </li>
                <li>
                    Driver Risk Assessment
                </li>
                @permission('view.timepunch')

                <li>
                    <a data-toggle="modal" data-target="#payrollModal">
                        Current Pay Period
                    </a>
                </li>

                @endpermission


            </ul>
        </div>
    </div>
</div>
<!--/.Panel-->