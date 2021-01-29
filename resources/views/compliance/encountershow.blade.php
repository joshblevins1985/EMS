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

    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="row justify-content-center">
                <h1>{{$encounter->company->name or ''}}</h1>
                

            </div>
            

            <div class="row border-bottom border-dark" style=" padding: 10px;">

                <span class=" font-weight-bold ">Employee  Notice
                @if($encounter->encounter_type == 1)
                        File Notation
                    @elseif($encounter->encounter_type == 2)
                        Corrective Counciling
                    @elseif($encounter->encounter_type == 3)
                        Verbal Warning
                    @elseif($encounter->encounter_type == 4)
                        Written Warning
                    @elseif($encounter->encounter_type == 5)
                        Suspension
                    @elseif($encounter->encounter_type == 6)
                        Termination
                    @elseif($encounter->encounter_type == 7)
                        Resignation
                    @elseif($row->encounter_type == 8)
                        Deemed Non-Driver
                    @elseif($row->encounter_type == 9)
                        Last Chance Agreement
                    @endif
                </span>

            </div>
            <div class="row border-bottom border-dark report" style=" padding: 10px;">
                <div class="col-md-4">
                    <span class="font-weight-bold report">Employee: {{$encounter->employee->first_name}} {{$encounter->employee->middle_name}}.  {{$encounter->employee->last_name}}</span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold report">Job Title: {{$encounter->employee->employeepositions->label}} </span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold report">Date of Incident: {{$encounter->doi}}</span>
                </div>
            </div>
            <div class="row border-bottom border-dark report" style=" padding: 10px;">
                <div class="col-md-12">
                    <span class="font-weight-bold ">Policy Violated: {{$encounter->policies->policy_number or ''}} -- {{$encounter->policies->title or 'Employee Reported'}}</span>
                </div>

            </div>
            <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
                <div class="col-md-12">
                    <span class="font-weight-bold ">Description of Incident:</span>
                </div>
                <div class="col-md-12">
                    {!!$encounter->incident_report!!}
                </div>
            </div>
            <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
                <div class="col-md-12">
                    <span class="font-weight-bold ">Plan of Action / Further Consequences:</span>
                </div>
                <div class="col-md-12">
                    {!!$encounter->plan!!}
                </div>
            </div>
            <div class="row border-bottom border-dark report">
                <div class="col-md-12">
                    <span class="font-weight-italic">By signing this form, you confirm that you understand the incident and warning that you are receiving.  You also understand the plan for improvement.  Signing this form does not necessarily indicate that you agree with this warning.</span>
                </div>
            </div>
            <div class="row report" style=" padding: 10px;">
                <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                    Employee Signature:__________________________________________________
                </div>
                <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                    Date:_______________________
                </div>
            </div>
            <div class="row " style=" padding: 10px;">
                <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                    Management Signature:__________________________________________________
                </div>
                <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                    Date:_______________________
                </div>
            </div>
            <div class="row border-bottom border-dark report" style=" padding: 10px;">
                <div class="col-12" style="margin-top: 5px; margin-bottom: 5px">
                    Witness Signature if employee refuses to sign:__________________________________________________
                </div>

            </div>
            <div class="row report">
                <div class="col-12"><span class="font-weight-bold ">If suspension is warranted please detail dates and time:</span></div>
                <div class="col-12"><span> </span></div>
            </div>
            <div class="row border-bottom border-dark report">
                <div class="col-12"><span class="font-weight-bold ">List any attachments provided to the employee (policies, or other documents)</span></div>
                <div class="col-12"><span >{{$encounter->associated}}</span></div>
            </div>

        </div>


        <div class="col-lg-4 col-sm-12 no-print">
            <div class="row">
                <!--Deep-orange-->
                <button type="button" class="btn btn-deep-orange" data-toggle="modal" data-target="#basicExampleModal2">Add Note</button>

                <!--Deep-orange-->
                <button type="button" class="btn btn-deep-orange" data-toggle="modal" data-target="#basicExampleModal">Add Attachment</button>

                <!--Deep-orange-->
                <a href="{{$encounter->id}}/edit"><button type="button" class="btn btn-deep-orange" >Edit Encounter</button></a>
                
                <!--Deep-orange-->
                <a href="/encounterreport/pdf/{{$encounter->id}}"><button type="button" class="btn btn-deep-orange" >Export PDF</button></a>
            </div>

            <div class="row">
                <h4>Notes and Attachment List</h4>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="list-group col-12">
                    <a href="#" class="list-group-item active waves-light">Available Attachments</a>
                    @foreach($encounter->encounterattachment as $eerow)
                        <a href="/storage/app/{{$eerow->file}}" class="list-group-item waves-effect" download="{{$eerow->file}}">{{$eerow->name}}</a>
                    @endforeach
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="list-group col-12">
                    <a href="#" class="list-group-item active waves-light" >Encounter Notes</a>
                    @foreach($encounter->encounternote as $enrow)
                        <a href="#" class="list-group-item waves-effect">{!!$enrow->note!!} <span class="badge badge-primary badge-pill">{{date('m-d-Y', strtotime($enrow->created_at))}}</span></a>
                    @endforeach
                </div>
            </div>
            
            <div class="row" style="margin-top: 20px">
                <div class="list-group col-12">
                    <a href="#" class="list-group-item active waves-light" >Employee Incident Reports</a>
                    @foreach($encounter->encounterreport as $row)
                        <a href="/incidentreports/{{$row->id}}" class="list-group-item waves-effect">{{$row->employee->first_name}} {{$row->employee->last_name}} <span class="badge badge-primary badge-pill">{{date('m-d-Y', strtotime($row->created_at))}}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <!--Modal for Adding Attachments-->

    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Attachments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/encounterattachments" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <label for="Product Name">Attachment Name</label>

                            <input type="text" name="name" class="form-control"  placeholder="Attachment Title" >

                        </div>

                        <label for="Attachment Title">Attachments (can attach more than one):</label>

                        <input type="hidden" name="pid" value="{{$encounter->id}}">

                        <br />

                        <input type="file" class="form-control" name="attachments[]" multiple />

                        <br /><br />

                        <input type="submit" class="btn btn-primary" value="Upload" />

                    </form>
                </div>

            </div>
        </div>
    </div>


    <!--Modal for Adding Attachments-->

    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Add Encounter Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => route('encounternotes.store'), 'method' => 'POST']) !!}
                    @csrf

                    <div class="form-group">
                        <label for="note">Encounter Note</label>
                        <textarea class="form-control rounded-0" id="note" name="note" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="pid" value="{{$encounter->id}}">
                    <button class="btn btn-info btn-block my-4" type="submit">Add New Note</button>
                    {!! Form::close() !!}
                </div>

            </div>
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
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@stop