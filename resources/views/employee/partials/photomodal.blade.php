<!-- Modal -->
<div class="modal fade" id="basicExample1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Upload Attachments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/employeephoto" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">

                        <label for="Product Name">Employee Photo</label>

                        <input type="text" name="name" class="form-control"  placeholder="Attachment Title" >

                    </div>

                    <label for="Attachment Title">Photo:</label>

                    <input type="hidden" name="pid" value="{{$employees->id}}">

                    <br />

                    <input type="file" class="form-control" name="photo[]" multiple />

                    <br /><br />

                    <input type="submit" class="btn btn-primary" value="Upload" />

                </form>
            </div>

        </div>
    </div>
</div>