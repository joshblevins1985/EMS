<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalNewCertificate" tabindex="-1" role="dialog" aria-labelledby="modalNewCertificateLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <h2 class="heading">Add New Certificate</h2>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <form action="/certificates" method="POST" data-parsley-validate="true" id="new-certification" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $employees->user_id }}" />
                            <div class="form-group">
                                <label for="certificate_number" >Certificate Number</label>
                                <input type="text" class="form-control" id="certificate_number" name="certificate_number" />
                            </div>

                            <div class="form-group">
                                <label for="state" >Issuing State</label>
                                <select class="select2 form-control" name="state" id="state" style="width: 100%">
                                    <option disabled selected> Select Issuing State</option>
                                    @foreach($states as $row)
                                        <option value="{{$row->id}}"> {{$row->label}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="issue_date">Issue Date</label>
                                <input class="form-control datepicker" id="issue_date" name="issue_date" placeholder="MM/DD/YYY" type="text"/>
                            </div>
                            <div class="form-group">
                                <label for="expiration_date">Issue Date</label>
                                <input class="form-control datepicker" id="expiration_date" name="expiration_date" placeholder="MM/DD/YYY" type="text"/>
                            </div>
                            <div class="form-group">
                                <label for="type" >Certificate Type</label>
                                <select class="select2 form-control" name="type" id="type" style="width: 100%">
                                    <option disabled selected> Select Certificate Type</option>
                                    @foreach($certificate_type as $row)
                                        <option value="{{$row->id}}"> {{$row->type}}  - {{$row->states->label ?? ''}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type" >Status</label>
                                <select class="select2 form-control" name="status" id="type" style="width: 100%">
                                    <option disabled selected> Select Status</option>
                                    @foreach($certificate_status as $row)
                                        <option value="{{$row->id}}"> {{$row->description}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="file">Attachment Upload</label>
                                <input type="file" id="file" class="form-control mt-3" onchange="previewFile()" name="pdf[]" multiple />

                            </div>

                            <button class="btn btn-primary btn-block" type="submit">Submit Form</button>

                        </form>
                    </div>
                    <div class="col-xl-6">
                        @include('employee.partials.cropper')
                    </div>
                </div>
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

