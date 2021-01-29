<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalSignature" tabindex="-1" role="dialog" aria-labelledby="exampleSignature"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Students Signature</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                
                <!--Panel-->
                <form  method="post" enctype="multipart/form-data" class="ansform"> <!--Panel-->
               

                {{ csrf_field() }}
                <div class="wrapper">
                  
                  <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                </div>
                <div>
                    <input type="hidden" id="student" name="student" value="">
                  <button id="save">Save</button>
                  <button id="clear">Clear</button>
                </div>
                <!--/.Panel-->
                {!! Form::close() !!}
                

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