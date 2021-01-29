<html>
<head>
    <title>Fit Test Report - PDF</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="container-fluid">
    @foreach($stations as $station)
        <div class="row text-center mb-4">
            <div class="col-12 text-center">
                <img src="{{ public_path('/assets/img/peasi_lg.png') }}" alt="PEASI LOGO">
            </div>
        </div>
        <div class="row text-center border-bottom">
            <div class="col-12 text-center">
                <h1 class="text-center">{{$station->station}} </h1>
            </div>
        </div>
        <div style="page-break-after: always; page-break-inside: avoid;"></div>
        <?php
        $employees = \Vanguard\Employee::whereHas('fitTest')->where('primary_station', $station->id)->whereIn('primary_position', [3, 4, 5, 7, 8, 9, 17, 21, 34, 35, 37])->whereIn('status', [2, 3, 4, 5, 10])->orderBy('last_name')->get();
        ?>
        @foreach($employees as $row)
            <div class="row text-center mb-4">
                <div class="col-12 text-center">
                    <img src="{{ public_path('/assets/img/peasi_lg.png') }}" alt="PEASI LOGO">
                </div>
            </div>
            <div class="row text-center border-bottom mb-4">
                <div class="col-12 text-center">
                    <h1 class="text-center">N95 FIT/SUPERVISED SEAL CHECK</h1>
                </div>
            </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <strong>Reason for test:</strong>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" @if($row->fittest->reason == 1) checked
                                       @endif disabled>
                                Initial Completion
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" @if($row->fittest->reason == 2) checked
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
                    <div class="col-3">
                        <div class="row border-bottom">
                            <div class="col-12 text-center">
                                <span>{{$row->first_name ?? ''}} {{$row->last_name ?? ''}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <strong>Employee Name</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row border-bottom">
                            <div class="col-12 text-center">
                                <span>{{$row->eid ?? ''}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <strong>Employee Number</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row border-bottom">
                            <div class="col-12 text-center">
                                <span>{{$row->station->station ?? ''}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <strong>Station</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row border-bottom ">
                            <div class="col-12 text-center">
                                {{Carbon\Carbon::parse($row->fittest->created_at)->format('m-d-Y')}}
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
                                <span>{{$row->fittest->mask->brand}}</span>
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
                                <span>{{$row->fittest->mask->type}}</span>
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
                                <span>{{$row->fittest->mask->niosh_number}}</span>
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
                    <div class="col-12">
                        <div class="col-12 mb-2">
                        <span>
                        Application: For personal respiratory protection in Airborne Precaution Isolation Rooms. not for use
                        for any application other than the use for which individual trained for which is:
                        </span>
                        </div>
                        <div class="col-12 mb-2">
                        <span>
                            Personal Respiratory Protection in EMS Airborne Isolation. I understand that I must wear the size
                        and brand of N-95 / K-95 / Other respirator listed on this certificate, for my personal respiratory
                        protection. If I enter
                        an AIRBORNE isolation area, and the N-95 / K-95 / Other Respirator is disposable and is not to be
                        reused(*).
                        </span>
                        </div>
                        @if($row->fittest->employee_signature)
                            <div class="row">
                                <div class="col-9 border-bottom">
                                    <span class="text-primary"
                                          style="font-style: italic; font-family: cursive ; font-size: large">{{$row->fittest->employee->first_name ?? ''}} {{$row->fittest->employee->last_name ?? ''}}</span>
                                </div>
                                <div class="col-3 text-center border-bottom">
                                    {{Carbon\Carbon::parse($row->fittest->employee_signature)->format('m-d-Y')}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9">
                                    <strong>Employee Signature</strong>
                                </div>

                                <div class="col-3 text-center">
                                    <strong>Date Signed</strong>
                                </div>
                            </div>
                        @else
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                    data-target="#employeeSignatureModal"> Employee Signature
                            </button>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <strong>Employee Demonstration</strong>
                    </div>
                </div>
                <div class="row border-bottom mb-3">
                    <div class="col-12">
                        <div class="col-5">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->proper_use == 1) checked
                                           @endif disabled>
                                    Proper use, donning and doffing
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->face_seal_check == 1) checked
                                           @endif disabled>
                                    Respirator face seal check.
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->understanding == 1) checked
                                           @endif disabled>
                                    Demonstrates understanding of how improper fit usage or maintenance can compromise the
                                    protective effect of the respirator.
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->proper_disposal == 1) checked
                                           @endif disabled>
                                    Proper disposal of respiratory N-95 respirators are only to be used once.*
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->cleaning == 1) checked
                                           @endif disabled>
                                    Cleaning, care and storage of respirator.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <strong>Limitations</strong>
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="col-12">
                        <div class="col-3">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label text-danger">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->dentures == 1) checked
                                           @endif disabled>
                                    Dentures
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label text-danger">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->facial_hair == 1) checked
                                           @endif disabled>
                                    Facial Hair
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label text-danger">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->physical_exam == 1) checked
                                           @endif disabled>
                                    Physical Exam Required
                                </label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label text-danger">
                                    <input type="checkbox" class="form-check-input" @if($row->fittest->glasses == 1) checked
                                           @endif disabled>
                                    Glasses
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label text-danger">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->limitatiions_other) checked
                                           @endif disabled>
                                    Other: {{$row->fittest->limitatiions_other ?? ''}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        I understand that a bear and or mustache will interfere with respirator-to-face seal and
                        therefore I
                        am required to remove any facial hair that inhibits the proper seal of the N-95 / K95 / Other
                        Respirator for personal respiratory protection in order to fulfill my job requirements.
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="col-12">
                            @if($row->fittest->employee_signature)
                                <div class="row">
                                    <div class="col-9 border-bottom">
                                    <span class="text-primary"
                                          style="font-style: italic; font-family: cursive ; font-size: large">{{$row->fittest->employee->first_name ?? ''}} {{$row->fittest->employee->last_name ?? ''}}</span>
                                    </div>
                                    <div class="col-3 text-center border-bottom">
                                        {{Carbon\Carbon::parse($row->fittest->employee_signature)->format('m-d-Y')}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9">
                                        <strong>Employee Signature</strong>
                                    </div>

                                    <div class="col-3 text-center">
                                        <strong>Date Signed</strong>
                                    </div>
                                </div>
                            @else
                                <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                        data-target="#employeeSignatureModal"> Employee Signature
                                </button>
                            @endif
                        </div>
                        <div class="col-12">
                            <strong>Test Type</strong>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->test_type == 1) checked @endif disabled>
                                    Supervised seal check. (Permitted as primary test during state of emergency)
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->test_type == 2) checked @endif disabled>
                                    N95 / K95 quantitative fit test.
                                </label>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           @if($row->fittest->test_type == 3) checked @endif disabled>
                                    N95 / K95 qualitative fit test.
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            @if($row->fittest->tester_signature)
                                <div class="row">
                                    <div class="col-9 border-bottom">
                                    <span class="text-primary"
                                          style="font-style: italic; font-family: cursive ; font-size: large">{{$row->fittest->test->first_name ?? ''}} {{$row->fittest->test->last_name ?? ''}}</span>
                                    </div>
                                    <div class="col-3 text-center border-bottom">
                                        {{Carbon\Carbon::parse($row->fittest->tester_signature)->format('m-d-Y')}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9">
                                        <strong>Tester/Trainer Signature</strong>
                                    </div>

                                    <div class="col-3 text-center">
                                        <strong>Date Signed</strong>
                                    </div>
                                </div>
                            @else
                                <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                        data-target="#employeeSignatureModal">Tester Signature
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    (*) Items marked with an asterisk have approval due to state of emergency during national pandemic.
                </div>

            <div style="page-break-after: always; page-break-inside: avoid;"></div>
        @endforeach

    @endforeach
</div>
</body>
</html>