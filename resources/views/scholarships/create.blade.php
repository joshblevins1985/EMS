@extends('layouts.app')

@section('page-title', trans('Scholarship Agreement'))
@section('page-heading', trans('Scholarship Agreement'))

@section('breadcrumbs')

@stop

@section('content')

@include('partials.toastr')

@include('scholarships.partials.form')

@include('scholarships.partials.modal_signature')

@stop

@section('styles')
<link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/signature-pad.css') }}">
@stop

@section('scripts')
 <script src="{{ url('public/assets/js/signature-pad/signature_pad.umd.js') }}"></script>
 <script src="{{ url('public/assets/js/signature-pad/app.js') }}"></script>

<script>
    $('#modalSignature').on('show.bs.modal', function(e) {
        var student = $(e.relatedTarget).data('student');

        $("#student").val(student);
        
        console.log(student);
    });
</script>


<script>
    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
      backgroundColor: 'rgba(255, 255, 255, 0)',
      penColor: 'rgb(0, 0, 0)'
    });
    var saveButton = document.getElementById('save');
    var cancelButton = document.getElementById('clear');
    var student = document.getElementById('student').value;
    
    saveButton.addEventListener('click', function (event) {
        event.preventDefault();
      if (signaturePad.isEmpty()) {
                    sweetAlert("Oops...", "Please provide signature first.", "error");
                } else {

                    // do ajax to post it
                    $.ajax({
                        url : '{{route('scholarships.signature')}}',
                        type: 'POST',
                        data : {
                            signature: signaturePad.toDataURL(),
                            student: student,
                          
                            
                        },
                        success: function(response)
                        {
                            alert('The signature has been saved reload the page to view the signature.')
                           
                            console.log(response);
                        },
                        error: function(response)
                        {
                            
                            console.log(response);
                        }
                    });
                }
    });
    
    cancelButton.addEventListener('click', function (event) {
        event.preventDefault();
  signaturePad.clear();
});
</script>
@stop