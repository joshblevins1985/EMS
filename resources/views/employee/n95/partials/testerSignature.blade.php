<div class="row">
    <div class="col-xl-9 border-bottom">
        <span class="text-primary" style="font-style: italic; font-family: cursive ; font-size: large">{{$fit->test->first_name ?? ''}} {{$fit->test->last_name ?? ''}}</span>
    </div>
    <div class="col-xl-3 text-center border-bottom">
        {{Carbon\Carbon::parse($fit->tester_signature)->format('m-d-Y')}}
    </div>
</div>
<div class="row">
    <div class="col-xl-9">
        <strong>Tester/Trainer Signature</strong>
    </div>

    <div class="col-xl-3 text-center">
        <strong>Date Signed</strong>
    </div>
</div>
