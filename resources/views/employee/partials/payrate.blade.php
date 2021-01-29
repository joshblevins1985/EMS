<div class="col-lg-5 mb-4 align-items-stretch">
    <!--Panel-->
    <div class="card text-center">
        <div class=" card-header elegant-color white-text">
            Pay Rates
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="list-group">
                    @foreach($employees->PayRate as $pay)
                        <a href="#"
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-2 h5">
                                    @if($pay->pay_type == 1)
                                        Regular Rate
                                    @elseif($pay->pay_type == 2)
                                        Overtime Rate
                                    @elseif($pay->pay_type == 3)
                                        VAMC Rate
                                    @else
                                        Unknown Rate
                                    @endif
                                    - {{$pay->rate}}
                                </h5>
                                <small>
                                    @if($pay->status == 1)
                                        <td class="bg-success">Active</td>
                                    @elseif($pay->status == 2)
                                        <td class="bg-danger">Not Active</td>
                                    @else

                                    @endif
                                </small>
                            </div>
                            

                        </a>
                    @endforeach
                </div>

            </div>

        </div>
        <div class="card-footer text-muted elegant-color white-text">
            
        </div>
    </div>
    <!--/.Panel-->
</div>