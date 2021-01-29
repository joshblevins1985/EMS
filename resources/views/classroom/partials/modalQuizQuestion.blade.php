
                @foreach($quiz->questions as $qq)
                    <!--Panel-->
                        <div class="card">
                            <div class="container">
                                <div class="row text-left m-2 p-2">
                                    {{$qq->question}}
                                </div>
                                <form action="{{ route('ClassRoomAnswer.store') }}" method="post" enctype="multipart/form-data" class="ansform">
                                    @foreach($qq->answeres as $qa)
                                        @csrf
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
                                        <input type="hidden" name="course" value="{{$quiz->id}}">
                                        @if($loop->last)
                                            <input type="hidden" name="end" value="true">
                                        @endif

                                        <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Submit Answer</button>
                                    </div>
                                </form>
                            </div>


                        </div>
                        <!--/.Panel-->
                    @endforeach
                </div>

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
            
            console.log(data);
            $.ajax({
                type : post,
                url : url,
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