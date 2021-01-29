@foreach($quiz as $q)
<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalQuiz" tabindex="-1" role="dialog" aria-labelledby="exampleQuiz"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Course Examination</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                
                @foreach($q->questions as $qq)
                <!--Panel-->
                <div class="card">
                    <div class="container">
                        <div class="row text-left m-2 p-2">
                            {{$qq->question}}
                        </div>
                        <form action="{{ route('answere.store') }}" method="post" enctype="multipart/form-data" class="ansform">
                        @foreach($qq->answeres as $qa)
                        
                        <div class="row m-2 p-2">
                            <div class="col-lg-12 text-left">
                                <div class="form-check">
                                  <input type="radio" class="form-check-input" id="{{$qa->id}}" value="{{$qa->id}}" name="answere">
                                  <label class="form-check-label" for="{{$qa->id}}">{{$qa->answere}}</label>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        @endforeach
                        <div class="row m-2 p-2">
                            <input type="hidden" name="question_id" value="{{$qq->id}}">
                            <input type="hidden" name="course" value="{{$class->id}}">
                            @if($loop->last)
                            <input type="hidden" name="end" value="true">
                            @endif
                            
                        <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Submit Answere</button>
                        </div>
                        </form>
                    </div>
                        
                    
                </div>
                <!--/.Panel-->
                @endforeach
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">

                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->
@endforeach