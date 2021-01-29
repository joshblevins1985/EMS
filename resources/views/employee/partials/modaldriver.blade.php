<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalDriver" tabindex="-1" role="dialog" aria-labelledby="exampleDriver"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee Driving Evaluations</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                
                <!--Panel-->
                <div class="card ">
                    <div class=" card-header primary-color-dark white-text">
                        Driving Evaluations
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            
                            <table class="table">
                                <tr>
                                    <th>Date</th>
                                    <th>Score</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                
                                @if($employees->driver_eval)
                                
                                @foreach($employees->driver_eval as $d)
                                <tr>
                                    <td>{{Carbon\Carbon::parse($d->date_of_evaluation)->format('m-d-Y')}}</td>
                                    <td>{{round($d->performance_rating)}} %</td>
                                    <td><a href="/driveassessment/{{$d->id}}">View Report</a></td>
                                    <td><a href="/da/pdf/{{$d->id}}">Export to PDF</a></td>
                                </tr>
                                @endforeach
                                
                                @else
                                <tr>
                                    <td colspan="3">No Evaluations on File</td>
                                </tr>
                                @endif
                                
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