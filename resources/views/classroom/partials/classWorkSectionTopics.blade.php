<li class="d-flex mb-3">
            <div class="col-xl-2">
                @if($topic->type == 1)

                @elseif($topic->type == 2)
                    @if($topic->required)
                        @if(date('Y-m-d') > $topic->due_date)
                            <span class="fa-stack fa-4x">
                            <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                            <i class="fas fa-clipboard-list fa-stack-1x"></i>
                        </span>
                        @else
                            <span class="fa-stack fa-4x">
                            <i class="fad fa-circle-notch fa-stack-2x text-warning"></i>
                            <i class="fas fa-clipboard-list fa-stack-1x"></i>
                        </span>
                        @endif

                    @else
                        <span class="fa-stack fa-4x">
                      <i class="fad fa-circle-notch fa-stack-2x text-primary"></i>
                      <i class="fas fa-clipboard-list fa-stack-1x"></i>
                    </span>
                    @endif
                @elseif($topic->type == 3)
                    @if($topic->required)
                        @if(date('Y-m-d') > $topic->due_date)
                            <span class="fa-stack fa-4x">
                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                          <i class="fab fa-youtube-square fa-stack-1x"></i>
                        </span>
                        @else
                            <span class="fa-stack fa-4x">
                          <i class="fad fa-circle-notch fa-stack-2x text-warning"></i>
                          <i class="fab fa-youtube-square fa-stack-1x"></i>
                        </span>
                        @endif

                    @else
                        <span class="fa-stack fa-4x">
                      <i class="fad fa-circle-notch fa-stack-2x text-primary"></i>
                      <i class="fab fa-youtube-square fa-stack-1x"></i>
                    </span>
                    @endif
                @elseif($topic->type == 4)
                    @if($topic->required)
                        @if(date('Y-m-d') > $topic->due_date)
                            <span class="fa-stack fa-4x">
                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                          <i class="far fa-file-pdf fa-stack-1x"></i>
                        </span>
                        @else
                            <span class="fa-stack fa-4x">
                          <i class="fad fa-circle-notch fa-stack-2x text-warning"></i>
                          <i class="far fa-file-pdf fa-stack-1x"></i>
                        </span>
                        @endif

                    @else
                        <span class="fa-stack fa-4x">
                      <i class="fad fa-circle-notch fa-stack-2x text-primary"></i>
                      <i class="far fa-file-pdf fa-stack-1x"></i>
                    </span>
                    @endif
                @elseif($topic->type == 5)
                    @if($topic->required)
                        @if(date('Y-m-d') > $topic->due_date)
                            <span class="fa-stack fa-4x">
                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                          <i class="far fa-file-powerpoint fa-stack-1x"></i>
                        </span>
                        @else
                            <span class="fa-stack fa-4x">
                          <i class="fad fa-circle-notch fa-stack-2x text-warning"></i>
                          <i class="far fa-file-powerpoint fa-stack-1x"></i>
                        </span>
                        @endif

                    @else
                        <span class="fa-stack fa-4x">
                      <i class="fad fa-circle-notch fa-stack-2x text-primary"></i>
                      <i class="far fa-file-powerpoint fa-stack-1x"></i>
                    </span>
                    @endif
                @elseif($topic->type == 6)

                    @if($topic->required)
                        @if(date('Y-m-d') > $topic->due_date)
                            <span class="fa-stack fa-4x">
                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                          <i class="fad fa-video-slash fa-stack-1x"></i>
                        </span>
                        @else
                            <span class="fa-stack fa-4x">
                          <i class="fad fa-circle-notch fa-stack-2x text-warning"></i>
                          <i class="fad fa-video-slash fa-stack-1x"></i>
                        </span>
                        @endif

                    @else
                        <span class="fa-stack fa-4x">
                      <i class="fad fa-circle-notch fa-stack-2x text-primary"></i>
                      <i class="fad fa-video-slash fa-stack-1x"></i>
                    </span>
                    @endif
                @endif


            </div>
            <div class="col-xl-8">

                @if($topic->type == 1)
                    <a><h2 class="text-info"> {{ $topic->label }} </h2></a>
                @elseif($topic->type == 2)
                    <h2 class="text-info"><a href="/classroom/quiz/attempts/{{ $topic->pid }}">{!! $topic->label !!} </a>
                    </h2>
                @elseif($topic->type == 3)
                    <h2 class="text-info"><a data-toggle="modal" data-target="#modalYouTube"
                                             data-id="{{ $topic->id }}" data-video="{{$topic->link}}">{{ $topic->label }}</a></h2>
                @elseif($topic->type == 4)
                    <h2 class="text-info"><a
                                href="/classroom/download/{{ $topic->id }}/{{$topic->link}}"> {{ $topic->label }} </a></h2>
                @elseif($topic->type == 5)
                    <h2 class="text-info"><a
                                href="/classroom/download/{{ $topic->id }}/{{$topic->link}}">{{ $topic->label }}</a></h2>
                @elseif($topic->type == 6)
                    <h2 class="text-info"><a href="/classroom/vimeo/{{ $topic->id }}">{{ $topic->label }}</a></h2>
                @endif

                <p>@if(is_null($topic->due_date)) @else Due
                    Date: {{ Carbon\Carbon::parse($topic->due_date)->format('m-d-Y') }} @endif</p>
                <p>{!! $topic->instructions !!}</p>

            </div>
            <div class="col-xl-2 pull-right">
                @if($topic->type == 1)

                @elseif($topic->type == 2)
                    @if(auth()->user()->id == 0)
                        1
                    @else

                        @foreach($classroom->gradeBook->where('topic_id', $topic->id) as $grade)
                            @if(count($grade->userGrades->where('user_id', auth()->user()->id)))
                                @foreach($grade->userGrades->where('user_id', auth()->user()->id) as $userGrade)
                                    <span class="fa-stack fa-4x">
                                                      <?php
                                        $percent = $userGrade->grade;

                                        ?>
                                                  <i class="fad fa-circle-notch fa-stack-2x @if($percent < 80) text-danger @else text-success @endif"></i>
                                                  <strong class="fa-stack-1x calendar-text" style=" font-size: 25px">

                                                      {{ round($percent) }}

                                                      </strong>
                                                    </span>
                                @endforeach
                            @else
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>
                            @endif


                        @endforeach

                    @endif
                @elseif($topic->type == 3)
                    @if(auth()->user()->id == 0)
                        1
                    @else
                        <?php
                        $thisTopic = $topic->tracking->where('user_id', auth()->user()->id)->first();
                        ?>
                        @if($thisTopic)
                            @if($thisTopic->completed)
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-success"></i>
                                          <i class="far fa-check-double fa-stack-1x fa-inverse"></i>
                                        </span>

                            @else
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>

                            @endif

                        @else
                            <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>
                        @endif


                    @endif
                @elseif($topic->type == 4)
                    @if(auth()->user()->id == 0)
                        1
                    @else
                        <?php
                        $thisTopic = $topic->tracking->where('user_id', auth()->user()->id)->first();
                        ?>
                        @if($thisTopic)
                            @if($thisTopic->completed)
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-success"></i>
                                          <i class="far fa-check-double fa-stack-1x fa-inverse"></i>
                                        </span>

                            @else
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>

                            @endif

                        @else
                            <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>
                        @endif


                    @endif
                @elseif($topic->type == 5)
                    @if(auth()->user()->id == 0)
                        1
                    @else
                        <?php
                        $thisTopic = $topic->tracking->where('user_id', auth()->user()->id)->first();
                        ?>
                        @if($thisTopic)
                            @if($thisTopic->completed)
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-success"></i>
                                          <i class="far fa-check-double fa-stack-1x fa-inverse"></i>
                                        </span>

                            @else
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>

                            @endif

                        @else
                            <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>
                        @endif


                    @endif
                @elseif($topic->type == 6)
                    @if(auth()->user()->id == 0)
                        1
                    @else
                        <?php
                        $thisTopic = $topic->tracking->where('user_id', auth()->user()->id)->first();
                        ?>
                        @if($thisTopic)
                            @if($thisTopic->completed)
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-success"></i>
                                          <i class="far fa-check-double fa-stack-1x fa-inverse"></i>
                                        </span>

                            @else
                                <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>

                            @endif

                        @else
                            <span class="fa-stack fa-4x">
                                          <i class="fad fa-circle-notch fa-stack-2x text-danger"></i>
                                          <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                        </span>
                            @endif


                            @endif
                            @endif


                            </span>
            </div>
</li>