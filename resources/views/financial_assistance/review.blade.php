@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />

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
    <div class="col-xl-2">
        <a href="/fa/review/pdf/{{$record->id}}"><button class="btn btn-primary">Show PDF</button></a>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-sm-12">
                <div class="row">
            <h1 class="text-center">Educational Assistance Application and Agreement</h1>

            <table class="table">
                <tr>
                    <td>Name:</td>
                    <td style="border-bottom: 1pt solid black;">{{$record->employee->first_name}} {{$record->employee->last_name}}</td>
                    <td>Date:</td>
                    <td style="border-bottom: 1pt solid black;">{{ Carbon\Carbon::parse($record->created_at)->format('m-d-Y') }}</td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td style="border-bottom: 1pt solid black;">{{$record->employee->street_number}} {{$record->employee->route}}</td>
                    <td>Phone:</td>
                    <td style="border-bottom: 1pt solid black;">{{$record->employee->phone_mobile}}</td>
                </tr>
                <tr>
                    <td>City / State/ Zip</td>
                    <td style="border-bottom: 1pt solid black;">{{$record->employee->locality}} {{$record->employee->state}} {{$record->employee->postal_code}}</td>
                </tr>
                <tr>
                    <td>SSN</td>
                    <td style="border-bottom: 1pt solid black;"><?php $s= \Crypt::decrypt($record->employee->ssn); $s=  substr($s, -4); ?> ***-**-{{$s}}</td>
                </tr>
            </table>
        </div>

        <div class="row">
            <h2>Course Information</h2>

            <table class="table">
                <tr>
                    <td >School Name</td>
                    <td colspan="3" style="border-bottom: 1pt solid black;">{{$record->school}}</td>
                </tr>
                <tr>
                    <td>School Address</td>
                    <td colspan="3" style="border-bottom: 1pt solid black;">{{$record->school_contact}}</td>
                </tr>
                <tr>
                    <td>Courses</td>
                    <td colspan="3" style="border-bottom: 1pt solid black;">{{$record->courses}}</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td style="border-bottom: 1pt solid black;">{{ Carbon\Carbon::parse($record->start_date)->format('m-d-Y') }}</td>
                    <td>End Date</td>
                    <td style="border-bottom: 1pt solid black;"> {{ Carbon\Carbon::parse($record->end_date)->format('m-d-Y') }} </td>
                </tr>
                <tr>
                    <td colspan="4">How will this course help improve your position with the company: {{$record->imporove or 'No input provided.'}} </td>

                </tr>
            </table>
        </div>
        <div style="page-break-after: always; page-break-inside: avoid;">

        </div>
        <div class="row"><h1 class="text-center">Employee Performance Data</h1></div>
        <div class="row">


            <div class="row"><h3 class="text-center">Compliance Encounters</h3></div>
            <table class="table table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Incident Reported</th>
                    </tr>
                </thead>
                <tbody>
                    @if($record->employee->EmployeeEncounters)
                    @foreach($record->employee->EmployeeEncounters->where("created_at",">", Carbon\Carbon::now()->subMonths(12)) as $row)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($row->doi)->format('m-d-Y') }}</td>
                            <td>{!! $row->incident_report !!}</td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="2">No Incidents Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>

        <div class="row">

            <h3 class="text-center">Attendance Tracking</h>
            <table class="table table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Occurance Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if($record->employee->attendance)
                    @foreach($record->employee->attendance->where("date",">", Carbon\Carbon::now()->subMonths(12)) as $row)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($row->date)->format('m-d-Y') }}</td>
                            <td>{{$row->type->label or 'Unknown'}}</td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="2">No Incidents Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>

        <div style="page-break-after: always; page-break-inside: avoid;">

        </div>


        <div class="row">
            <h1 class="text-center">OTHER DEDUCTION FORM</h1>
            <div class="row mt-5">
                <p>I, {{$record->employee->first_name}} {{$record->employee->last_name}}, authorize a payroll deduction of $ {{round($perPart, 2)}} on my wages/salary.</p>

                <p>I agree to repay this amount for the next 26 pay periods or until the full balance of $ {{$record->pmt_plan}} is paid in full.</p>

                <p>I also agree that if my employment is terminated prior to total repayment of this amount and any other amounts to which I have authorized a deduction, I authorize the company to deduct any and all unpaid amounts from any wages/salary owed me at the time of termination of memployment,</p>

            </div>

        </div>

        <div class="row mt-5">
            <table class="table">
                <tr>
                    <td><img src="<?php $file= $record->id.'_employee_financial_assistance.png'; echo asset("storage/app/signatures/$file")?>"></img></td>
                    <td style="vertical-align:bottom;text-align:center;">{{ Carbon\Carbon::parse($record->created_at)->format('m-d-Y H:i:s') }}</td>
                </tr>
                <tr>
                    <td>Employee Signature</td>
                    <td>Date Signed</td>
                </tr>
            </table>
        </div>
        <div style="page-break-after: always; page-break-inside: avoid;">

        </div>

        <div class="row">
                <h1 class="text-center">Educational Loan Agreement</h1>

                <p>Portsmouth Management Firm has contracted with {{$record->employee->company->name}} to manage it's employees and maintain all contracts between employees and agency. </p>

        <p>This Agreement is made as of {{ Carbon\Carbon::parse($record->created_at)->format('F d Y') }}, between Portsmouth Management Firm <em>(PMF)</em>. and employee {{$record->employee->first_name}} {{$record->employee->last_name}} (employee) whom is currently employed as a {{$record->employee->employeepositions->label}} with {{$record->employee->company->name}}. For and in consideration of the provisions set forth below and the mutual covenants and promises herein contained, the receipt and adequacy of which are here-by acknowledged, the parties hereto, intending to be legally bound hereby, agree as follows.</p>

        <ol type="1">
            <li> {{$record->employee->company->name}} agrees to pay, on behalf of the employee, ${{$record->pmt_plan}} related to training of {{$record->courses}} courses at {{$record->school}}. </li>

            <li> In consideration for any expenses paid by {{$record->employee->company->name}}, the Employee agrees to use any training for which {{$record->employee->company->name}} has paid for the benefit of {{$record->employee->company->name}} only, for 1 year. If the Employee, while employed by {{$record->employee->company->name}}, provides services in direct or indirect competition with {{$record->employee->company->name}} within a 25-mile radius of any {{$record->employee->company->name}} station, whether by employment by a competitor, self-employment, or otherwise, he/she will pay the remaining balance as outlined in section 3 below. The Employee understands that this applies to any services in the car, ambulette, ambulance, emergency 911, mechanic, or billing services. Services approved in writing by administration of Portmouth Management Firm shall be excluded. </li>

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
                <p> See Appendix A for payment table. </p>

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

            <li> No failure by any party to insist upon strict compliance with any term of this Agreement, exercise any option, enforce any right, or seek any remedy upon any default or any
                other party shall affect, or constitute a waiver of, the party’s right to insist upon such strict compliance, exercise that option, enforce that right, or seek that remedy with
                respect to that default or any prior, contemporaneous, or subsequent default. No custom or practice of the parties at variance with any provision of this Agreement shall affect
                or constitute a waiver of any party’s right to demand strict compliance with all provisions of this Agreement. </li>

            <li> This document contains the entire agreement among the parties and supersedes any prior discussions, understandings, or agreements among them respecting the subject matter of this
                Agreement. No alterations, additions, or other changes to this Agreement shall be made or be binding unless made in writing and signed by all parties to this Agreement. </li>

        </ol>
        </div>

        <div style="page-break-after: always; page-break-inside: avoid;">

        </div>
        <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <table class="table">
                            <tr class="text-center">
                                <td class="text-center" style="vertical-align:bottom;text-align:center;">{{$record->employee->first_name}} {{$record->employee->last_name}}</td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"><img src="<?php $file= $record->id.'_employee_financial_assistance.png'; echo asset("storage/signatures/$file")?>"></img></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;">{{ Carbon\Carbon::parse($record->created_at)->format('m-d-Y H:i:s') }}</td>
                            </tr>
                            <tr class="text-center">
                                <td>Employee Name</td>
                                <td>Employee Signature</td>
                                <td>Date Signed</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                            <table class="table">
                            <tr class="text-center">
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;">@if(!$record->supervisor_signature) <button type="button" data-toggle="modal" data-target="#modalSignatureSuper" class="btn btn-primary btn-lg btn-block">Supervisor Approval</button> @else <img src="<?php $file= $record->id.'_super_financial_assistance.png'; echo asset("storage/app/signatures/$file")?>"></img> @endif</td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                            </tr>
                            <tr class="text-center">
                                <td>Supervisor Name</td>
                                <td>Supervisor Signature</td>
                                <td>Date Signed</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                            <table class="table">
                            <tr class="text-center">
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"> @if(!$record->director_signature) <button type="button" data-toggle="modal" data-target="#modalSignature" class="btn btn-primary btn-lg btn-block">Director Approval</button> @else <img src="<?php $file= $record->id.'_director_financial_assistance.png'; echo asset("storage/app/signatures/$file")?>"></img> @endif </td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                            </tr>
                            <tr class="text-center">
                                <td>Director of Education</td>
                                <td>DOE Signature</td>
                                <td>Date Signed</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                            <table class="table">
                            <tr class="text-center">
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"> @if(!$record->admin_signature) <button type="button" data-toggle="modal" data-target="#modalSignatureAdmin" class="btn btn-primary btn-lg btn-block">Admin Approval</button> @else <img src="<?php $file= $record->id.'_admin_financial_assistance.png'; echo asset("storage/app/signatures/$file")?>"></img> @endif </td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                            </tr>
                            <tr class="text-center">
                                <td>Administrator Name</td>
                                <td>Administrator Signature</td>
                                <td>Date Signed</td>
                            </tr>
                        </table>
                    </div>

                </div>
        </div>


        <div style="page-break-after: always; page-break-inside: avoid;">

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
    </div>

</div>


@endsection
<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalSignature" tabindex="-1" role="dialog" aria-labelledby="exampleSignature"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee Signature</p>
            </div>

            <!--Body-->
            <div class="modal-body">

                <!--Panel-->
                <form  method="post" enctype="multipart/form-data" class="ansform"> <!--Panel-->

                    @method('PUT')
                {{ csrf_field() }}
                <div class="wrapper">

                  <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                </div>
                <div>
                    <input type="hidden" id="assid" name="assid" value="{{$record->id}}">
                  <button id="saveDOE">Save</button>
                  <button id="clearDOE">Clear</button>
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

<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalSignatureAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleSignatureAdmin"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Admin Signature</p>
            </div>

            <!--Body-->
            <div class="modal-body">

                <!--Panel-->
                <form  method="post" enctype="multipart/form-data" class="ansform"> <!--Panel-->

                    @method('PUT')
                {{ csrf_field() }}
                <div class="wrapper">

                  <canvas id="signature-pad-admin" class="signature-pad" width=400 height=200></canvas>
                </div>
                <div>
                    <input type="hidden" id="assid" name="assid" value="{{$record->id}}">
                  <button id="saveADMIN">Save</button>
                  <button id="clearADMIN">Clear</button>
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

<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalSignatureSuper" tabindex="-1" role="dialog" aria-labelledby="exampleSignatureAdmin"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Supervisor Signature</p>
            </div>

            <!--Body-->
            <div class="modal-body">

                <!--Panel-->
                <form  method="post" enctype="multipart/form-data" class="ansform"> <!--Panel-->

                    @method('PUT')
                {{ csrf_field() }}
                <div class="wrapper">

                  <canvas id="signature-pad-super" class="signature-pad" width=400 height=200></canvas>
                </div>
                <div>
                    <input type="hidden" id="assid" name="assid" value="{{$record->id}}">
                  <button id="saveSUPER">Save</button>
                  <button id="clearSUPER">Clear</button>
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

@push('scripts')
    <script src="/assets/plugins/d3/d3.min.js"></script>
        <script src="{{ url('/assets/js/signature-pad/signature_pad.umd.js') }}"></script>
        <script src="{{ url('/assets/js/signature-pad/app.js') }}"></script>


    </script>

 <script>

        $(function () {

                    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

                    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                      backgroundColor: 'rgba(255, 255, 255, 0)',
                      penColor: 'rgb(0, 0, 0)'
                    });
                    var saveButton = document.getElementById('saveDOE');
                    var cancelButton = document.getElementById('clearDOE');
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
                                url : '/fa/signatue/doe/'+ assid,
                                type: 'POST',
                                data : {
                                    signature: signaturePad.toDataURL(),
                                    assid: assid,

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

         <script>

        $(function () {

                    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

                    var signaturePad = new SignaturePad(document.getElementById('signature-pad-admin'), {
                      backgroundColor: 'rgba(255, 255, 255, 0)',
                      penColor: 'rgb(0, 0, 0)'
                    });
                    var saveButton = document.getElementById('saveADMIN');
                    var cancelButton = document.getElementById('clearADMIN');
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
                                url : '/fa/signatue/admin/'+ assid,
                                type: 'POST',
                                data : {
                                    signature: signaturePad.toDataURL(),
                                    assid: assid,

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

         <script>

        $(function () {

                    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

                    var signaturePad = new SignaturePad(document.getElementById('signature-pad-super'), {
                      backgroundColor: 'rgba(255, 255, 255, 0)',
                      penColor: 'rgb(0, 0, 0)'
                    });
                    var saveButton = document.getElementById('saveSUPER');
                    var cancelButton = document.getElementById('clearSUPER');
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
                                url : '/fa/signatue/super/'+ assid,
                                type: 'POST',
                                data : {
                                    signature: signaturePad.toDataURL(),
                                    assid: assid,

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
