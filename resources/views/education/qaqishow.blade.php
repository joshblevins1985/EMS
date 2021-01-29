@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')
<a href="/qa/pdf/{{$qa->id}}">Export to PDF</a>
@if($qa->file) <a href="/storage/app/{{$qa->file}}">Patient Care Report</a> @endif
<div class="row">

    <div class="col-lg-8 col-sm-12">
        <div class="row justify-content-center">
            <h1>Portsmouth Emergency Ambulance Service Inc</h1>
            <p><h3>2796 Gallia Street Portsmouth, Ohio 45562</h3></p>

        </div>
        <div class="row justify-content-center "><h5>Phone: (740)351-3122  <image src="{{ url('public/assets/img/solrpt.jpg') }}"> Fax:(740)354-7100</h5></div>

        <div class="row border-bottom border-dark" style=" padding: 10px;">

            <span class=" font-weight-bold ">Emergency Medical Services Quality Assurance of Patient care reports.

            </span>

        </div>
        <div class="row border-bottom border-dark report" style=" padding: 10px;">
            <div class="col-md-4">
                <span class="font-weight-bold report">Employee Name: {{$qa->employee->first_name}} {{$qa->employee->last_name}}</span>
            </div>
            <div class="col-md-4">
                <span class="font-weight-bold report">Job Title: {{$qa->employee->employeepositions->label}}  </span>
            </div>
            <div class="col-md-4">
                <span class="font-weight-bold report">Date of Incident/Transport: {{date('d-m-Y', strtotime($qa->date))}} </span>
            </div>
        </div>
        <div class="row border-bottom border-dark report" style=" padding: 10px;">
            <div class="col-md-8">
                <span class="font-weight-bold ">Run Location: {{$qa->location}}</span>
            </div>
            <div class="col-md-4">
                <span class="font-weight-bold ">PCR Grade: @if($qa->grade == 1) Sufficient @elseif($qa->grade == 2) Insufficient @endif</span>
            </div>

        </div>
        <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
            <div class="col-md-6">
                <div class="col-md-12">
                    <span class="font-weight-bold ">QA/QI Comments:</span>
                </div>
                <div class="col-md-12">
                    {!!$qa->comments!!}
                </div>
            </div>
            <div class="col-md-6">
                <h1>{{$qa->percent or 'Unk'}} %</h1>
            </div>

        </div>

        <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
            <div class="col-md-6">
                <div class="col-md-12">
                    <span class="font-weight-bold ">Opportunities Noted:</span>
                </div>
                @foreach($defficiency as $row)
                <div class="col-md-12">
                    ** {{$row->defficiency}}
                </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">1. Were the crew's full names, certifications, unit info, and patient demographics completed?
                    </div>
                    <div class="col-md-2">@if($qa->q1 == 10) Sufficient  @elseif($qa->q1 == 5) Needs Improvement  @elseif($qa->q1 == 0) Insufficient @endif </div>
                </div>

                <div class="row">
                    <div class="col-md-10">2. Was the patient evaluation clearly and fully documented?
                    </div>
                    <div class="col-md-2">@if($qa->q2 == 20) Sufficient  @elseif($qa->q2 == 10) Needs Improvement  @elseif($qa->q2 == 0) Insufficient @endif </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">3. Was the method used to transfer patient to the stretcher clearly documented?

                    </div>
                    <div class="col-md-2">@if($qa->q3 == 10) Sufficient  @elseif($qa->q3 == 5) Needs Improvement  @elseif($qa->q3 == 0) Insufficient @endif </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">4. Was the reason the patient requires stretcher clearly documented?

                    </div>
                    <div class="col-md-2">@if($qa->q4 == 20) Sufficient  @elseif($qa->q4 == 10) Needs Improvement  @elseif($qa->q4 == 0) Insufficient @endif </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">5. Was the treatment appropriate, justified, and clearly documented?

                    </div>
                    <div class="col-md-2">@if($qa->q5 == 30) Sufficient  @elseif($qa->q5 == 15) Needs Improvement  @elseif($qa->q5 == 0) Insufficient @endif </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">6. Were all protocols followed during transport?

                    </div>
                    <div class="col-md-2">@if($qa->q6 == 10) Sufficient  @elseif($qa->q6 == 5) Needs Improvement  @elseif($qa->q6 == 0) Insufficient @endif </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">7. Were all times clearly documented?

                    </div>
                    <div class="col-md-2">@if($qa->q7 == 10) Sufficient  @elseif($qa->q7 == 5) Needs Improvement  @elseif($qa->q7 == 0) Insufficient @endif </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">8. Was the writing legible?

                    </div>
                    <div class="col-md-2">@if($qa->q8 == 10) Sufficient  @elseif($qa->q8 == 5) Needs Improvement  @elseif($qa->q8 == 0) Insufficient @endif </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">9. Were all required signatures for crew and patient completed?

                    </div>
                    <div class="col-md-2">@if($qa->q9 == 10) Sufficient  @elseif($qa->q9 == 5) Needs Improvement  @elseif($qa->q9 == 0) Insufficient @endif </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">10. Is all associated documentation attached to the PCR ie. Facesheet, Doctor Cert?

                    </div>
                    <div class="col-md-2">@if($qa->q10 == 20) Sufficient  @elseif($qa->q10 == 10) Needs Improvement  @elseif($qa->q10 == 0) Insufficient @endif </div>
                </div>

            </div>

        </div>


        <div class="row border-bottom border-dark report">
            <div class="col-md-12">
                <span class="font-weight-italic">By signing this form, you confirm that you understand the notations that have been communicated to you. If employee response was required a signature is required.</span>
            </div>
        </div>
        <div class="row report" style=" padding: 10px;">
            <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                @if(empty($qa->acknowledged))
                Employee Signature:__________________________________________________
                @else
                Employee Signature: Electronically signed by {{$qa->employee->first_name}} {{$qa->employee->last_name}} {{$qa->employee->eid}}  
                @endif

            </div>
            <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                @if(empty($qa->acknowledged))
                Date:_______________________
                @else
                Date: {{ date('m-d-Y', strtotime($qa->acknowledged_date)) }} 
                @endif

            </div>
        </div>
        <div class="row border-bottom border-dark report" style=" padding: 10px;">
                            <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                                 @if(empty($qa->added_by))
                                Administration Signature:__________________________________________________
                                @else
                                Administration Signature: Electronically signed by {{$qa->addedby->first_name}} {{$qa->addedby->last_name}} {{$qa->addedby->eid}}  
                                @endif
                            </div>
                            <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                                Date: {{ date('m-d-Y', strtotime($qa->created_at)) }}  
                            </div>
                        </div>
        

    </div>
    
    <div class="col-lg-4 col-sm-12">
        @if(empty($qa->acknowledged))
        By clicking the button below you are electronically acknowleding receipt of this quality assurance. By clicking the button you are not admiting guilt or agreeing with the contents. However you are acknowldging you have read the review and understand its contents.

        <form  action="/qa/acknowledge/{{$qa->id}}" method="POST" >
            {{csrf_field()}}

            <input type="hidden" name="id" value="{{$qa->id}}">

            <hr>

            <button type="submit" class="btn btn-outline-danger btn-rounded waves-effect btn-block">I confirm I have read and understand this QA.</button>
        </form>
        @else
        You have acknowledged and signed the form.
        @endif
    </div>        
</div>


@stop

@section('styles')
<style>
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }

        .report
        {
            font-size: 125%;
        }
    }
</style>
@stop

@section('scripts')
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });
</script>
@stop