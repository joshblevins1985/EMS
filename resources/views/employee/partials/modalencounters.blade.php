<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalEncounters" tabindex="-1" role="dialog" aria-labelledby="exampleEncounters"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee Encounters</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                <button type="button" href="compliance/create" class="btn primary-color btn-lg btn-block">Add New Encounter</button>
                <!--Panel-->
                <div class="card ">
                    <div class=" card-header primary-color-dark white-text">
                        State Certifications
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Encounter Type</th>
                                        <th>Status</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$employees->EmployeeEncounters)
                                    <tr>
                                        <td colspan="5"> No Encounters on File </td>
                                    </tr>
                                    @else
                                    @foreach($employees->EmployeeEncounters as $row)
                                    
                                    <tr>
                                    <td>{{ Carbon\Carbon::parse($row->doi)->format('m-d-Y') }}</td>
                                    <td>
                                        @if($row->encounter_type == 1)
                                            File Notation
                                        @elseif($row->encounter_type == 2)
                                            Corrective Counciling
                                        @elseif($row->encounter_type == 3)
                                            Verbal Warning
                                        @elseif($row->encounter_type == 4)
                                            Written Warning
                                        @elseif($row->encounter_type == 5)
                                            Suspension
                                        @elseif($row->encounter_type == 6)
                                            Termination
                                        @elseif($row->encounter_type == 7)
                                            Resignation
                                        @elseif($row->encounter_type == 8)
                                            Deemed Non-Driver
                                        @elseif($row->encounter_type == 9)
                                            Last Chance Agreement
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->status == 1)
                                            Investigation
                                        @elseif($row->status == 2)
                                            Employee Contact
                                        @elseif($row->status == 3)
                                            Admin / Training
                                        @elseif($row->status == 4)
                                            Closed
                                        @endif
                                    </td>
                                    <td><a href="/compliance/{{$row->id}}"><i class="far fa-binoculars"></i></a></td>
                                    </tr>
                                   
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <div class="card-footer text-muted primary-color-dark white-text">
                        <p class="mb-0"></p>
                    </div>
                </div>
                <!--/.Panel-->

            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">

                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->