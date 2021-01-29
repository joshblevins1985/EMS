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

@if(!$enrolled)
<div class="row">
    
    {!! Form::open(['url' => route('enroll.update', $class->id), 'method' => 'POST']) !!}
        @method('PUT')
   
    <button class="btn btn-info btn-block my-4" type="submit">Enroll in This Course</button>
    {!! Form::close() !!}
    
</div>

@else
<div class ="row justify-content-md-center">
    <div class='col-lg-6 '>

        <iframe id="display" style="width:100%; height:360px;overflow:auto;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>


    </div>


</div>
<div class = "row">

    <div class="col-lg-8 col-md-12">
        <h2>Course Lessons</h2>
        @include('courses.partials.lessons')
    </div>

    <div class="col-lg-4 col-md-12">
        @include('courses.partials.coursestatus')
    </div>
</div>



<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add New Lesson</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {!! Form::open(['route' => 'lesson.store', 'id' => 'lesson-form']) !!}
                <div class="md-form mb-5">
                    <i class="fa fa-compass prefix grey-text"></i>
                    <input type="hidden" id="course_id" name="course_id" class="form-control validate" value="{{$course->id}}">

                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-compass prefix grey-text"></i>
                    <input type="text" id="title" name="title" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="title">Lesson Title</label>
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-sort prefix grey-text"></i>
                    <input type="text" id="order" name="order" class="form-control validate">
                    <label data-error="order" data-success="order" for="title">Number order to diplay.</label>
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-film prefix grey-text"></i>
                    <input type="text" id="content" name="content" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="title">Lesson Content</label>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary">Add Lesson</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalQuizForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add New Lesson</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {!! Form::open(['route' => 'quiz.store', 'id' => 'lesson-form']) !!}
                <div class="md-form mb-5">
                    <i class="fa fa-compass prefix grey-text"></i>
                    <input type="hidden" id="course_id" name="course_id" class="form-control validate" value="{{$course->id}}">

                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-compass prefix grey-text"></i>
                    <input type="text" id="title" name="title" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="title">Quiz Title</label>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary">Add Quiz</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-lg-8 col-md-12">

        @include('courses.partials.quizes')

    </div>
    <!--
      {!! Form::open(['route' => 'lesson.complete', 'id' => 'badrunsheets-form']) !!}
      <div class="md-form">
          <div class="md-form">
              <input  type="text" id="course" name="course"  class="form-control">
              <label for="incident_date">Course Id</label>
          </div>
      </div>

      <div class="md-form">
          <div class="md-form">
              <input  type="text" id="user" name="user"  class="form-control">
              <label for="incident_date">User Id</label>
          </div>
      </div>

      <div class="md-form">
          <div class="md-form">
              <input  type="text" id="lesson" name="lesson"  class="form-control">
              <label for="incident_date">Lesson</label>
          </div>
      </div>



      <button class="btn btn-info btn-block my-4" type="submit">Add Report</button>

      {!! Form::close() !!}

-->
</div>
@endif

@if($quiz)
    @include('courses.partials.quiz')
@endif
@stop

@section('styles')

@stop

@section('scripts')

<script>
    $(function() {
        var iframe = $('#display')[0];
        var player = $f(iframe);
        var lesson_id='';
        var lesson_complate_id='';
        // When the player is ready, add listeners for pause, finish, and playProgress
        player.addEvent('ready', function() {
           // player.addEvent('pause', onPause);
            player.addEvent('finish', onFinish);
            player.addEvent('playProgress', onPlayProgress);
        });
        $('button').bind('click', function() {
            lesson_id=$(this).data('id');
        });
        function onFinish() {
            console.log('finished');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            $.ajax({
                url: '{{route('lesson.complete')}}',
                method: 'POST',
                data:  {
                    lesson: lesson_id,
                    user: {{Auth::user()->id}},
            course: {{$class->id}},

        },
            success: function(res){
                lesson_complate_id ="#lesson_complate_id"+lesson_id;
                $(lesson_complate_id).attr('class', 'badge badge-success');
                $(lesson_complate_id).text('Completed')
            }
        });
        }
        /*function onPause() {/////////////////I use ths function for test in a short time if you don't need , you can delete this function
            console.log('paused');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            $.ajax({
                url: '{{route('lesson.complete')}}',
                method: 'POST',
                data:  {
                    lesson: lesson_id,
                    user: {{Auth::user()->id}},
            course: {{$class->id}},

        },
            success: function(res){
                lesson_complate_id ="#lesson_complate_id"+lesson_id;
                $(lesson_complate_id).attr('class', 'badge badge-success');
                $(lesson_complate_id).text('Completed')
            }
        });
        }*/
        function onPlayProgress(data) {
            console.log('playing');
        }
    });

</script>
<!--<script>-->


<!--    function onFinish() {-->
<!--        status.text('finished');-->
<!--        console.log('#someButton was clicked');-->
<!--            $.ajaxSetup({-->
<!--        headers: {-->
<!--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
<!--        }-->
<!--    });-->

<!--    $(document).ready(function(){-->
<!--        $('#form').submit(function (e) {-->
<!--            e.preventDefault(); //**** to prevent normal form submission and page reload

<!--            $.ajax({-->
<!--                type : 'POST',-->
<!--                url : '{{route('lesson.complete')}}',-->
<!--                data : {-->
<!--                    lesson: val('1'),-->
<!--                    user: val({{Auth::user()->id}}),-->

<!--                },-->
<!--                success: function(result){-->
<!--                    console.log(result);-->
<!--                    $('#head').text(result.status);-->
<!--                },-->
<!--                error: function (xhr, ajaxOptions, thrownError) {-->
<!--                    //alert(xhr.status);
<!--                //alert(thrownError);
<!--                }-->
<!--            });-->
<!--        });-->
<!--    });-->
<!--    }-->

<!--});-->
<!--</script>-->

<script type="text/javascript">


    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    
    $('.ansform').on('submit',function(e){
    var form = $(this);
    var submit = form.find("[type=submit]");
    var submitOriginalText = submit.attr("value");

    e.preventDefault();
    var data = form.serialize();
    var url = form.attr('action');
    var post = form.attr('method');
    $.ajax({
        type : post,
        url : '{{route('answere.store')}}',
        data :data,
        success:function(data){
           submit.attr("value", "Submitted");
           console.log(data)
        },
        beforeSend: function(){
           submit.attr("value", "Loading...");
           submit.prop("disabled", true);
        },
        error: function() {
            submit.attr("value", submitOriginalText);
            submit.prop("disabled", false);
            
           // show error to end user
        }
    })
})

</script>


@stop