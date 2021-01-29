<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalStateCert" tabindex="-1" role="dialog" aria-labelledby="exampleStateCert"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee State Certifications</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                <button type="button" data-toggle="modal" data-target="#modalStateCertForm" data-employee="{{$employees->user_id}}" class="btn primary-color btn-lg btn-block">Add New State Certification</button>
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
                                        <th>State</th>
                                        <th>Type</th>
                                        <th>Certification #</th>
                                        <th>Expirations</th>
                                        <th>Days left </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$employees->statecertifications)
                                    <tr>
                                        <td colspan="5"> No Scheduled Dates </td>
                                    </tr>
                                    @else
                                    @foreach($employees->statecertifications as $row)
                                    <tr>
                                    <td>@if($row->state == 1) Ohio @elseif($row->state == 2) Kentucky  @elseif($row->state == 3) West Virginia @endif</td>
                                    <td>{{$row->certtype->label or 'Unknown'}}</td>
                                    <td>{{$row->certification_number}}</td>
                                    <td>{{ Carbon\Carbon::parse($row->expiration)->format('m-d-Y') }}</td>
                                    <td>{{ Carbon\Carbon::parse($row->expiration)->diffForHumans() }}</td>
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