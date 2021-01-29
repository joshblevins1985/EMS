@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.messages')



<div class="row">
    <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            Scholarship Courses
          </div>
          <div class="card-body">
          
            <div class="card-text">
                <ul class="list-group">
                    @foreach($scholarships as $row)
                  <li class="list-group-item">
                      <div class="row">
                          {{ Carbon\Carbon::parse($row->start_date)->format('m-d-Y') }} -- {{$row->school_name}}
                      </div>
                      <div class="row">
                          <span class="badge badge-info">Applied <span class="badge badge-danger ml-2">{{$row->attendance->applicant or '?'}}</span></span>
                          <span class="badge badge-primary">Enrolled <span class="badge badge-danger ml-2">{{$row->attendance->enrolled or '?'}}</span></span>
                          <span class="badge badge-warning">Testing <span class="badge badge-danger ml-2">{{$row->attendance->testing or '?'}}</span></span>
                          <span class="badge badge-success">Passed <span class="badge badge-danger ml-2">{{$row->attendance->passed or '?'}}</span></span>
                          <span class="badge badge-danger">Failed <span class="badge badge-info ml-2">{{$row->attendance->failed or '?'}}</span></span>
                       
                      </div>
                  
                  </li>
                  
                  @endforeach
                </ul>
            </div>
          </div>
        </div>
    </div>
    <div class"col-lg-4">
        <div class="card">
          <div class="card-header">
            Students Testing NREMT
          </div>
          <div class="card-body">
        
            <div class="card-text">
                <ul class="list-group">
                    @foreach($students as $row)
                  <li class="list-group-item">
                      <div class="row">
                         {{$row->student}}
                      </div>
                      
                  </li>
                  
                  @endforeach
                </ul>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="row">
        @foreach($scholarships as $row)
        <div class="card">
          <div class="card-header">
              <div class="row">
                  {{ Carbon\Carbon::parse($row->start_date)->format('m-d-Y') }} -- {{$row->school_name}}
              </div>
              <div class="row">
                  <a type="button" href="/scholarship/report/pdf/{{$row->id}}" class="btn-floating btn-sm deep-purple"><i class="fas fa-print" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Print scholarship check list."></i></a>
                  <a type="button" class="btn-floating btn-sm green"><i class="fas fa-plus" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Add students to scholarship."></i></a>
                  <a type="button" href="/scholarship/entrance_mail/{{$row->id}}" class="btn-floating btn-sm green"><i class="fal fa-envelope-square" data-toggle="tooltip" data-placement="top" title="Send entrance email."></i></a>
                  <a type="button" href="/scholarship/acceptance/{{$row->id}}" class="btn-floating btn-sm green"><i class="far fa-clipboard-list-check" data-toggle="tooltip" data-placement="top" title="Send acceptance letter."></i></a>
                  <a type="button" href="/scholarship/roster/pdf/{{$row->id}}" class="btn-floating btn-sm deep-purple"><i class="fad fa-clipboard-user" data-toggle="tooltip" data-placement="top" title="Print course roster."></i></a>
                  <a type="button" data-toggle="modal" data-target="#AddNewCourseModal" data-oid="{{$row->id}}" class="btn-floating btn-sm deep-purple"><i class="fas fa-user-plus" data-toggle="tooltip" data-placement="top" title="Add students to course."></i></a>
              </div>
          </div>
          <div class="card-body">
            <div class="card-header">
            
              </div>
            <div class="card-text">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Application</th>
                            <th>Essay</th>
                            <th>Transcript</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($row->applicants)
                        @foreach($row->applicants as $srow)
                        <tr>
                        <td><a data-toggle="modal" data-target="#StudentEditModal" data-student="{{$srow->id}}" data-reading="{{$srow->reading}}"  data-emt="{{$srow->emt}}"  data-math="{{$srow->math}}">{{$srow->student or '?'}}</a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>@if($srow->status == 1) Applied @elseif($srow->status == 2) Accepted @elseif($srow->status == 3) Denied @elseif($srow->status == 4) Enrolled @elseif($srow->status == 5) Testing @elseif($srow->status == 6) Passed @elseif($srow->status == 7) Failed @elseif($srow->status == 8) Dropped @endif</td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="col-12">
                                          @if($srow->reading > 0)
                                            @if($srow->reading >= 8)
                                            <span class="badge badge-success">Reading: {{$srow->reading}}</span>
                                            @elseif($srow->reading < 8)
                                            <span class="badge badge-danger">Reading: {{$srow->reading}}</span>
                                            @endif
                                        @endif
                                        
                                        @if($srow->emt > 0)
                                            @if($srow->emt >= 63)
                                            <span class="badge badge-success">EMT: {{$srow->emt}}</span>
                                            @elseif($srow->emt < 63)
                                            <span class="badge badge-danger">EMT: {{$srow->emt}}</span>
                                            @endif
                                        @endif
                                        
                                        @if($srow->math > 0)
                                            @if($srow->math >= 96)
                                            <span class="badge badge-success">Math: {{$srow->math}}</span>
                                            @elseif($srow->math < 96)
                                            <span class="badge badge-danger">Math: {{$srow->math}}</span>
                                            @endif
                                        @endif  
                                </div>
                                <div class="col-12">
                                    @if($srow->agreement)
                                        <i class="far fa-file-signature"></i>
                                    @endif
                                </div>
                                
                            
                            </td>
                        </tr>
                        @endforeach
                        @else
                        no
                        @endif
                    </tbody>
                </table>
                
            </div>
          </div>
        </div>
        @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="StudentEditModal" tabindex="-1" role="dialog" aria-labelledby="StudentEditLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="StudentEditLabel">Update Student Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            {!! Form::open(['url' => route('scholarship.update', '1' ), 'method' => 'POST', 'id' => 'student_form']) !!}
   
            @method('PUT')
                <select class="mdb-select md-form" name="status">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="1">Applied</option>
                  <option value="2">Accepted</option>
                  <option value="3">Denied</option>
                  <option value="4">Enrolled</option>
                  <option value="5">Testing</option>
                  <option value="6">Passed</option>
                  <option value="7">Failed</option>
                  <option value="8">Dropped</option>
                </select>
                
                <div class="md-form">
                  <input type="text" id="reading"  name="reading" value="{{old('reading')}}" class="form-control">
                  <label for="reading">Reading Score</label>
                </div>
                
                <div class="md-form">
                  <input type="text" id="emt"  name="emt" value="{{old('emt')}}" class="form-control">
                  <label for="emt">EMT Score</label>
                </div>
                
                <div class="md-form">
                  <input type="text" id="math"  name="math" value="{{old('math')}}" class="form-control">
                  <label for="math">Math Score</label>
                </div>
        
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="AddNewCourseModal" tabindex="-1" role="dialog" aria-labelledby="AddNewCourseLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddNewCourseLabel">Add Accepted Students to Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="/scholarship/addNewCourse" method="post">
   
            @csrf
            
                <input type="hidden" id="oid" name="oid">
            
            
                <select class="mdb-select md-form" name="cid">
                  <option value="" disabled selected>Choose The Course</option>
                  @foreach($classes as $row)
                  <option value="{{ $row->id }}">{{ $row->lable }} - {{ $row->description or '' }}</option>
                 @endforeach
                </select>
                
                
        
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>



@stop

@section('styles')

@stop
@section('scripts')
<script>
$('#AddNewCourseModal').on('show.bs.modal', function(e) {
    var oid = $(e.relatedTarget).data('oid');
    
    $("#oid").val(oid);

});
</script>

<script>
$('#StudentEditModal').on('show.bs.modal', function(e) {
    var student = $(e.relatedTarget).data('student');
    var reading = $(e.relatedTarget).data('reading');
    var emt = $(e.relatedTarget).data('emt');
    var math = $(e.relatedTarget).data('math');

    $('#student_form').attr('action', '/scholarship/' + student);
    $("#reading").val(reading);
    $("#emt").val(emt);
    $("#math").val(math);
});
</script>



@stop