<!--Accordion wrapper-->
<div class="accordion accordion-blocks" id="accordionEx78" role="tablist" aria-multiselectable="true">

    <!-- Accordion card -->
    <div class="card text-white bg-success">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingDemographics">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" href="{{$employees->id}}/edit">Edit</a>
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Demographics" href="#collapseDemographics" aria-expanded="true" aria-controls="collapseDemographics">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}} Demographics</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapseDemographics" class="collapse" role="tabpanel" aria-labelledby="headingDemographics" data-parent="#Demographics">
            <div class="card-body">

                @include('employee.partials.demographics')

            </div>
        </div>
    </div>
    <!-- Accordion card -->
    
    <!-- Accordion card -->
    <div class="card text-white bg-success">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingCertifications">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                                                        
                                           
                                                        

                                                        
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" href="employeesstate/create{{$employees->user_id}}">New State Certiffication</a>
                    <a class="dropdown-item" href="#">New ABC Certification</a>
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Cetifications" href="#collapseCertifications" aria-expanded="true" aria-controls="collapseCertifications">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}}  Certifications</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapseCertifications" class="collapse" role="tabpanel" aria-labelledby="headingCertifications" data-parent="#Certifications">
            <div class="card-body">

                @include('employee.partials.certifications')

            </div>
        </div>
    </div>
    <!-- Accordion card -->

        <div class="card ">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingSchedule">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" data-toggle="modal" data-target="#ScheduleModal">Edit</a>
                    
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Schedule" href="#collapseSchedule" aria-expanded="true" aria-controls="collapseSchedule">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}} Schedule</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapseSchedule" class="collapse" role="tabpanel" aria-labelledby="headingSchedule" data-parent="#Schedule">
            <div class="card-body">

                @include('employee.partials.schedule')

            </div>
        </div>
    </div>
    <!-- Accordion card -->
    @permission('view.payrates')
    <!-- Accordion card -->

        <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingPayrate">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" data-toggle="modal" data-target="#payrateModal">New Pay Rate</a>
                    
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Payrate" href="#collapsePayrate" aria-expanded="true" aria-controls="collapsePayrate">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}} Pay Rates</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapsePayrate" class="collapse" role="tabpanel" aria-labelledby="headingPayrate" data-parent="#Payrate">
            <div class="card-body">

                @include('employee.partials.payrate')

            </div>
        </div>
    </div>
    <!-- Accordion card -->
    @endpermission
    @permission('view.badrunsheets')
        <!-- Accordion card -->

        <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingPayrate">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" href="#">Edit</a>
                    
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Payrate" href="#collapseRunSheet" aria-expanded="true" aria-controls="collapseRunSheet">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}} Bad Run Sheets</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapseRunSheet" class="collapse" role="tabpanel" aria-labelledby="headingRunSheet" data-parent="#RunSheet">
            <div class="card-body">

                @include('employee.partials.runsheets')

            </div>
        </div>
    </div>
    <!-- Accordion card -->
    @endpermission
</div>
<!--/.Accordion wrapper-->
    @permission('encounter.view')
        <!-- Accordion card -->

        <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingEncounter">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" href="#">Edit</a>
                    
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Encounter" href="#collapseEncounter" aria-expanded="true" aria-controls="collapseEncounter">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}} Encounters</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapseEncounter" class="collapse" role="tabpanel" aria-labelledby="headingEncounter" data-parent="#Encounter">
            <div class="card-body">

                @include('employee.partials.encounters')

            </div>
        </div>
    </div>
    <!-- Accordion card -->
    @endpermission
    <!--/.Accordion wrapper-->
    @permission('encounter.view')
        <!-- Accordion card -->

        <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingCourse">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" href="#">Edit</a>
                    
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Course" href="#collapseCourse" aria-expanded="true" aria-controls="collapseCourse">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}} Completed Course List</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapseCourse" class="collapse" role="tabpanel" aria-labelledby="headingCourse" data-parent="#Course">
            <div class="card-body">

                @include('employee.partials.courses')

            </div>
        </div>
    </div>
    <!-- Accordion card -->
    @endpermission

 <!--/.Accordion wrapper-->
    @permission('view.narcoticbox')
        <!-- Accordion card -->

        <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingNarcotic">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" href="#">Edit</a>
                    
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Narcotic" href="#collapseNarcotic" aria-expanded="true" aria-controls="collapseNarcotic">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}} Completed Narcotic List</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapseNarcotic" class="collapse" role="tabpanel" aria-labelledby="headingNarcotic" data-parent="#Narcotic">
            <div class="card-body">

                @include('employee.partials.narcotics')

            </div>
        </div>
    </div>
    <!-- Accordion card -->
    @endpermission
<!--/.Accordion wrapper-->

 <!--/.Accordion wrapper-->
    @permission('view.qa')
        <!-- Accordion card -->

        <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingQa">

            <!--Options-->
            <div class="dropdown pull-left">
                <button class="btn btn-info btn-sm m-0 mr-3 p-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-pencil"></i>
                                                        </button>
                <div class="dropdown-menu dropdown-info">
                    <a class="dropdown-item" href="#">Edit</a>
                    
                </div>
            </div>

            <!-- Heading -->
            <a data-toggle="collapse" data-parent="#Qa" href="#collapseQa" aria-expanded="true" aria-controls="collapseQa">
                <h5 class="mt-1 mb-0">
                    <span>{{$employees->first_name}} {{$employees->last_name}} Quality Assuracne Reviews</span>
                    <i class="fa fa-angle-down rotate-icon"></i>
                </h5>
            </a>

        </div>

        <!-- Card body -->
        <div id="collapseQa" class="collapse" role="tabpanel" aria-labelledby="headingQa" data-parent="#Qa">
            <div class="card-body">

                @include('employee.partials.qa')

            </div>
        </div>
    </div>
    <!-- Accordion card -->
    @endpermission
<!--/.Accordion wrapper-->

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>