@extends('layouts.sidebar-fixed')

@section('page-title', 'N95 Fit Test')
@section('page-heading', 'N95 Fit Test')
@push('css')

@endpush

@section('content')

    @include('partials.toastr')

    <div class="row text-center mb-4">
        <div class="col-xl-12 text-center">
            <img src="{{ url('/assets/img/peasi_lg.png') }}" alt="PEASI LOGO">
        </div>
    </div>
    <div class="row text-center border-bottom">
        <div class="col-xl-12 text-center">
            <h1 class="text-center">N95 FIT/SUPERVISED SEAL CHECK</h1>
        </div>
    </div>
    <form action="/n95Store" method="post">
        @csrf
        <div class="row mb-2">
            <div class="col-xl-4">
                <strong>Reason for test:</strong>
            </div>
            <div class="col-xl-8">
                <div class="form-group">
                    <select name="reason" id="reason_for_test" class="form-control" style="width: 100%" >
                        <option selected disabled>Select Reason for Test</option>
                        <option value="1" selected>Initial Completion</option>
                        <option value="2">Annual Rectification</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <strong>Employee Information</strong>
            </div>
        </div>
        <div class="row border-bottom">
            <div class="col-xl-3 p-2">
                <div class="form-group">
                    <select class="form-control" id="employee" name="user_id" style="width: 100%" onchange="findEmployee()">
                        <option selected disabled>Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{$employee->user_id}}">{{$employee->last_name ?? ''}}
                                , {{$employee->first_name ?? ''}}</option>
                        @endforeach
                    </select>
                    <label for="employee">Employee Name</label>
                </div>
            </div>
            <div class="col-xl-3 p-2">
                <div class="row border-bottom">
                    <div class="col-xl-12 text-center">
                        <span id="employee_name">&nbsp</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <strong>Employee Number</strong>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 p-2">
                <div class="row border-bottom">
                    <div class="col-xl-12 text-center">
                        <span id="eid">&nbsp</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <strong>Station</strong>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 p-2">
                <div class="row border-bottom">
                    <div class="col-xl-12 text-center">
                        {{Carbon\Carbon::now()->format('m-d-Y')}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <strong>Date Completed</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <strong>Respirator Information</strong>
            </div>
        </div>
        <div class="row border-bottom">
            <div class="col-xl-4">
                <select name="mask_type" id="respirator" class="form-control" style="width: 100%" onchange="findRespirator()">
                    <option selected disabled>Choose Mask Type</option>
                    @foreach($respiratorTypes as $rt)
                        <option value="{{$rt->id}}">{{$rt->brand}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-xl-4">
                <div class="row text-center border-bottom">
                    <div class="col-xl-12 text-center">
                        <span id="mask_type">&nbsp</span>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-xl-12">
                        <strong>Mask Type</strong>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="row text-center border-bottom">
                    <div class="col-xl-12 text-center">
                        <span id="niosh_number">&nbsp</span>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-xl-12">
                        <strong>NIOSH Approval Number</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <strong>Employee Demonstration</strong>
            </div>
        </div>
        <div class="row border-bottom">

            <div class="col-xl-6">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="proper_use" value="1" checked>
                        Proper use, donning and doffing
                    </label>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="face_seal_check" value="1" checked>
                        Respirator face seal check.
                    </label>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="understanding" value="1" checked>
                        Demonstrates understanding of how improper fit usage or maintenance can compromise the
                        protective effect of the respirator.
                    </label>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="proper_disposal" value="1" checked>
                        Proper disposal of respiratory N-95 respirators are only to be used once.*
                    </label>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="cleaning" value="1" checked>
                        Cleaning, care and storage of respirator.
                    </label>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-12">
                <strong>Limitations</strong>
            </div>
        </div>
        <div class="row border-bottom mb-2">

            <div class="col-xl-4">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="dentures" value="1">
                        Dentures
                    </label>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="facial_hair" value="1">
                        Facial Hair
                    </label>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="physica_exam" value="1">
                        Physical Exam Required
                    </label>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="glasses" value="1">
                        Glasses
                    </label>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group">

                    <input type="text" class="form-control" name="limitatiions_other">
                    <label>
                        Other
                    </label>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-12">
                <strong>Test Type</strong>
            </div>
        </div>
        <div class="row border-bottom mb-4">
            <div class="col-xl-12 mb-3">
                <select name="test_type"  class="form-control" style="width: 100%" >
                    <option selected disabled>Choose Test Type</option>
                    <option value="1">Supervised Seal Check</option>
                    <option value="2" selected>N95 / K95 Quantitative Fit Test</option>
                    <option value="3">N95 / K95 Qualitative Fit Test</option>
                </select>
            </div>
        </div>

        <div class="row border-bottom mb-4">
            <div class="col-xl-12 mb-3">
                <button type="submit" class="btn btn-primary btn-sm btn-block" > Submit Form For Signatures </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <p>
                    Application: For personal respiratory protection in Airborne Precaution Isolation Rooms. not for
                    use for any application other than the use for which individual trained for which is:
                </p>

                <p>
                    Personal Respiratory Protection in EMS Airborne Isolation. I understand that I must wear the size
                    and brand of N-95 / K-95 / Other respirator listed on this certificate, for my personal respiratory protection. If I enter
                    an AIRBORNE isolation area, and the N-95 / K-95 / Other Respirator is disposable and is not to be reused(*).
                </p>

                <p>
                    I understand that a bear and or mustache will interfere with respirator-to-face seal and therefore I am required to remove
                    any facial hair that inhibits the proper seal of the N-95 / K95 / Other Respirator for personal respiratory protection in order to fulfill my job requirements.
                </p>

            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-12" id="employee_signature">
                <button type="button" class="btn btn-primary btn-sm btn-block" disabled>Employee Signature</button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12" id="tester_signature">
                <button type="button" class="btn btn-primary btn-sm btn-block" disabled>Tester Signature</button>
            </div>
        </div>
    </form>


@stop

@push('scripts')
<script>
 function findEmployee() {
     console.log('Find Employee working');
    userId = document.getElementById('employee').value;

     $.ajax({
         url: '/getEmployee/'+ userId,
         cache: false,
         success: function(returnhtml){
             var data = jQuery.parseJSON(returnhtml);
             console.log(data);
             $('#employee_name').text(data[0].name);
             $('#eid').text(data[0].eid);
         }
     });
 }

 function findRespirator() {

     respiratorId = document.getElementById('respirator').value;

     $.ajax({
         url: '/getRespiratorType/'+ respiratorId,
         cache: false,
         success: function(returnhtml){
             var data = jQuery.parseJSON(returnhtml);

             $('#mask_type').text(data[0].type);
             $('#niosh_number').text(data[0].niosh);

         }
     });
 }
</script>
@endpush