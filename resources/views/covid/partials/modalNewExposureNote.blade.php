<!-- The Modal -->
<div class="modal" id="modalExposureNote">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">NEW EXPOSURE NOTE</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="form-horizontal" data-parsley-validate="true" action="/covidExposureNote/{{$exposure->id}}" method="POST" name="demo-form">
                    @csrf
                @include('covid.partials.formNewExposureNote')
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save Information</button>
                </form>
            </div>

        </div>
    </div>
</div>