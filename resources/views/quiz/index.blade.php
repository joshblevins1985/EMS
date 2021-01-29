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
    <h1>{{$quiz->title}}</h1>
</div>

<div class="row">
    <div class="col-lg-3">
        <button class="btn btn-primary"  data-toggle="modal" data-target="#newQuestionModal" data-quiz_id="{{$quiz->id}}"><i class="far fa-layer-plus"></i> Add New Question</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <!-- Card -->
        <div class="card card-cascade">

            <!-- Card image -->
            <div class="view view-cascade gradient-card-header blue-gradient">

                <!-- Title -->
                <h2 class="card-header-title mb-3">Quiz Questions</h2>

            </div>

            <!-- Card content -->
            <div class="card-body card-body-cascade text-center">

                @foreach($quiz->questions as $qq)
                <!--Panel-->
                <div class="card">
                    <div class="container">
                        <div class="row text-left m-2 p-2">
                            {{$qq->question}}
                        </div>

                        @foreach($qq->answeres as $qa)

                        <div class="row m-2 p-2">
                            <div class="col-lg-12 text-left">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="{{$qa->id}}" value="{{$qa->id}}"
                                           name="answere"  @if($qa->is_correct == 1)  checked @endif>
                                    <label class="form-check-label" for="{{$qa->id}}">{{$qa->answere}} @if($qa->is_correct == 1)  * @endif</label>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        <button class="btn btn-primary"  data-toggle="modal" data-target="#newAnswerModal" data-question_id="{{$qq->id}}"><i class="far fa-layer-plus"></i> Add Answer to Question</button>



                    </div>


                </div>
                <!--/.Panel-->
                @endforeach

            </div>

        </div>
        <!-- Card -->
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="newQuestionModal" tabindex="-1" role="dialog" aria-labelledby="newQuestionModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newQuestionModalLabel">Add New Question to Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="/question" method="post" >
                   {{ csrf_field() }}
                    <input class="form-control form-control-lg" type="text" name="question" placeholder="Question">

                    <input type="hidden" id="quizId" name="quiz_id" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newAnswerModal" tabindex="-1" role="dialog" aria-labelledby="newAnswerModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAnswerModalLabel">Add New Answer to Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/question/answer" method="post" >
                   {{ csrf_field() }}
                    <input class="form-control form-control-lg" type="text" name="answere" placeholder="Answer">
                    
                    <select class="mdb-select md-form" name="is_correct">
                      <option value="0" selected>Incorrect</option>
                      <option value="1">Correct</option>
                    </select>

                    <input type="hidden" id="questionId" name="question_id" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('styles')

@stop

@section('scripts')

<script>
    $('#newQuestionModal').on('show.bs.modal', function(e) {
        var quiz_id = $(e.relatedTarget).data('quiz_id');

        $("#quizId").val(quiz_id);
    });
</script>

<script>
    $('#newAnswerModal').on('show.bs.modal', function(e) {
        var question_id = $(e.relatedTarget).data('question_id');

        $("#questionId").val(question_id);
    });
</script>

@stop