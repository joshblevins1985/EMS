@extends('layouts.app')

@section('page-title', trans('Instructed Class'))
@section('page-heading', trans('Instructed Class'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')
<!--Card For Main Course Data-->
<div class="row">
    <!--Panel-->
    <div class="card card-body">
        <h4 class="card-title">{{$class->course->title}} -- {{$class->iid}}</h4>
        <div class="row">
            <div class="col-lg-4">
                Lead Instructor: {{$class->lead->first_name}} {{$class->lead->last_name}}
            </div>
            <div class="col-lg-4">
                Start Date: {{date('m-d-Y', strtotime($class->start))}}
            </div>
            <div class="col-lg-4">
                Close Date: {{date('m-d-Y', strtotime($class->end))}}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                Instruction Type:
                @if($class->type == 'O')
                Online Course
                @elseif($class->type == 'C')
                Class Room Course
                @elseif($class->type == 'H')
                Hybrid Course
                @endif
            </div>
            <div class="col-lg-4">
                Location of Course: {{$class->location}}
            </div>
            <div class="col-lg-4">
                This course is @if($class->required == 1) required @else not required @endif
            </div>
        </div>

    </div>
    <!--/.Panel-->
</div>

<div class="row">
    <!--Panel-->
    <div class="card card-body">
        <h4 class="card-title">Course Dates</h4>
        <hr>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Instructor</th>
                <th>Roster</th>
            </tr>
            </thead>
            <tbody>
                @foreach($class->course_dates as $row)
                    <tr>
                        <td>{{ Carbon\Carbon::parse($row->course_date)->format('m/d/Y') }}</td>
                        <td>{{$row->start_time}}</td>
                        <td>{{ $row->end_time}}</td>
                        <td>{{$row->instruct->first_name or 'unknown'}} {{$row->instruct->last_name or ''}}</td>
                        <td><a href="/class/roster/{{$class->id}}/{{$row->course_date}}/{{$row->id}}"><span class="badge badge-info" >Roster</span></a>       
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!--/.Panel-->
</div>

<div class="row">
     <!--Card Primary-->
    <div class="card indigo text-center z-depth-2 col-lg-12">
      <div class="card-body">
        
        <button type="button" data-toggle="modal" data-target="#addStudent" class="btn btn-outline-warning btn-rounded waves-effect"><h3 class="text-uppercase font-weight-bold amber-text mt-2 mb-3"><strong>Add Student</strong><i class="fa fa-plus ml-3"></i></h3></button>
        
        <button type="button" data-toggle="modal" data-target="#addGroup" class="btn btn-outline-warning btn-rounded waves-effect"><h3 class="text-uppercase font-weight-bold amber-text mt-2 mb-3"><strong>Add Group</strong><i class="fa fa-plus ml-3"></i></h3></button>
        
        <button type="button" data-toggle="modal" data-target="#courseDates" data-classid= "{{$class->id}}" class="btn btn-outline-warning btn-rounded waves-effect"><h3 class="text-uppercase font-weight-bold amber-text mt-2 mb-3"><strong>Add Course Date</strong><i class="fa fa-plus ml-3"></i></h3></button>
      </div>
    </div>
    <!--/.Card Primary-->
</div>

<!--Row for Students and ???-->
<div class="row">
    <!--Enrolled Students-->
    <div class="col-lg-6 col-sm-12">
        <!--Panel-->
        <div class="card text-center">
            <div class=" card-header elegant-color white-text">
                <div class="col-xl-4">
                    <a data-toggle="modal" data-toggle="modal" data-target="#completeCourse" data-userid="0" data-classid= "{{$class->id}}" title="Add this item" class="open-courseComplete" href="#"><span class="badge badge-info" >Complete All Students  </span></a>
                </div>
                <div class="col-xl-4">
                    
                </div>
                Enrolled Students
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($enrolled as $row)
                    <?php
                    if ($row->status == 1) {
                        $cert = '/certificate/' . $class->id . '/' . $row->user_id;?>
                        <a href="{{$cert}}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="col-lg-12 col-sm-12">
                            {{ $row->student->first_name or 'Unknown' }} {{ $row->student->last_name or '' }} -- {{
                            $row->student->eid or 'EID Unknown' }}
                            @if($row->status == 1)
                            -- <span class="badge badge-success">Completed {{date('m-d-Y H:i', strtotime($row->completed))}}</span>
                            @else

                            -- <span class="badge badge-warning">Incomplete </span>

                            
                            
                            <a data-toggle="modal" data-toggle="modal" data-target="#completeCourse" data-userid="{{$row->student->user_id}}" data-classid= "{{$class->id}}" title="Add this item" class="open-courseComplete" href="#"><span class="badge badge-info" >Complete Manually  </span></a>       


                            @endif
                            
                            
                        </div>

                    </a>
                    <?php
                    } else { ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="col-lg-12 col-sm-12">
                            {{ $row->student->first_name or 'Unknown' }} {{ $row->student->last_name or '' }} -- {{
                            $row->student->eid or 'EID Unknown' }}
                            @if($row->status == 1)
                            -- <span class="badge badge-success">Completed {{date('m-d-Y H:i', strtotime($row->completed))}}</span>
                            @else

                            -- <span class="badge badge-warning">Incomplete </span>

                            <a data-toggle="modal" data-toggle="modal" data-target="#completeCourse" data-userid="{{$row->student->user_id}}" data-classid= "{{$class->id}}"  title="Add this item" class="open-courseComplete" href="#"><span class="badge badge-info" >Complete Manually  </span></a>       
                            
                            @endif
                            
                            <a href="{{ route('enrolled.destroy', ['id' => $row->student->user_id, 'courseId' => $class->id] ) }}" onclick="alert('You are deleting employee from class.')">
                                <span class="badge badge-danger" ><i class="fas fa-trash"></i> Remove Student  </span>
                            </a>
                                                
                           

                        </div>

                    </div>
                    <?php } ?>


            
                    
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-muted elegant-color white-text">
                <p class="mb-0">{{$enrolled->links()}}</p>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    <!---->
    <div class="col-lg-6 col-sm-12">
        <!--Panel-->
        <div class="card text-center">
            <div class=" card-header elegant-color white-text">
                Certifications Issued
            </div>
            <div class="card-body">
                <div class="list-group">

                </div>
            </div>
            <div class="card-footer text-muted elegant-color white-text">
                <p class="mb-0">Table Links</p>
            </div>
        </div>
        <!--/.Panel-->
    </div>

</div>

@include('classes.partials.modal_add_student')

@include('classes.partials.modal_add_group')

@include('classes.partials.modal_course_complete')

@include('classes.partials.modal_add_course_dates')
@stop

@section('styles')

@stop

@section('scripts')

<script>
    $(document).on("click", ".open-courseComplete", function () {
     var userId = $(this).data('userid');
     var classId = $(this).data('classid');
     $(".modal-body #userId").val( userId );
     $(".modal-body #classId").val( classId );
});
</script>

<script>
    $('#input_starttime').pickatime({
    // 12 or 24 hour
    twelvehour: false,
    darktheme: true
});

    $('#input_endtime').pickatime({
    // 12 or 24 hour
    twelvehour: false,
    darktheme: true
});
</script>



@stop