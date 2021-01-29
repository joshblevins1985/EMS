@extends('layouts.app')





@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Driving Assessment')
</li>
@stop

@section('content')

@include('partials.toastr')
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="row justify-content-center">
                <h1>Portsmouth Emergency Ambulance Service Inc</h1>


            </div>
            <div class="row justify-content-center">

                <h3>2796 Gallia Street Portsmouth, Ohio 45562</h3>

            </div>
            <div class="row justify-content-center "><h5>Phone: (740)351-3122  <image src="{{ url('public/assets/img/solrpt.jpg') }}"> Fax:(740)354-7100</h5></div>

            <div class="row border-bottom border-dark" style=" padding: 10px;">

                        <span class=" font-weight-bold ">Emergency Medical Services Driving Assessment Report.

                        </span>

            </div>
            <div class="row border-bottom border-dark report" style=" padding: 10px;">
                <div class="col-4">
                    <span class="font-weight-bold report">Employee Name: {{$da->employee->first_name}} {{$da->employee->last_name}}</span>
                </div>
                <div class="col-4">
                    <span class="font-weight-bold report">Job Title: {{$da->employee->employeepositions->label}}  </span>
                </div>
                <div class="col-4">
                    <span class="font-weight-bold report">Date of Evaluation: {{date('d-m-Y', strtotime($da->start_time))}} </span>
                </div>
            </div>
            <div class="row border-bottom border-dark report" style=" padding: 10px;">

                <div class="col-2">
                    <span class="font-weight-bold ">DA-{{date('y', strtotime($da->date_of_evaluation))}}-{{sprintf('%05d', $da->id )}}</span>
                </div>
                <div class="col-6">
                    <span class="font-weight-bold ">Total Time Viewed: {{$da->total_time}}</span>
                </div>
                <div class="col-4">
                    <span class="font-weight-bold "> Grade: {{round($da->performance_rating)}} % </span>

                </div>

            </div>
            <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>Evaluation</th>
                        <th>Score</th>
                        <th>Avl Points</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dq as $row)
                    <?php $score = 'q'.$row->id ?>
                    <tr>
                        <td>{{$row->question}}</td>

                            @if($da->$score < $row->p)
                        <td class="bg-danger">{{$da->$score}}</td>
                        @else
                         <td>{{$da->$score}}</td>
                            @endif

                        <td>{{$row->p}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="row border-bottom border-dark report" style="min-height: 25px; padding: 10px;">
                
                @foreach($da->attachments as $at)
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 m-4">
                            <video id='my-video' class='video-js' controls preload='auto' 
                          poster='' data-setup='{}'/>
                            <source src="{{ url('/storage/app/'.$at->file)  }}" type='video/mp4'>
                                                        <p class='vjs-no-js'>
                        </div>
                        
                    </div>
                @endforeach
                

            </div>


            <div style=" width: 100%;">
                <div class="row border-bottom border-dark report">
                    <div class="col-12">
                        By signing this form, you confirm that you understand the notations that have been communicated to you.
                    </div>
                </div>

                <div class="row report" style=" padding: 10px;">
                    
                    <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                        
                        @if($da->signature)
                        Employee Signature:  <img src="{{ url('https://emscomplete.app/storage/app/'.$da->signature)  }}" alt="Employee Signature" style="width:150px;height:50px;"> 
                        @else

                        Employee Signature:    <a data-toggle="modal" data-target="#modalSignature" class="text-center no-decoration"> Click Here for to sign document </a>
                        
                        @endif

                    </div>
                    <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">

                        @if($da->date_signed)
                        Date:{{Carbon::parse($da->date_signed)->format('m-d-Y')}}
                        @else
                        Date:____________________
                        @endif


                    </div>
                </div>
                <div class="row border-bottom border-dark report" style=" padding: 10px;">
                    <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                        @if(empty($da->evaluator))
                        Administration Signature:__________________________________________________
                        @else
                        Administration Signature: Electronically signed by {{$da->admin->first_name}} {{$da->admin->last_name}} {{$da->admin->eid}}
                        @endif
                    </div>
                    <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                        Date: {{ date('m-d-Y', strtotime($da->created_at))}}
                    </div>
                </div>

            </div>



        </div>

    </div>

@include('unitreviews.partials.modal_signature')
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
<link media="all" type="text/css" rel="stylesheet" href="{{ url('https://vjs.zencdn.net/7.4.1/video-js.css') }}">
<link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/signature-pad.css') }}">

@stop

@section('scripts')

 <script src="{{ url('https://vjs.zencdn.net/7.4.1/video.js') }}"></script>
 <script src="{{ url('public/assets/js/signature-pad/signature_pad.umd.js') }}"></script>
 <script src="{{ url('public/assets/js/signature-pad/app.js') }}"></script>

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
                        url : '{{route('driving.signature')}}',
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


@stop
