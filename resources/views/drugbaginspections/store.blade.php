@extends('layouts.clean')

@section('page-title', __('Drug Bag Inspection'))
@section('page-heading', __('Drug Bag Inspection'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Drug Bag Inspection')
    </li>
@stop

@section('content')
    @include('partials.messages')
    <div class="row">
        <div class="col-xl-12">
            @include('drugbaginspections.forms.inspectionForm')
        </div>
    </div>

@stop

@section('right-tab')

@stop

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Vanguard\Http\Requests\StoreDrugBagInspectionPostRequest', '#inspectionForm'); !!}
<script>


    $("#drugBagId").change(function () {
        id = $('#drugBagId').val();
        var url = '/drugbaginspection/'+ id;
        console.log(url);

        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });



    $( "#inspectionFormButton" ).click(function( event ) {
        event.preventDefault();
        var dates = document.querySelectorAll("input[type=date]");
        var expirationDates = [];

        for(var i = 0; i < dates.length; i++) {
            var date = new Date(dates[i].value);
            expirationDates.push(date);
        }

        var date = new Date(), y = date.getFullYear(), m = date.getMonth();
        var lastDay = new Date(y, m + 1, 0);
        var expiredCount = 0;

        for (i = 0; i < expirationDates.length; i++) {
            if (expirationDates[i] < lastDay){
                expiredCount++;
            }
        }

        if(expiredCount > 0){
            Swal.fire({
                title: 'Are you sure?',
                text: "You have medications that are going to expire. Are you sure you want to submit this form?",
                icon: 'danger',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit form!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $( "#inspectionForm" ).submit();
                    Swal.fire(
                        'Submitted!',
                        'Your inspection has been completed.',
                        'success'
                    )
                }
            })

        }else{
            $( "#inspectionForm" ).submit();
        }

    });

</script>
@endpush
