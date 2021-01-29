
    <!-- Card -->
    <a data-toggle="modal" data-target="#orientationModal">
        <div class="card text-white bg-info mb-6 ">

        <!-- Card content -->
        <div class="card-body">

            <!-- Title -->
            <h4 class="card-title">Orientation Employees</h4>
            <!-- Text -->
            <h2><span class="fas fa-ambulance fa-3x" aria-hidden="true"></span> {{$orientation->count()}}</h2>

        </div>
        <!-- Card content -->

    </div>
    </a>
    <!-- Card -->

    <!-- Card -->
    <a data-toggle="modal" data-target="#ftoEMSModal">
        <div class="card text-white bg-info mb-6 ">

        <!-- Card content -->
        <div class="card-body">

            <!-- Title -->
            <h4 class="card-title">FTO EMS Employees</h4>
            <!-- Text -->
            <h2><span class="fas fa-ambulance fa-3x" aria-hidden="true"></span> {{$ftoems->count()}}</h2>

        </div>
        <!-- Card content -->

    </div>
    </a>
    <!-- Card -->

    <!-- Card -->
    <div class="card text-white bg-info mb-6 ">

        <!-- Card content -->
        <div class="card-body">

            <!-- Title -->
            <h4 class="card-title">FTO W/C Employees</h4>
            <!-- Text -->
            <h2><span class="fab fa-accessible-icon fa-3x" aria-hidden="true"></span> {{$ftowc->count()}} </h2>

        </div>
        <!-- Card content -->

    </div>
    <!-- Card -->

    <!-- Card -->
     <a data-toggle="modal" data-target="#driverOModal">
    <div class="card text-white bg-info mb-6 ">

        <!-- Card content -->
        <div class="card-body">

            <!-- Title -->
            <h4 class="card-title">Driver Orientation Employees</h4>
            <!-- Text -->
            <h2><span class="fas fa-car fa-3x" aria-hidden="true"></span> {{count($driving)}}</h2>

        </div>
        <!-- Card content -->

    </div>
    </a>
    <!-- Card -->

