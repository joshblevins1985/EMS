@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('/assets/css/signature-pad.css') }}">


        <style>
    #signature {
        border: double 3px transparent;
        border-radius: 5px;
        background-image: linear-gradient(white, white),
        radial-gradient(circle at top left, #4bc5e8, #9f6274);
        background-origin: border-box;
        background-clip: content-box, border-box;
    }
</style>


@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Employee Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Financial Assistance Request</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Employee Education Financial Assistance Request</h1>
    <!-- end page-header -->


    <div class="row">

            <p>Portsmouth Management Firm has contracted with {{$record->employee->company->name}} to manage it's employees and maintain all contracts between employees and agency. </p>

    <p>This Agreement is made as of {{ Carbon\Carbon::parse($record->created_at)->format('F d Y') }}, between Portsmouth Management Firm <em>(PMF)</em>. and employee {{$record->employee->first_name}} {{$record->employee->last_name}} (employee) whom is currently employed as a {{$record->employee->employeepositions->label}} with {{$record->employee->company->name}}. For and in consideration of the provisions set forth below and the mutual covenants and promises herein contained, the receipt and adequacy of which are here-by acknowledged, the parties hereto, intending to be legally bound hereby, agree as follows.</p>

    <ol type="1">
        <li> {{$record->employee->company->name}} agrees to pay, on behalf of the employee, ${{$record->pmt_plan}} related to training of {{$record->courses}} courses at {{$record->school}}. </li>

        <li> In consideration for any expenses paid by {{$record->employee->company->name}}, the Employee agrees to use any training for which PEASI has paid for the benefit of {{$record->employee->company->name}} only for 1 year. If the Employee, while employed by {{$record->employee->company->name}}, provides services in direct or indirect competition with {{$record->employee->company->name}} within a 25-mile radius of any {{$record->employee->company->name}} station, whether by employment by a competitor, self-employment, or otherwise, he/she will pay the remaining balance as outlined in section 3 below. The Employee understands that this applies to any services in the car, ambulette, ambulance, emergency 911, mechanic, or billing services. Services approved in writing by administration of Portmouth Management Firm shall be excluded. </li>

        <li>
        <div class="row">
            <div class="col-xl-12">
            <h4> Payment Plan </h4>
            <p>The Employees shall start repayment on <?php
            $contract_date = Carbon\Carbon::parse($record->created_at)->format('Y-m-d');
            $payment_start = Vanguard\PayPeriod::where('start', '>=', $contract_date)->where('end', '<=', $contract_date)->first();
            ?>
           @if($payment_start)  {{ Carbon\Carbon::parse($payment_start->pay_date)->format('d-m-Y i') }} @else To Be Determined @endif
            </div>
            <p> See Appendix A form payment table. </p>

        </div>
        </li>

        <li> Employee must remain in good standing throughout the term of this contract, the employee will make 26 payments of {{round($perPart, 2)}}.</li>

        <li>Any employee not considered to in good standing either by self-terminating employment or
            termination by other means would not be considered an employee in good standing. At which time the employee will have deducted all remaining funds from their last paycheck.
            Any balance left will be billed to ex-employee to be paid in full.</li>

        <li> All questions concerning the validity or meaning of this Agreement or relating to the rights and obligations of the Parties with respect to performance under this Agreement
            shall be construed and resolved under the laws of the State of Ohio. </li>

        <li> The parties to this Agreement hereby designate the courts of Scioto County, Ohio, as the courts of proper jurisdiction and venue for any actions or proceedings relating to this
            Agreement, consent to such designation, jurisdiction and venue, and waive any objections or defenses relating to jurisdiction or venue with respect to any action or proceedings
            initiated therein. </li>

        <li> The intention of the Parties to this Agreement is to comply with all laws and public policies, and this Agreement shall be construed consistently with all such laws and public
            policies to the extent possible. In the event that any of the provisions of this Agreement shall be held by a court of competent jurisdiction to be invalid or unenforceable,
            the remaining provisions shall nevertheless continue to be valid and enforceable as though the invalid or unenforceable portions had not been included herein. In the event that
            any provisions of this Agreement relating to duration, territory, and/or scope of restriction, and/or related aspects, shall be held by a court of competent jurisdiction to
            exceed a maximum restrictiveness such court deems reasonable and enforceable, then the duration, territory, and/or scope of restriction, and/or related aspects deemed reasonable
            and enforceable by the court shall be construed to be the terms hereunder and be enforced. </li>

        <li> 8.	No failure by any party to insist upon strict compliance with any term of this Agreement, exercise any option, enforce any right, or seek any remedy upon any default or any
            other party shall affect, or constitute a waiver of, the party’s right to insist upon such strict compliance, exercise that option, enforce that right, or seek that remedy with
            respect to that default or any prior, contemporaneous, or subsequent default. No custom or practice of the parties at variance with any provision of this Agreement shall affect
            or constitute a waiver of any party’s right to demand strict compliance with all provisions of this Agreement. </li>

        <li> 9.	This document contains the entire agreement among the parties and supersedes any prior discussions, understandings, or agreements among them respecting the subject matter of this
            Agreement. No alterations, additions, or other changes to this Agreement shall be made or be binding unless made in writing and signed by all parties to this Agreement. </li>

    </ol>
    </div>


    <div class="row">
            <div class="row mt-4 mb-5 bg-white">
                    <div class="col-xl-12" > By signing and submiting my signature below I attest that I am agreeing to all the contents within this contract. </div>
                    <div class="col-xl-5" id="signature">
                        <!--Panel-->
                    <form  method="post" enctype="multipart/form-data" class="ansform"> <!--Panel-->

                        @method('PUT')
                    @csrf
                    <div class="wrapper">

                      <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                    </div>
                    <div>
                        <input type="hidden" id="assid" name="assid" value="{{$record->id}}">
                      <button id="save" class="btn btn-success">Save</button>
                      <button id="clear">Clear</button>
                    </div>
                    <!--/.Panel-->
                    {!! Form::close() !!}
                    </div>

                </div>
    </div>

    <div class="row">
            <div class="col-xl-12">
            <h2> Appendix A: Payment Schedule </h2>
            </div>
                <div class="col-xl-12 mt-2">
                        <table class="table table-sm">
                            <tr>
                                <th>Payment Number</th>
                                <th>Payment Amount</th>
                                <th>Balance Owed</th>
                            </tr>
                            @foreach($results as $key => $value)
                            <tr>
                            <th>{{$key}}</th>
                            <td>{{round($perPart, 2)}}</td>
                            <td>{{round($value, 2)}}</td>
                            </tr>
                            @endforeach
                    </div>
        </div>


@endsection



@push('scripts')
    <script src="/assets/plugins/d3/d3.min.js"></script>

    <script src="/assets/plugins/moment/moment.js"></script>
    <script src="/assets/plugins/parsleyjs/dist/parsley.js"></script>
    <script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="/assets/js/demo/form-wizards-validation.demo.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="{{ url('/assets/js/signature-pad/signature_pad.umd.js') }}"></script>
 <script src="{{ url('/assets/js/signature-pad/app.js') }}"></script>

 <script>

        $(function () {

                   var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                      backgroundColor: 'rgba(255, 255, 255, 0)',
                      penColor: 'rgb(0, 0, 0)'
                    });
                    var saveButton = document.getElementById('save');
                    var cancelButton = document.getElementById('clear');
                    var assid = document.getElementById('assid').value;

                    cancelButton.addEventListener('click', function (event){
                        event.preventDefault();
                    });

                    saveButton.addEventListener('click', function (event) {

                         event.preventDefault();

                        if (signaturePad.isEmpty()) {
                            sweetAlert("Oops...", "Please provide signature first.", "error");
                        } else {

                            // do ajax to post it
                            $.ajax({
                                url : '/fa/signatue/'+ assid,
                                type: 'POST',
                                data : {
                                    signature: signaturePad.toDataURL(),
                                    assid: assid,
                                    "_token": "{{ csrf_token() }}",

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
                        signaturePad.clear();
                    });

                });
         </script>

@endpush
