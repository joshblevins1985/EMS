<div class="row-mb-2">
    <input type="text" id="employee" class="form-control"  placeholder="Scan You Badge Here" />
</div>

<div class="row mb-2">
    <div class="col-xl-12 mb-2 text-center">
        <h2 class="text-success">You are requesting to sign out {{ $box->box_number }}. </h2> 
        
        <strong>Status:</strong> @if($box->status == 1) <span class="text-success">Available</span> @elseif($box->status == 2) <span class="text-success">Signed Out</span> @endif <p></p>
         @if($box->status == 2) <strong class="text-danger">Assigned To:</strong> @endif <p></p>
    </div>
    <div class="col-xl-12">
        @if($box->status == 1) 
        <h3>Review the information below, if the information below is correct you must click the green check box on each line of the link at the bottom to confirm all the information is accurate.</h3>
        @elseif($box->status == 2) 
        <h3>Review the information below, if the box is assigned to another employee other than your self, click the <span class="text-danger"><i class="fas fa-user-times"></i></span> next to the employees name to sign it back into the system.</h3>
        @endif
    </div>
    
</div>

<div class="row">
    <div class="col-xl-12">
        <table class="table table-striped">
        <thead>
            @if($box->status == 2) 
            <tr>
                <td>Assigned To</td>
                <td> 
                @foreach($elogs as $elog)
                @if($box->id == $elog->box)
                    {{$elog->employees->first_name or 'Unknown'}} {{$elog->employees->last_name or ''}}
                @endif
                @endforeach
                </td>
                <td><span class="text-danger"><i class="fas fa-user-times fa-2x"></i></span></td>
            </tr>
             @endif 
             <tr>
                <td>Seal Number</td>
                <td> {{ $box->seal ?? 'Unknown' }} </td>
                <td>
                    <div class="row">
                        <div class="col">
                            <span class="text-success"> <i class="fas fa-check fa-2x"> </i> </span>
                        </div>
                        <div class="col">
                            <span class="text-danger"> <i class="far fa-edit fa-2x"></i> </span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Tamper Seal Number</td>
                <td> {{ $box->tamper_seal }} </td>
                <td>
                    <div class="row">
                        <div class="col">
                            <span class="text-success"> <i class="fas fa-check fa-2x"> </i> </span>
                        </div>
                        <div class="col">
                            <span class="text-danger"> <i class="far fa-edit fa-2x"></i> </span>
                        </div>
                    </div>
                </td>
            </tr>
        </thead>
    </table>
    </div>
    
</div>