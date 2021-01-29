        <!--Card-->
            <div class="card">

                <!--Card content-->
                <div class="card-body elegant-color white-text">
                    <!--Title-->
                    <h4 class="card-title">Employee Demographic Information</h4>
                    <!--Text-->
                    <h1>Welcome {{ auth()->user()->present()->name }}</h1>
                    <h1>Position: {{ $employee->employeepositions->label }}</h1>
                    <h1>
                        Phone: {{ '('.substr($employee->phone_mobile, 0, 3).') '.substr($employee->phone_mobile, 3, 3).'-'.substr($employee->phone_mobile,6)  }}</h1>
                    <small>Confirm this information daily. This information is what the company has on file and utilizes to contact you. </small>
                </div>

            </div>
            <!--/.Card-->