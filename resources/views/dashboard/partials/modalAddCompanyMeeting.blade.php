<!-- Modal -->
<div class="modal fade" id="newMeetingModal" tabindex="-1" role="dialog" aria-labelledby="newMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMeetingModalLabel">Add New Meeting Recording</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="POST" action="/companyMeeting" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-b-15">
                        <label class="col-md-4 col-sm-4 col-form-label" for="date">Date * :</label>
                        <div class="col-md-8 col-sm-8">
                        <input type="text" id="date" name="date" class="form-control datepicker" value="{{Carbon\Carbon::now()->format('m-d-Y')}}" data-parsley-required="true">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label class="col-md-4 col-sm-4 col-form-label" for="fullname">Title * :</label>
                        <div class="col-md-8 col-sm-8">
                            <input class="form-control" type="text" id="fullname" name="title" placeholder="Required" data-parsley-required="true" />
                        </div>
                    </div>

                    <div class="form-group row m-b-15">
                        <label class="col-md-4 col-sm-4 col-form-label" for="file">File * :</label>
                        <div class="col-md-8 col-sm-8">
                            <input type="file" id="file" class="form-control mt-3" name="pdf[]" multiple  data-parsley-required="true"/>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
