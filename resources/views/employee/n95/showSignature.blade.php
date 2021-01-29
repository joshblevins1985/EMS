@extends('layouts.sidebar-fixed')

@section('page-title', 'N95 Fit Test')
@section('page-heading', 'N95 Fit Test')
@push('css')
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/signature-pad.css') }}">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printarea, #printarea * {
                visibility: visible;
                font-size: 14pt;
                color: black;
            }
            #printarea {
                position: absolute;
                left: 0;
            }
        }
    </style>
@endpush

@section('content')

    @include('partials.toastr')

    <div id="printarea">
        <div class="row text-center border-bottom">
            <div class="col-xl-12 text-center">
                <h1 class="text-center">N95 FIT/SUPERVISED SEAL CHECKS COMPLETED </h1>
            </div>
        </div>
        <div class="row text-center mb-4">
            <div class="col-12 text-center">
                <img src="{{ url('/assets/img/peasi_lg.png') }}" alt="PEASI LOGO">
            </div>
        </div>
        <div class="row text-center border-bottom mb-4">
            <div class="col-12 text-center">
                <h1 class="text-center">N95 FIT/SUPERVISED SEAL CHECK</h1>
            </div>
        </div>
        <form>
            <div class="row mb-2">
                <div class="col-4">
                    <strong>Reason for test:</strong>
                </div>
                <div class="col-4">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->reason == 1) checked
                                   @endif disabled>
                            Initial Completion
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->reason == 2) checked
                                   @endif disabled>
                            Annual Recertification
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <strong>Employee Information</strong>
                </div>
            </div>
            <div class="row border-bottom">
                <div class="col-3 p-2">
                    <div class="row border-bottom">
                        <div class="col-12 text-center">
                            <span id="employee_name">{{$fit->employee->first_name ?? ''}} {{$fit->employee->last_name ?? ''}}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 text-center">
                            <strong>Employee Name</strong>
                        </div>
                    </div>
                </div>
                <div class="col-3 p-2">
                    <div class="row border-bottom">
                        <div class="col-12 text-center">
                            <span id="employee_number">{{$fit->employee->eid ?? ''}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <strong>Employee Number</strong>
                        </div>
                    </div>
                </div>
                <div class="col-3 p-2">
                    <div class="row border-bottom">
                        <div class="col-12 text-center">
                            <span id="station">{{$fit->employee->station->station ?? ''}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <strong>Station</strong>
                        </div>
                    </div>
                </div>
                <div class="col-3 p-2">
                    <div class="row border-bottom ">
                        <div class="col-12 text-center">
                            {{Carbon\Carbon::parse($fit->created_at)->format('m-d-Y')}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <strong>Date Completed</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <strong>Respirator Information</strong>
                </div>
            </div>
            <div class="row border-bottom mb-3">
                <div class="col-4">
                    <div class="row text-center border-bottom">
                        <div class="col-12 text-center">
                            <span id="mask_brand">{{$fit->mask->brand}}</span>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <strong>Mask Type</strong>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row text-center border-bottom">
                        <div class="col-12 text-center">
                            <span id="mask_type">{{$fit->mask->type}}</span>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <strong>Mask Type</strong>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row text-center border-bottom">
                        <div class="col-12 text-center">
                            <span id="niosh_number">{{$fit->mask->niosh_number}}</span>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <strong>NIOSH Approval Number</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row border-bottom mb-4">
                <p>Application: For personal respiratory protection in Airborne Precaution Isolation Rooms. not for use
                    for any application other than the use for which individual trained for which is:</p>

                <p>
                    Personal Respiratory Protection in EMS Airborne Isolation. I understand that I must wear the size
                    and brand of N-95 / K-95 / Other respirator listed on this certificate, for my personal respiratory
                    protection. If I enter
                    an AIRBORNE isolation area, and the N-95 / K-95 / Other Respirator is disposable and is not to be
                    reused(*).
                </p>

                <div class="col-12" id="signature">

                    <div class="col-12" id="employee_signature">
                        @if($fit->employee_signature)
                            @include('employee.n95.partials.employeeSignature')
                        @else
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                    data-target="#employeeSignatureModal"> Employee Signature
                            </button>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <strong>Employee Demonstration</strong>
                </div>
            </div>
            <div class="row border-bottom mb-3">

                <div class="col-6">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->proper_use == 1) checked
                                   @endif disabled>
                            Proper use, donning and doffing
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->face_seal_check == 1) checked
                                   @endif disabled>
                            Respirator face seal check.
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->understanding == 1) checked
                                   @endif disabled>
                            Demonstrates understanding of how improper fit usage or maintenance can compromise the
                            protective effect of the respirator.
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->proper_disposal == 1) checked
                                   @endif disabled>
                            Proper disposal of respiratory N-95 respirators are only to be used once.*
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->cleaning == 1) checked
                                   @endif disabled>
                            Cleaning, care and storage of respirator.
                        </label>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <strong>Limitations</strong>
                </div>
            </div>
            <div class="row border-bottom">

                <div class="col-4">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label text-danger">
                            <input type="checkbox" class="form-check-input" @if($fit->dentures == 1) checked
                                   @endif disabled>
                            Dentures
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label text-danger">
                            <input type="checkbox" class="form-check-input" @if($fit->facial_hair == 1) checked
                                   @endif disabled>
                            Facial Hair
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label text-danger">
                            <input type="checkbox" class="form-check-input" @if($fit->physical_exam == 1) checked
                                   @endif disabled>
                            Physical Exam Required
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label text-danger">
                            <input type="checkbox" class="form-check-input" @if($fit->glasses == 1) checked @endif disabled>
                            Glasses
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label text-danger">
                            <input type="checkbox" class="form-check-input" @if($fit->limitatiions_other) checked
                                   @endif disabled>
                            Other: {{$limitatiions_other ?? ''}}
                        </label>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">

                    <p>
                        I understand that a bear and or mustache will interfere with respirator-to-face seal and therefore I
                        am required to remove any facial hair that inhibits the proper seal of the N-95 / K95 / Other
                        Respirator for personal respiratory protection in order to fulfill my job requirements.
                    </p>

                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 mb-4" id="signature">

                    <div class="col-12" id="employee_signature2">
                        @if($fit->employee_signature)
                            @include('employee.n95.partials.employeeSignature')
                        @else
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                    data-target="#employeeSignatureModal"> Employee Signature
                            </button>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <strong>Test Type</strong>
                </div>
                <div class="col-12">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->test_type == 1) checked @endif disabled>
                            Supervised seal check. (Permitted as primary test during state of emergency)
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->test_type == 2) checked @endif disabled>
                            N95 / K95 quantitative fit test.
                        </label>
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" @if($fit->test_type == 3) checked @endif disabled>
                            N95 / K95 qualitative fit test.
                        </label>
                    </div>
                </div>

                    <div class="col-12" >
                        @if($fit->tester_signature)
                            @include('employee.n95.partials.testerSignature')
                        @else
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                    data-target="#employeeSignatureModal"> Employee Signature
                            </button>
                        @endif
                    </div>


            </div>
        </form>


    </div>
@stop
@include('employee.n95.partials.employeeSignatureModal')
@push('scripts')
    <script>

        $('#employeeSign').on('click', function () {
            console.log('Employee Sign Working');
            id = $(this).data('id');

            $.ajax({
                url: '/n95EmployeeSignature/' + id,
                cache: false,
                success: function (returnhtml) {
                    $('#employee_signature').html(returnhtml);
                    $('#employee_signature2').html(returnhtml);
                    $('#employeeSignatureModal').modal('toggle');
                }
            });
        });

    </script>
@endpush